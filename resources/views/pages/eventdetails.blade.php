@include('pages.common.header')

<style>
    /* Event Details Page Styles */
    .event-details-section {
        background: #f9f6ef;
        padding: 60px 0;
    }
    
    .event-details-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        margin-bottom: 40px;
    }
    
    .event-banner {
        position: relative;
        height: 500px;
        overflow: hidden;
    }
    
    .event-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .featured-badge-lg {
        position: absolute;
        top: 20px;
        left: 20px;
        background: linear-gradient(45deg, #d4af37, #b8860b);
        color: #fff;
        padding: 8px 20px;
        font-size: 14px;
        border-radius: 30px;
        font-weight: 600;
        z-index: 2;
    }
    
    .event-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 40px 30px 20px;
        color: #fff;
    }
    
    .event-overlay h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: #fff;
    }
    
    .event-meta-info {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        margin-top: 15px;
    }
    
    .event-meta-info .meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
    }
    
    .event-meta-info .meta-item i {
        font-size: 20px;
        color: #d4af37;
    }
    
    /* Event Content */
    .event-content-wrapper {
        padding: 40px;
    }
    
    .event-description {
        margin-bottom: 40px;
    }
    
    .event-description h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #8b5a2b;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(218, 165, 32, 0.3);
        display: inline-block;
    }
    
    .event-description p {
        font-size: 1.05rem;
        line-height: 1.8;
        color: #444;
        margin-bottom: 20px;
    }
    
    /* Info Sidebar */
    .info-sidebar {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        padding: 30px;
        position: sticky;
        top: 100px;
    }
    
    .info-sidebar h4 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #8b5a2b;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #d4af37;
    }
    
    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .info-list li {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }
    
    .info-list li:last-child {
        border-bottom: none;
    }
    
    .info-list li i {
        width: 40px;
        height: 40px;
        background: linear-gradient(45deg, #d4af37, #b8860b);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 18px;
    }
    
    .info-list li .info-text {
        flex: 1;
    }
    
    .info-list li .info-text strong {
        display: block;
        font-size: 14px;
        color: #999;
        font-weight: 500;
    }
    
    .info-list li .info-text span {
        font-size: 16px;
        color: #333;
        font-weight: 600;
    }
    
    .volunteer-box {
        background: linear-gradient(135deg, #28a745, #1e7e34);
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        margin-top: 30px;
    }
    
    .volunteer-box h5 {
        color: #fff;
        font-size: 1.3rem;
        margin-bottom: 15px;
    }
    
    .volunteer-box p {
        color: rgba(255,255,255,0.9);
        margin-bottom: 20px;
    }
    
    .btn-volunteer-lg {
        background: #fff;
        color: #28a745;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        transition: 0.3s;
    }
    
    .btn-volunteer-lg:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        color: #1e7e34;
    }
    
    .btn-register {
        background: linear-gradient(45deg, #d4af37, #b8860b);
        color: #fff;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        transition: 0.3s;
        width: 100%;
        text-align: center;
    }
    
    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(184, 134, 11, 0.4);
        color: #fff;
    }
    
    /* Related Events */
    .related-events-section {
        background: #f9f6ef;
        padding: 60px 0;
    }
    
    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }
    
    .section-title h2 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #8b5a2b;
        position: relative;
        display: inline-block;
        padding-bottom: 15px;
    }
    
    .section-title h2:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, #d4af37, #8b5a2b);
        border-radius: 3px;
    }
    
    .related-card {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        transition: 0.3s;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .related-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .related-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .related-card .related-content {
        padding: 20px;
    }
    
    .related-card h5 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #b8860b;
        margin-bottom: 10px;
    }
    
    .related-card p {
        font-size: 13px;
        color: #666;
        margin-bottom: 10px;
    }
    
    .btn-view {
        color: #d4af37;
        text-decoration: none;
        font-weight: 600;
    }
    
    .btn-view:hover {
        text-decoration: underline;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .event-banner {
            height: 400px;
        }
        
        .event-overlay h1 {
            font-size: 1.5rem;
        }
        
        .event-meta-info {
            flex-direction: column;
            gap: 10px;
        }
        
        .event-content-wrapper {
            padding: 25px;
        }
        
        .info-sidebar {
            margin-top: 30px;
            position: static;
        }
    }
</style>


     <div class="page-title page-title-inner padding-bottom9"
     style="background-image: url('{{ asset('assets/img/banner-kshipreshwar.jpg.jpeg') }}'); background-size: cover;"></div>
    <div class="overlay-page-tile"></div>
    <div class="page-title-content">
        <div class="container">
            <div class="blog-title color-white">
                <h2 class="asas">Event Details</h2>
    

<span style="color: #fff;">
    <a href="/" style="color: #fff;"> Home </a>
    » &nbsp;&nbsp;Events
</span>
            </div>
        </div>
    </div>
</div>

<!-- Event Details Section -->
<section class="event-details-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="event-details-card">
                    <!-- Event Banner -->
                    <div class="event-banner">
                            <img src="{{ asset('assets/img/1526x620_about.jpg') }}" alt="Default Event">
                        
                        @if($event->featured == 1)
                            <span class="featured-badge-lg">🌟 Featured Event</span>
                        @endif
                        
                        <div class="event-overlay">
                            <h1>{{ $event->event_name }}</h1>
                            <div class="event-meta-info">
                                <div class="meta-item">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span>{{ $event->location }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="bi bi-calendar-event"></i>
                                    <span>{{ date('d M Y', strtotime($event->start_date)) }} - {{ date('d M Y', strtotime($event->end_date)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Event Content -->
                    <div class="event-content-wrapper">
                        <div class="event-description">
                            <h3>About This Event</h3>
                            <div class="temple-divider" style="width: 100px; height: 3px; background: linear-gradient(90deg, #d4af37, transparent); margin-bottom: 25px;"></div>
                            {!! $event->description !!}
                        </div>
                        
                        @if($event->volunteer_required == 1)
                        <div class="volunteer-box d-block d-lg-none">
                            <h5>🙏 Join as Volunteer</h5>
                            <p>Be a part of this divine event and serve the devotees</p>
                            <a href="{{ route('volunteer') }}" class="btn-volunteer-lg">Register as Volunteer</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="info-sidebar">
                    <h4>Event Information</h4>
                    <ul class="info-list">
                        <li>
                            <i class="bi bi-calendar-check"></i>
                            <div class="info-text">
                                <strong>Start Date</strong>
                                <span>{{ date('l, d M Y', strtotime($event->start_date)) }}</span>
                            </div>
                        </li>
                        <li>
                            <i class="bi bi-calendar-x"></i>
                            <div class="info-text">
                                <strong>End Date</strong>
                                <span>{{ date('l, d M Y', strtotime($event->end_date)) }}</span>
                            </div>
                        </li>
                        <li>
                            <i class="bi bi-geo-alt"></i>
                            <div class="info-text">
                                <strong>Location</strong>
                                <span>{{ $event->location }}</span>
                            </div>
                        </li>
                        @if($event->registration_last_date)
                        <li>
                            <i class="bi bi-clock-history"></i>
                            <div class="info-text">
                                <strong>Last Registration Date</strong>
                                <span>{{ date('d M Y', strtotime($event->registration_last_date)) }}</span>
                            </div>
                        </li>
                        @endif
                        <li>
                            <i class="bi bi-people"></i>
                            <div class="info-text">
                                <strong>Volunteer Required</strong>
                                <span>{{ $event->volunteer_required == 1 ? 'Yes' : 'No' }}</span>
                            </div>
                        </li>
                    </ul>
                    
                    @if($event->volunteer_required == 1)
                    <div class="volunteer-box d-none d-lg-block">
                        <h5>🙏 Join as Volunteer</h5>
                        <p>Be a part of this divine event and serve the devotees</p>
                        <a href="{{ route('volunteer') }}" class="btn-volunteer-lg">Register as Volunteer</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Events Section -->
@if(isset($relatedEvents) && count($relatedEvents) > 0)
<section class="related-events-section">
    <div class="container">
        <div class="section-title">
            <h2>Related Events</h2>
        </div>
        <div class="row">
            @foreach($relatedEvents as $related)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="related-card">
                    @if($related->banner_image)
                        <img src="{{ asset($related->banner_image) }}" alt="{{ $related->event_name }}">
                    @else
                        <img src="{{ asset('assets/img/default-event.jpg') }}" alt="Default Event">
                    @endif
                    <div class="related-content">
                        <h5>{{ $related->event_name }}</h5>
                        <p><i class="bi bi-calendar"></i> {{ date('d M Y', strtotime($related->start_date)) }}</p>
                        <p><i class="bi bi-geo-alt"></i> {{ Str::limit($related->location, 30) }}</p>
                        <a href="{{ url('event/'.$related->slug) }}" class="btn-view">View Details →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@include('pages.common.footer')