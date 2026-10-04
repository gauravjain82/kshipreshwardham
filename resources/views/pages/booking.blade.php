@extends('layouts.app')

@section('title', 'Book Darshan')

@push('styles')
<style>
    .booking-wrapper {
        padding: 80px 0;
        background: var(--cream);
        min-height: 60vh;
    }
    .booking-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 48px;
        align-items: start;
    }
    .booking-form-box {
        background: white;
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 8px 40px rgba(0,0,0,0.08);
        border: 1px solid var(--cream-dark);
    }
    .booking-form-box h2 {
        font-family: 'Cinzel', serif;
        font-size: 1.8rem;
        color: var(--crimson);
        margin-bottom: 6px;
    }
    .booking-form-box .subtitle {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.05rem;
        color: var(--text-light);
        font-style: italic;
        margin-bottom: 36px;
    }
    .booking-sidebar {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    .info-card {
        background: white;
        border-radius: 16px;
        padding: 32px;
        border: 1px solid var(--cream-dark);
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    }
    .info-card h3 {
        font-family: 'Cinzel', serif;
        font-size: 1rem;
        color: var(--crimson);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .info-card h3 i { color: var(--gold); }
    .time-slot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid var(--cream-dark);
        font-family: 'Cormorant Garamond', serif;
        font-size: 1rem;
    }
    .time-slot:last-child { border-bottom: none; }
    .time-slot .label { color: var(--text-mid); }
    .time-slot .time { color: var(--crimson); font-weight: 500; }
    .notice-box {
        background: linear-gradient(135deg, var(--crimson-dark), var(--crimson));
        border-radius: 16px;
        padding: 32px;
        text-align: center;
        color: var(--cream);
    }
    .notice-box .om { font-size: 2.5rem; margin-bottom: 12px; display: block; }
    .notice-box p {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.05rem;
        line-height: 1.8;
        font-style: italic;
        color: rgba(245,230,200,0.85);
    }
    .submit-btn-wrap { margin-top: 8px; }
    .select-styled {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%238B6640' d='M6 8L0 0h12z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 44px !important;
    }

    @media (max-width: 900px) {
        .booking-grid { grid-template-columns: 1fr; }
        .booking-form-box { padding: 32px 24px; }
        .booking-sidebar { flex-direction: row; flex-wrap: wrap; }
        .booking-sidebar > * { flex: 1; min-width: 240px; }
    }
</style>
@endpush

@section('content')

<div class="page-banner">
    <h1>Book Your Darshan</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <i class="fas fa-chevron-right"></i>
        <span>Booking</span>
    </div>
</div>

<div class="booking-wrapper">
    <div class="container">
        <div class="booking-grid">

            <!-- FORM -->
            <div class="booking-form-box">
                <h2>Reserve Your Sacred Visit</h2>
                <p class="subtitle">Fill in your details to book a darshan at Kshipreshwar DHAM</p>

                @if($errors->any())
                <div style="background:#fff5f5;border:1px solid var(--crimson);border-radius:8px;padding:16px;margin-bottom:24px;">
                    <p style="color:var(--crimson);font-family:'Cinzel',serif;font-size:0.8rem;margin-bottom:8px;"><i class="fas fa-exclamation-circle"></i> Please fix the following errors:</p>
                    @foreach($errors->all() as $err)
                        <p class="error-msg" style="margin:4px 0;">• {{ $err }}</p>
                    @endforeach
                </div>
                @endif

                <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Visitor Name <span>*</span></label>
                            <input type="text" name="visitor_name" class="form-control @error('visitor_name') is-invalid @enderror"
                                   placeholder="Your full name" value="{{ old('visitor_name') }}" required>
                            @error('visitor_name')<p class="error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address <span>*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   placeholder="your@email.com" value="{{ old('email') }}" required>
                            @error('email')<p class="error-msg">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Phone Number <span>*</span></label>
                            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="+91 XXXXX XXXXX" value="{{ old('phone') }}" required>
                            @error('phone')<p class="error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Number of Visitors <span>*</span></label>
                            <input type="number" name="num_visitors" class="form-control @error('num_visitors') is-invalid @enderror"
                                   placeholder="1" min="1" max="50" value="{{ old('num_visitors', 1) }}" required>
                            @error('num_visitors')<p class="error-msg">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Visit Date <span>*</span></label>
                            <input type="date" name="visit_date" class="form-control @error('visit_date') is-invalid @enderror"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('visit_date') }}" required>
                            @error('visit_date')<p class="error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Preferred Time <span>*</span></label>
                            <select name="visit_time" class="form-control select-styled @error('visit_time') is-invalid @enderror" required>
                                <option value="">Select time slot</option>
                                <option value="Morning Aarti (6:00 AM)" {{ old('visit_time')=='Morning Aarti (6:00 AM)'?'selected':'' }}>Morning Aarti (6:00 AM)</option>
                                <option value="Morning Darshan (8:00 AM)" {{ old('visit_time')=='Morning Darshan (8:00 AM)'?'selected':'' }}>Morning Darshan (8:00 AM)</option>
                                <option value="Mid-Morning (10:00 AM)" {{ old('visit_time')=='Mid-Morning (10:00 AM)'?'selected':'' }}>Mid-Morning (10:00 AM)</option>
                                <option value="Evening Darshan (5:00 PM)" {{ old('visit_time')=='Evening Darshan (5:00 PM)'?'selected':'' }}>Evening Darshan (5:00 PM)</option>
                                <option value="Evening Aarti (7:00 PM)" {{ old('visit_time')=='Evening Aarti (7:00 PM)'?'selected':'' }}>Evening Aarti (7:00 PM)</option>
                            </select>
                            @error('visit_time')<p class="error-msg">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Purpose of Visit <span>*</span></label>
                        <select name="purpose" class="form-control select-styled @error('purpose') is-invalid @enderror" required>
                            <option value="">Select purpose</option>
                            <option value="General Darshan" {{ old('purpose')=='General Darshan'?'selected':'' }}>General Darshan</option>
                            <option value="Special Rudrabhishek" {{ old('purpose')=='Special Rudrabhishek'?'selected':'' }}>Special Rudrabhishek</option>
                            <option value="Satyanarayan Katha" {{ old('purpose')=='Satyanarayan Katha'?'selected':'' }}>Satyanarayan Katha</option>
                            <option value="Havan & Yagya" {{ old('purpose')=='Havan & Yagya'?'selected':'' }}>Havan & Yagya</option>
                            <option value="Navratri Puja" {{ old('purpose')=='Navratri Puja'?'selected':'' }}>Navratri Puja</option>
                            <option value="Family Puja" {{ old('purpose')=='Family Puja'?'selected':'' }}>Family Puja</option>
                            <option value="Other" {{ old('purpose')=='Other'?'selected':'' }}>Other</option>
                        </select>
                        @error('purpose')<p class="error-msg">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Special Requests / Notes</label>
                        <textarea name="special_request" class="form-control" rows="4"
                                  placeholder="Any special arrangements, accessibility needs, or additional information...">{{ old('special_request') }}</textarea>
                    </div>

                    <div class="submit-btn-wrap">
                        <button type="submit" class="btn btn-gold" style="width:100%;justify-content:center;padding:16px;font-size:0.85rem;">
                            <i class="fas fa-calendar-check"></i> Confirm Booking
                        </button>
                    </div>
                </form>
            </div>

            <!-- SIDEBAR -->
            <div class="booking-sidebar">
                <div class="notice-box">
                    <span class="om">🕉</span>
                    <p>Book your darshan in advance to ensure a serene and undisturbed experience at the temple.</p>
                </div>

                <div class="info-card">
                    <h3><i class="fas fa-clock"></i> Temple Timings</h3>
                    <div class="time-slot"><span class="label">Morning Opens</span><span class="time">5:00 AM</span></div>
                    <div class="time-slot"><span class="label">Morning Aarti</span><span class="time">6:00 AM</span></div>
                    <div class="time-slot"><span class="label">Afternoon Break</span><span class="time">12:00–4:00 PM</span></div>
                    <div class="time-slot"><span class="label">Evening Darshan</span><span class="time">4:00 PM</span></div>
                    <div class="time-slot"><span class="label">Evening Aarti</span><span class="time">7:00 PM</span></div>
                    <div class="time-slot"><span class="label">Temple Closes</span><span class="time">10:00 PM</span></div>
                </div>

                <div class="info-card">
                    <h3><i class="fas fa-info-circle"></i> Visitor Guidelines</h3>
                    @foreach(['Dress modestly — traditional attire preferred','Remove footwear before entering','Photography allowed in outer premises only','Maintain silence inside the sanctum','Children welcome — bring ID for group entry','Free prasad available after darshan'] as $g)
                    <div style="display:flex;gap:10px;margin-bottom:12px;font-family:'Cormorant Garamond',serif;font-size:1rem;color:var(--text-mid);">
                        <i class="fas fa-check" style="color:var(--gold);margin-top:4px;flex-shrink:0;"></i>
                        <span>{{ $g }}</span>
                    </div>
                    @endforeach
                </div>

                <div class="info-card">
                    <h3><i class="fas fa-phone"></i> Need Help?</h3>
                    <p style="font-family:'Cormorant Garamond',serif;font-size:1rem;color:var(--text-light);line-height:1.8;">For assistance with booking or special arrangements:</p>
                    <a href="tel:+919876543210" style="display:flex;align-items:center;gap:8px;color:var(--crimson);font-family:'Cinzel',serif;font-size:0.85rem;text-decoration:none;margin-top:12px;"><i class="fas fa-phone" style="color:var(--gold);"></i>+91 98765 43210</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
