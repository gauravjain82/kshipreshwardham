<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Http;
class HomeController extends Controller
{
       private $razorpayKey;
       private $razorpaySecret;

    public function __construct()
    {
        $this->razorpayKey = config('services.razorpay.key');
        $this->razorpaySecret = config('services.razorpay.secret');
    }

    public function index()
    {
        $data['frontend'] = DB::table('content')->first();
      $data['gallery'] = DB::table('gallery')
                                ->where('status', 0)
                                ->get();
        $data['banner'] = DB::table('banner')->get();
        $data['objectives'] = DB::table('objectives')->get();
        return view('pages.home',$data);
    }

        public function about()
    {
        $data['frontend'] = DB::table('content')->first();
    $data['top'] = DB::table('top_banner')->first();

        return view('pages.about',$data);
    }

  public function event()
{
    $events = DB::table('events')
                ->where('status', 1)
                ->orderBy('start_date', 'asc')
                ->get();
    $data['top'] = DB::table('top_banner')->first();

    return view('pages.event', compact('events'));
}

public function eventDetails($id)
{
    $event = DB::table('events')
                ->where('id', $id)
                ->where('status', 1)
                ->first();

    if (!$event) {
        abort(404, 'Event not found');
    }

    $relatedEvents = DB::table('events')
                        ->where('status', 1)
                        ->where('id', '!=', $event->id)
                        ->orderBy('start_date', 'desc')
                        ->limit(3)
                        ->get();

    return view('pages.eventdetails', compact('event', 'relatedEvents'));
}

        public function donation()
    {
        $data['top'] = DB::table('top_banner')->first();

        return view('pages.donation',$data);
    }

         public function Privacypolicy()
    {
        return view('pages.privacy');
    }

    public function TC()
    {
        return view('pages.term_condition');
    }

    /**
     * Display Refund Policy page
     */
    public function RF()
    {
        return view('pages.refund_policy');
    }

 

            public function volunteer()
    {
        $data['events'] = DB::table('events')->get();
    $data['top'] = DB::table('top_banner')->first();

        return view('pages.volunteer',$data);
    }

public function volunteerSubmit(Request $request)
{
    $request->validate([
        'full_name' => 'required',
        'mobile' => 'required',
    ]);

    DB::table('volunteers')->insert([
        'event_id' => $request->event_id,
        'full_name' => $request->full_name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'gender' => $request->gender,
        'age' => $request->age,
        'address' => $request->address,
        'city' => $request->city,
        'availability' => $request->availability,
        'experience' => $request->experience,
        'message' => $request->message,
        'created_at' => now()
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Thank you! Your volunteer request has been submitted.'
    ]);
}

     public function Contact()
    {
    $data['top'] = DB::table('top_banner')->first();


        return view('pages.contact',$data);
    }

  public function Hotel()
{
    $data['hotels'] = DB::table('hotels')
                        ->where('status',1)
                        ->orderBy('id','desc')
                        ->get();
    $data['top'] = DB::table('top_banner')->first();
    

    return view('pages.hotels',$data);
}

  public function createOrder(Request $request)
    {
        try {
            $api = new Api($this->razorpayKey, $this->razorpaySecret);
            
            // Convert amount to paise (CRITICAL: Multiply by 100)
            $amountInPaise = $request->amount * 100;
            
            // Create order
            $order = $api->order->create([
                'receipt' => 'donation_' . uniqid(),
                'amount' => $amountInPaise, // Must be in paise
                'currency' => 'INR',
                'payment_capture' => 1
            ]);
            
            // Store in session for verification
            session(['temp_donation' => [
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'city' => $request->city,
                'address' => $request->address,
                'purpose' => $request->purpose,
                'amount' => $request->amount
            ]]);
            
            return response()->json([
                'id' => $order['id'],
                'amount' => $order['amount'], // Already in paise
                'currency' => $order['currency']
            ]);
            
        } catch (\Exception $e) {
            Log::error('Order creation failed: ' . $e->getMessage());
            return response()->json([
                'error' => 'Unable to create order: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function verifyPayment(Request $request)
    {
        try {
            $api = new Api($this->razorpayKey, $this->razorpaySecret);
            
            // Verify signature
            $attributes = [
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature
            ];
            
            $api->utility->verifyPaymentSignature($attributes);
            
            // Save to database
            $donationData = $request->donation_data;
            \App\Models\Donation::create([
                'name' => $donationData['name'],
                'email' => $donationData['email'],
                'mobile' => $donationData['mobile'],
                'city' => $donationData['city'],
                'address' => $donationData['address'],
                'purpose' => $donationData['purpose'],
                'amount' => $donationData['amount'],
                'payment_id' => $request->razorpay_payment_id,
                'order_id' => $request->razorpay_order_id,
                'status' => 'success'
            ]);
            
            return response()->json(['success' => true]);
            
        } catch (\Exception $e) {
            Log::error('Verification failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        }
    }

public function sendContactMail(Request $request)
{
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'phone'   => 'required|string|max:20',
        'message' => 'required|string',
    ]);

    try {

        $setting = DB::table('setting')->first();

        if (!$setting) {
            return response()->json([
                'success' => false,
                'message' => 'Email settings not found.'
            ], 500);
        }

        $apiKey = $setting->zoho_api_key;
        $fromEmail = $setting->zoho_from_email;
        

        if (empty($apiKey) || empty($fromEmail)) {
            return response()->json([
                'success' => false,
                'message' => 'Email settings are incomplete.'
            ], 500);
        }

        /*
        |--------------------------------------------------------------------------
        | API Token Normalize
        |--------------------------------------------------------------------------
        | Agar DB mein "Zoho-enczapikey TOKEN" save hai to prefix remove karenge.
        | Header mein prefix hum khud add karenge.
        */
        $apiKey = preg_replace(
            '/^Zoho-enczapikey\s+/i',
            '',
            $apiKey
        );

        // New line / carriage return / tabs remove
        $apiKey = preg_replace('/\s+/', '', $apiKey);

        $toEmail = 'info.kshipreshwardham@gmail.com';

        $subject = 'New Contact Us Inquiry - ' . $request->name;

        $htmlContent = '
            <h3>New Contact Message Received</h3>

            <p>
                <strong>Name:</strong>
                ' . e($request->name) . '
            </p>

            <p>
                <strong>Email:</strong>
                ' . e($request->email) . '
            </p>

            <p>
                <strong>Phone:</strong>
                ' . e($request->phone) . '
            </p>

            <p>
                <strong>Message:</strong><br>
                ' . nl2br(e($request->message)) . '
            </p>
        ';

        $payload = [

            'from' => [
                'address' => $fromEmail,
                'name'    => 'Website Contact'
            ],

            'to' => [
                [
                    'email_address' => [
                        'address' => $toEmail,
                        'name'    => 'Admin'
                    ]
                ]
            ],

            'subject' => $subject,

            'htmlbody' => $htmlContent
        ];

        /*
        |--------------------------------------------------------------------------
        | Send Email via ZeptoMail
        |--------------------------------------------------------------------------
        */

      $response = Http::withHeaders([
            'Authorization' => 'Zoho-enczapikey ' . $apiKey,
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json', // Added explicitly to match curl
        ])
        ->asJson()
        ->timeout(30)
        ->post(
            'https://api.zeptomail.in/v1.1/email', // <-- Changed .com to .in
            $payload
        );
        /*
        |--------------------------------------------------------------------------
        | Logging
        |--------------------------------------------------------------------------
        */

        Log::info('ZeptoMail API Response', [
            'status' => $response->status(),
            'body'   => $response->body(),

            // Token expose nahi karenge
            'token_length' => strlen($apiKey),

            'from_email' => $fromEmail
        ]);

        /*
        |--------------------------------------------------------------------------
        | Failed Response
        |--------------------------------------------------------------------------
        */

        if ($response->failed()) {

            $error = $response->json();

            Log::error('ZeptoMail Send Email Failed', [
                'status' => $response->status(),
                'error'  => $error
            ]);

            // Invalid API Token
            if ($response->status() == 401) {

                return response()->json([
                    'success' => false,
                    'message' => 'ZeptoMail API token is invalid. Please generate a new Send Mail Token.',
                    'status'  => 401,
                    'error'   => $error
                ], 401);
            }

            return response()->json([
                'success' => false,
                'message' => 'Email sending failed.',
                'status'  => $response->status(),
                'error'   => $error
            ], 502);
        }

        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,
            'message' => 'आपका संदेश सफलतापूर्वक भेज दिया गया है।'
        ], 200);

    } catch (\Throwable $e) {

        Log::error('Contact Email Exception', [
            'message' => $e->getMessage(),
            'file'    => $e->getFile(),
            'line'    => $e->getLine()
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Server error while sending email.'
        ], 500);
    }
}


}
