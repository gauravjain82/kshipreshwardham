<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index()
    {
        return view('pages.booking');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'visitor_name'   => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'required|string|max:20',
            'visit_date'     => 'required|date|after:today',
            'visit_time'     => 'required|string',
            'num_visitors'   => 'required|integer|min:1|max:50',
            'purpose'        => 'required|string|max:500',
            'special_request'=> 'nullable|string|max:1000',
        ]);

        $booking = Booking::create($validated);

        return redirect()->route('booking.success')->with([
            'booking_id'   => $booking->id,
            'booking_name' => $booking->visitor_name,
        ]);
    }

    public function success()
    {
        if (!session()->has('booking_id')) {
            return redirect()->route('booking');
        }
        return view('pages.booking-success');
    }
}
