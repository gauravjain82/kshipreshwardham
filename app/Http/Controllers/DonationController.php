<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $totalDonations = Donation::sum('amount');
        $donorCount = Donation::distinct('email')->count('email');
        return view('pages.donation', compact('totalDonations', 'donorCount'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'donor_name'  => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'phone'       => 'nullable|string|max:20',
            'amount'      => 'required|numeric|min:1',
            'purpose'     => 'required|string|max:255',
            'message'     => 'nullable|string|max:1000',
            'anonymous'   => 'nullable|boolean',
        ]);

        $validated['anonymous'] = $request->has('anonymous');
        $donation = Donation::create($validated);

        return redirect()->route('donation.success')->with([
            'donation_id'   => $donation->id,
            'donor_name'    => $donation->donor_name,
            'amount'        => $donation->amount,
        ]);
    }

    public function success()
    {
        if (!session()->has('donation_id')) {
            return redirect()->route('donation');
        }
        return view('pages.donation-success');
    }
}
