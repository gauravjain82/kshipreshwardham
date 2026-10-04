@extends('layouts.app')
@section('title', 'Donation Successful')
@section('content')
<div class="page-banner">
    <h1>Thank You! 🙏</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <i class="fas fa-chevron-right"></i>
        <span>Donation Success</span>
    </div>
</div>

<section style="padding:100px 0;background:var(--cream);text-align:center;">
    <div class="container">
        <div style="max-width:620px;margin:0 auto;background:white;border-radius:24px;padding:64px 48px;box-shadow:0 20px 60px rgba(0,0,0,0.08);border:1px solid var(--cream-dark);">
            <div style="font-size:4rem;margin-bottom:20px;">🙏</div>
            <h2 style="font-family:'Cinzel',serif;font-size:2rem;color:var(--crimson);margin-bottom:8px;">Jai Kshipreshwar!</h2>
            <p style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;color:var(--text-light);font-style:italic;margin-bottom:24px;">Your generous donation has been received with gratitude</p>

            @if(session('donor_name'))
            <div style="background:linear-gradient(135deg,var(--cream),var(--cream-dark));border-radius:12px;padding:28px;margin:24px 0;text-align:center;border:1px solid var(--gold);">
                <p style="font-family:'Cinzel',serif;font-size:1.5rem;color:var(--crimson);font-weight:700;">₹{{ number_format(session('amount')) }}</p>
                <p style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;color:var(--text-mid);margin-top:8px;">donated by <strong>{{ session('donor_name') }}</strong><br>Donation ID: <strong>#{{ session('donation_id') }}</strong></p>
            </div>
            <p style="font-family:'Cormorant Garamond',serif;font-size:1.05rem;color:var(--text-mid);line-height:1.9;font-style:italic;margin-top:20px;">"May the divine blessings of Lord Kshipreshwar shower upon you and your family. Your seva will light many sacred lamps and feed many hungry souls." 🕉</p>
            @endif

            <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:36px;">
                <a href="{{ route('home') }}" class="btn btn-gold"><i class="fas fa-home"></i> Return Home</a>
                <a href="{{ route('donation') }}" class="btn btn-crimson"><i class="fas fa-heart"></i> Donate Again</a>
            </div>
        </div>
    </div>
</section>
@endsection
