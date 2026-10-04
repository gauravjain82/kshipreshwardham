@include('pages.common.header')
  @php
   
    $top = DB::table('top_banner')->first();

   @endphp
<style>
.events-section {
    background: #f9f6ef;
}

.event-card {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    transition: 0.3s ease;
}

.event-card:hover {
    transform: translateY(-5px);
}

.event-image {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.event-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.featured-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #d4af37;
    color: #fff;
    padding: 4px 10px;
    font-size: 12px;
    border-radius: 20px;
}

.event-title a {
    color: #b8860b;
    font-weight: 600;
    text-decoration: none;
}

.event-title a:hover {
    text-decoration: underline;
}

.event-location,
.event-date {
    font-size: 14px;
    color: #555;
}

.event-desc {
    font-size: 14px;
    color: #666;
}
.btn-volunteer {
    display: inline-block;
    background: #28a745;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    transition: 0.3s;
}

.btn-volunteer:hover {
    background: #1e7e34;
    color: #fff;
}
</style>
<!-- Page Banner -->
<div class="page-title page-title-inner padding-bottom9"
     style="background-image: url('{{ asset('admin/eventbanner.jpg') }}'); background-size: cover;">
     
    <div class="overlay-page-tile"></div>
    <div class="page-title-content">
        <div class="container">
            <div class="blog-title color-white">
                <h2 class="asas">श्री क्षिप्रेश्वर धाम</h2>
                       <span style="color: #fff;">
    <a href="/" style="color: #fff;"> Home </a>
    » &nbsp;&nbsp;Events
</span>
              
            </div>
        </div>
    </div>
</div>

<!-- Events Section -->
<section class="events-ssssection py-5">
<div class="container">
<div class="row">

@forelse($events as $event)

<div class="col-lg-4 col-md-6 mb-4">
<div class="event-card shadow-sm">

    <!-- Banner -->
    <div class="event-image">
        @if($event->banner_image)
            <img src="{{ asset($event->banner_image) }}" class="img-fluid">
        @else
            <img src="{{ asset('assets/img/default.jpg') }}" class="img-fluid">
        @endif

        @if($event->featured == 1)
            <span class="featured-badge">प्रदर्शित</span>
        @endif
    </div>

    <!-- Content -->
    <div class="event-content p-3">

        <h5 class="event-title">
            <a href="{{ route('event.details', $event->id) }}">
                {{ $event->event_name }}
            </a>
        </h5>

        <p class="event-location">
            <i class="bi bi-geo-alt-fill"></i>
            {{ $event->location }}
        </p>

        <p class="event-date">
            <i class="bi bi-calendar-event"></i>
            {{ date('d M Y', strtotime($event->start_date)) }}
            -
            {{ date('d M Y', strtotime($event->end_date)) }}
        </p>

        <div class="event-meta mt-2">

            @if($event->volunteer_required == 1)
                <span class="badge bg-success">स्वयंसेवी आवश्यक</span>
            @endif

            @if($event->start_date)
                <span class="badge bg-warning text-dark">
                    प्रारंभ:
                    {{ date('d M', strtotime($event->start_date)) }}
                </span>
            @endif

        </div>

        <p class="event-desc mt-3">
            {!! Str::limit(strip_tags($event->description), 120) !!}
        </p>
       <div class="about-k ddd1">
        <a href="{{ route('event.details', $event->id) }}" class="btn-view">विवरण देखें →</a>

    @if($event->volunteer_required == 1)
        <a href="{{ route('volunteer') }}" class="btn-volunteer mt-2 ms-2">
            स्वयंसेवक
        </a>
    @endif
</div>
    </div>
</div>
</div>

@empty
<div class="col-12 text-center">
    <h5>कोई इवेंट उपलब्ध नहीं</h5>
</div>
@endforelse

</div>
</div>
</section>

@include('pages.common.footer')