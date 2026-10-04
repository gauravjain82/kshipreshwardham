<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Donation;

class PhonePeController extends Controller
{
    public function createOrder(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|string',
        ]);

        try {
            $clientId = env('PHONEPE_CLIENT_ID');
            $clientSecret = env('PHONEPE_CLIENT_SECRET');
            $clientVersion = env('PHONEPE_CLIENT_VERSION', 1);
            $env = env('PHONEPE_ENV', 'PRODUCTION');

            $isSandbox = strtoupper($env) === 'SANDBOX';
            $authUrl = $isSandbox 
                ? 'https://api-preprod.phonepe.com/apis/pg-sandbox/v1/oauth/token' 
                : 'https://api.phonepe.com/apis/identity-manager/v1/oauth/token';

            $payUrl = $isSandbox 
                ? 'https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/pay' 
                : 'https://api.phonepe.com/apis/pg/checkout/v2/pay';

            // Step 1: Get OAuth Token
            $authResponse = Http::asForm()->post($authUrl, [
                'client_id' => $clientId,
                'client_version' => $clientVersion,
                'client_secret' => $clientSecret,
                'grant_type' => 'client_credentials',
            ]);

            if ($authResponse->failed()) {
                return response()->json(['success' => false, 'error' => 'Authentication failed'], 400);
            }

            $accessToken = $authResponse->json()['access_token'] ?? null;
            if (!$accessToken) {
                return response()->json(['success' => false, 'error' => 'Token not found'], 400);
            }

            // Step 2: Prepare Order & Force Insert using DB Facade
            $merchantOrderId = 'TXN_' . uniqid();
            $amountInPaise = intval($request->amount * 100);

            DB::table('donations')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'city' => $request->city ?? '',
                'address' => $request->address ?? '',
                'purpose' => $request->purpose ?? 'Donation',
                'amount' => $request->amount,
                'order_id' => $merchantOrderId,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Step 3: Call PhonePe Pay API
            $payload = [
                "merchantOrderId" => $merchantOrderId,
                "amount" => $amountInPaise,
                "expireAfter" => 1200,
                "paymentFlow" => [
                    "type" => "PG_CHECKOUT",
                    "message" => "Donation Payment",
                    "merchantUrls" => [
                        "redirectUrl" => route('payment.callback', ['transactionId' => $merchantOrderId])
                    ]
                ]
            ];

            $payResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'O-Bearer ' . $accessToken,
            ])->post($payUrl, $payload);

            $payData = $payResponse->json();
            
            $redirectUrl = $payData['data']['instrumentResponse']['redirectInfo']['url'] 
               ?? $payData['redirectUrl'] 
               ?? $payData['redirectInfo']['url'] 
               ?? null;

            if ($redirectUrl) {
                return response()->json([
                    'success' => true,
                    'redirectUrl' => $redirectUrl,
                    'transactionId' => $merchantOrderId
                ]);
            }

            return response()->json(['success' => false, 'error' => 'Failed to get redirect URL'], 400);

        } catch (\Exception $e) {
            Log::error('PhonePe Create Order Exception: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function handleCallback(Request $request, $transactionId)
    {
        Log::info('PhonePe Callback Data for ' . $transactionId, $request->all());

        $donation = Donation::where('order_id', $transactionId)->first();

        if (!$donation) {
            return redirect()->route('donation.failed');
        }

        // 1. Re-authenticate to fetch status API token
        $clientId = env('PHONEPE_CLIENT_ID');
        $clientSecret = env('PHONEPE_CLIENT_SECRET');
        $clientVersion = env('PHONEPE_CLIENT_VERSION', 1);
        $env = env('PHONEPE_ENV', 'PRODUCTION');

        $isSandbox = strtoupper($env) === 'SANDBOX';
        $authUrl = $isSandbox 
            ? 'https://api-preprod.phonepe.com/apis/pg-sandbox/v1/oauth/token' 
            : 'https://api.phonepe.com/apis/identity-manager/v1/oauth/token';

        // Corrected PhonePe Checkout v2 Status Endpoint
        $statusUrl = $isSandbox 
            ? "https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/order/{$transactionId}/status" 
            : "https://api.phonepe.com/apis/pg/checkout/v2/order/{$transactionId}/status";

        $authResponse = Http::asForm()->post($authUrl, [
            'client_id' => $clientId,
            'client_version' => $clientVersion,
            'client_secret' => $clientSecret,
            'grant_type' => 'client_credentials',
        ]);

        if ($authResponse->failed()) {
            $donation->update(['status' => 'failed']);
            return redirect()->route('donation.failed');
        }

        $accessToken = $authResponse->json()['access_token'] ?? null;

        // 2. Query PhonePe Order Status API
        $statusResponse = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'O-Bearer ' . $accessToken,
        ])->get($statusUrl);

        $statusData = $statusResponse->json();
        Log::info('PhonePe Status Check Response:', $statusData);

        // Extract state and transaction ID correctly from v2 response structure
        $state = $statusData['state'] ?? null;
        $paymentDetails = $statusData['paymentDetails'] ?? [];
        $phonePePaymentId = !empty($paymentDetails) ? ($paymentDetails[0]['transactionId'] ?? $transactionId) : $transactionId;

        if ($statusResponse->successful() && $state === 'COMPLETED') {
            // Update to success only if verified as COMPLETED by PhonePe
            $donation->update([
                'status' => 'success',
                'payment_id' => $phonePePaymentId,
            ]);

            return redirect()->route('donation.success.page', ['transactionId' => $transactionId]);
        }

        // Otherwise mark as failed/cancelled
        $donation->update([
            'status' => 'failed',
        ]);

        return redirect()->route('donation.failed');
    }

    public function donationSuccess($transactionId)
    {
        $donation = Donation::where('order_id', $transactionId)->first();

        if (!$donation || $donation->status !== 'success') {
            return redirect()->route('donation.failed');
        }

        return "
        <html>
        <head>
            <title>Donation Successful</title>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <style>
                body { font-family: Arial, sans-serif; background: #f4f7f6; text-align: center; padding: 50px; }
                .card { background: white; max-width: 500px; margin: auto; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
                h2 { color: #28a745; margin-bottom: 10px; }
                .details { text-align: left; margin: 20px 0; border-top: 1px solid #eee; border-bottom: 1px solid #eee; padding: 15px 0; }
                .details p { margin: 8px 0; color: #555; }
                .btn { display: inline-block; background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 6px; margin-top: 15px; }
            </style>
        </head>
        <body>
            <div class='card'>
                <h2>🙏 Donation Successful!</h2>
                <p>Thank you for your generous contribution.</p>
                <div class='details'>
                    <p><strong>Name:</strong> {$donation->name}</p>
                    <p><strong>Mobile:</strong> {$donation->mobile}</p>
                    <p><strong>Email:</strong> {$donation->email}</p>
                    <p><strong>Purpose:</strong> {$donation->purpose}</p>
                    <p><strong>Amount Paid:</strong> ₹" . number_format($donation->amount, 2) . "</p>
                    <p><strong>Payment ID:</strong> {$donation->order_id}</p>
                    
                </div>
                <a href='/' class='btn'>Back to Home</a>
            </div>
        </body>
        </html>";
    }

    public function donationFailed()
    {
        return "
        <html>
        <head>
            <title>Donation Failed</title>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <style>
                body { font-family: Arial, sans-serif; background: #f4f7f6; text-align: center; padding: 50px; }
                .card { background: white; max-width: 500px; margin: auto; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
                h2 { color: #dc3545; margin-bottom: 10px; }
                .btn { display: inline-block; background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 6px; margin-top: 15px; }
            </style>
        </head>
        <body>
            <div class='card'>
                <h2>❌ Payment Failed or Cancelled</h2>
                <p>Unfortunately, your payment could not be processed or was cancelled. Please try again.</p>
                <a href='/' class='btn'>Try Again</a>
            </div>
        </body>
        </html>";
    }
}