<!doctype html>
<html lang="zxx">
   @php
    $header = DB::table('setting')->first();
   @endphp
   @php
    $youtubeUrl = $header->youtube ?? '';

    preg_match('/(live\/|v=)([^\?&]+)/', $youtubeUrl, $matches);
    $videoId = $matches[2] ?? '';

    $embedUrl = $videoId ? "https://www.youtube.com/embed/".$videoId : '';
    @endphp
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- <title>{{$header->title}}</title> -->
       <title>{{ $header->title }}</title>
      <meta name="keywords" content="क्षिप्रेश्वर धाम केवल एक मंदिर नहीं, बल्कि सनातन संस्कृति, आस्था और आध्यात्मिक चेतना का एक दिव्य अभियान है। यह धाम भगवान शिव की अनंत कृपा को जन-जन तक पहुँचाने और आने वाली पीढ़ियों के लिए एक स्थायी आध्यात्मिक केंद्र स्थापित करने का पवित्र संकल्प है।"/>
      <meta name="description" content="क्षिप्रेश्वर धाम केवल एक मंदिर नहीं, बल्कि सनातन संस्कृति, आस्था और आध्यात्मिक चेतना का एक दिव्य अभियान है। यह धाम भगवान शिव की अनंत कृपा को जन-जन तक पहुँचाने और आने वाली पीढ़ियों के लिए एक स्थायी आध्यात्मिक केंद्र स्थापित करने का पवित्र संकल्प है।"/>
    
      <!-- ===== Open Graph Meta Tags ===== -->
      <meta property="og:title" content="क्षिप्रेश्वर धाम" />
      <meta property="og:description" content="क्षिप्रेश्वर धाम केवल एक मंदिर नहीं, बल्कि सनातन संस्कृति, आस्था और आध्यात्मिक चेतना का एक दिव्य अभियान है। यह धाम भगवान शिव की अनंत कृपा को जन-जन तक पहुँचाने और आने वाली पीढ़ियों के लिए एक स्थायी आध्यात्मिक केंद्र स्थापित करने का पवित्र संकल्प है।" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="" />
      <meta property="og:image" content="assets/kd.png" />
      <!-- ===== Twitter Card Meta Tags ===== -->
       <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:title" content="क्षिप्रेश्वर धाम" />
      <meta name="twitter:description" content="क्षिप्रेश्वर धाम केवल एक मंदिर नहीं, बल्कि सनातन संस्कृति, आस्था और आध्यात्मिक चेतना का एक दिव्य अभियान है। यह धाम भगवान शिव की अनंत कृपा को जन-जन तक पहुँचाने और आने वाली पीढ़ियों के लिए एक स्थायी आध्यात्मिक केंद्र स्थापित करने का पवित्र संकल्प है।" />
      <meta name="twitter:image" content="assets/kd.png" />
      <meta http-equiv="Cache-Control"
      content="no-store, no-cache, must-revalidate, max-age=0">

<meta http-equiv="Pragma"
      content="no-cache">

<meta http-equiv="Expires"
      content="0">
      <link rel="shortcut icon" href="{{ asset($header->favicon) }}" type="images/x-icon"/>
      <!-- css include -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/odometer.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main.css?ver=0005') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

      <!-- Google tag (gtag.js) -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16582651535"></script>
      <!-- Add Font Awesome if not already included -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>

/* =========================
   NO TEXT SELECT
========================= */

body {

    -webkit-user-select: none;

    -moz-user-select: none;

    -ms-user-select: none;

    user-select: none;
}

.header__logo{
    display:flex;
    align-items:center;
}

.logo-title{
    display:flex;
    align-items:center;
    margin-left:8px;
}

.logo-title span{
    font-family: "Noto Serif Devanagari","Kohinoor Devanagari","Mangal",serif;
    font-size:33px;
    font-weight:700;
    color:#000;
    line-height:1;
    letter-spacing:-0.5px;
    white-space:nowrap;

    /* Similar bold print effect */
    -webkit-text-stroke:0.4px #000;
    text-shadow:
        0.3px 0 #000,
       -0.3px 0 #000,
        0 0.3px #000,
        0 -0.3px #000;
}
/* =========================
   IMAGE DRAG DISABLE
========================= */

img {

    pointer-events: none;

    -webkit-user-drag: none;
}

/* =========================
   WATERMARK
========================= */

.security-watermark {

    position: fixed;

    top: 0;

    left: 0;

    width: 100%;

    height: 100%;

    pointer-events: none;

    z-index: 999999;

    opacity: 0.05;

    background-image:
        repeating-linear-gradient(
            -45deg,
            rgba(0,0,0,0.3) 0px,
            rgba(0,0,0,0.3) 1px,
            transparent 1px,
            transparent 120px
        );
}

</style>
    <style>
      .live-darshan-btn {
    position: fixed;
    left: 0;
    top: 40%;
    z-index: 9999;
}
/* UNIQUE WRAPPER */
.insight-sticky-wrapper {
    position: fixed;
    top: 55%;
    right: -10px;
    transform: translateY(-50%);
    z-index: 9999;
}

/* LIST RESET */
.insight-sticky-list {
    margin: 0;
    padding: 0;
}

.insight-sticky-list li {
    list-style: none;
    height: 48px;
    width: 50px;
    margin: 6px 0;
    display: flex;
    align-items: center;
    overflow: hidden;
        border-radius: 30px 0 0 30px;

    cursor: pointer;
    transition: all 0.4s ease;
}

/* ICON */
.insight-sticky-list li i {
    min-width: 50px;
    text-align: center;
    font-size: 18px;
    color: #fff;
}

/* TEXT */
.insight-sticky-list li p {
    margin: 0;
    white-space: nowrap;
    opacity: 0;
    transition: all 0.3s ease;
}

.insight-sticky-list li p a {
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
}

/* HOVER EFFECT (SLIDE OPEN) */
.insight-sticky-list li:hover {
    width: 180px;
}

.insight-sticky-list li:hover p {
    opacity: 1;
    padding-right: 15px;
}

/* OPTIONAL: SMOOTH SHADOW */
.insight-sticky-list li:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

.live-darshan-btn a {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #df4900;
    color: #fff;
    padding: 12px 18px;
    font-weight: 600;
    border-radius: 0 30px 30px 0;
    text-decoration: none;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    transition: 0.3s;
}

.live-darshan-btn a:hover {
    background: #df4900 ;
    padding-left: 25px;
}
.live-darshan-btn a {
    animation: blink 1.2s infinite;
}
h2.asas {
    color: #f45f0a;
    text-shadow: 1px 1px 3px #000;
}

@keyframes blink {
    0% {opacity: 1;}
    50% {opacity: 0.6;}
    100% {opacity: 1;}
}
@media (max-width: 768px) {
    .live-darshan-btn {
        z-index: 1; /* sidebar ke niche */
    }
}
/* Active menu highlight */
.main-menu ul li.active > a,
.main-menu ul li a.active {
    color: #df4900 !important;
    font-weight: 700;
    position: relative;
}
#short_*, #full_* {
    transition: all 0.3s ease;
}
/* underline effect */
.main-menu ul li.active > a::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -5px;
    width: 100%;
    height: 2px;
    background: #df4900;
}

/* hover bhi same */
.main-menu ul li a:hover {
    color: #df4900 !important;
}
    </style>
   </head>
   <body class="demo-travel-agency">
      <div class="body_wrap">
      <!-- header start -->
      <div class="sssss">
         <!-- Header -->
         <div class="cp-widget-button">
            <div data-brand-color="background" onclick="show()" class="cp-widget-button__inner"> <a href="https://api.whatsapp.com/send?phone=9575044096" target="_blank"><img src="assets/img/whatsapp.png" /></a> </div>
         </div>
         <div class="cp-widget-button1">
            <div data-brand-color="background" onclick="show()" class="cp-widget-button__inner1"> <a href="tel:+9575044096"><img src="assets/img/call.png" /></a> </div>
         </div>
      </div>
      <section class="topse">
         <div class="container">
            <div class="row">
               <div class="col-md-6 col-12">
                  <div class="top-calll">
                     <ul class="contact-s">
                        <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:+91 9575044096">+91 9575044096 </a></li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:info.kshipreshwardham@gmail.com">info.kshipreshwardham@gmail.com </a></li>
                     </ul>
                  </div>
               </div>
               <div class="col-md-6 col-12">
                  <!-- <h4 class="detaill"><a href="contact-us.php">Bank Detail </a></h4> -->
  <div class="trsss">
    <div id="google_translate_element"></div>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement(
                {
                    pageLanguage: 'hi',  // Site language is Hindi
                    includedLanguages: 'en,hi,pa',  // Visible languages in dropdown
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                },
                'google_translate_element'
            );
        }
    </script>

    <script type="text/javascript" 
        src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
</div>
               </div>
            </div>
         </div>
      </section>
      <div class="insight-sticky-wrapper">
   <ul class="insight-sticky-list">

      @php
         $icons = json_decode($header->icon_name, true);

         $bgColors = [
            'facebook' => '#4769b1',
            'instagram' => 'radial-gradient(circle at 30% 107%, #c42e5b 0%, #fd5949 45%, #d6249f 60%, #285AEB 90%)',
            'youtube' => '#ce1e21',
            'twitter' => '#000',
            'whatsapp' => '#199529',
         ];

         $iconClasses = [
            'facebook' => 'fab fa-facebook-f',
            'instagram' => 'fab fa-instagram',
            'youtube' => 'fab fa-youtube',
            'twitter' => 'fab fa-twitter',
            'whatsapp' => 'fab fa-whatsapp',
         ];
      @endphp

      @foreach($icons as $item)
         @php $name = strtolower($item['name']); @endphp

         <li style="background: {{ $bgColors[$name] ?? '#333' }}">
            
            <i class="{{ $iconClasses[$name] ?? 'fas fa-link' }}"></i>

            <p>
               <a href="{{ $item['url'] }}" target="_blank">
                  {{ ucfirst($item['name']) }}
               </a>
            </p>

         </li>
      @endforeach

   </ul>
</div>

      <header class="site-header header-style-three">
         <div class="header__wrap stricky">
            <div class="container">
                <div class="header__inner ul_li_between">
                    <div class="header__logo d-flex align-items-center">
                        <a href="{{ url('home') }}" class="d-flex align-items-center text-decoration-none">
                            <img src="{{ asset('assets/kd.png') }}" width="90" alt="">

                            <div class="logo-title ms-2">
                                <span>प्रेम यमुना सेवा ट्रस्ट</span>
                            </div>
                        </a>
                    </div>
                <div class="main-menu__wrap ul_li navbar navbar-expand-lg">
            <nav class="main-menu collapse navbar-collapse">
                <ul>
                    <li class="{{ Request::is('/') ? 'active' : '' }}">
                        <a href="{{ url('/') }}"><span>घर</span></a>
                    </li>

                    <li class="{{ Request::is('about-us') ? 'active' : '' }}">
                        <a href="{{ route('about-us') }}"><span>के बारे में</span></a>
                    </li>

                    <li class="{{ Request::is('donate') ? 'active' : '' }}">
                        <a href="{{ route('donate') }}"><span>दान करें</span></a>
                    </li>

                    <li class="{{ Request::is('volunteer') ? 'active' : '' }}">
                        <a href="{{ route('volunteer') }}"><span>स्वयंसेवक</span></a>
                    </li>

                    <li class="{{ Request::is('events') ? 'active' : '' }}">
                        <a href="{{ route('events') }}"><span>घटनाएँ और अपडेट</span></a>
                    </li>

                    <!-- <li class="{{ Request::is('book-hotels') ? 'active' : '' }}">
                        <a href="{{ route('book-hotels') }}"><span>भक्त निवास</span></a>
                    </li> -->

                    <li class="{{ Request::is('contact') ? 'active' : '' }}">
                        <a href="{{ route('contact') }}"><span>हमसे संपर्क करें</span></a>
                    </li>

                </ul>
            </nav>
        </div>
          
            
            <div class="xb-hamburger-menu">
                <div class="xb-nav-mobile">
                    <div class="xb-nav-mobile-button"><i class="fal fa-bars"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>





         <div class="xb-header-wrap">
            <div class="xb-header-menu">
               <div class="xb-header-menu-scroll">
                  <div class="xb-menu-close xb-hide-xl xb-close"></div>
                  <div class="xb-logo-mobile xb-hide-xl">
                     <a href="index-2.html" rel="home"><img src="assets/kd.png" alt=""></a>
                  </div>
                  <div class="xb-header-mobile-search xb-hide-xl">
                  </div>
                  <nav class="xb-header-nav">
                     <ul class="xb-menu-primary clearfix">
                        <li class=""> <a href="{{ url('/') }}"><span>घर</span></a> </li>
                      
                        <li><a href="{{route('about-us')}}"><span>के बारे में</span></a></li>
                         <li><a href="{{route('donate')}}"><span>दान करें</span></a></li>
                          <li><a href="{{route('volunteer')}}"><span>स्वयंसेवक</span></a></li>
                        <li><a href="{{route('events')}}"><span>घटनाएँ और अपडेट</span></a></li>

                           <li><a href="{{route('book-hotels')}}"><span>भक्त निवास</span></a></li>
                       
                        <li><a href="{{route('contact')}}"><span>हमसे संपर्क करें</span></a></li>
                     </ul>
                  </nav>
               </div>
            </div>
            <div class="xb-header-menu-backdrop"></div>
         </div>
      </header>
      <!-- 🔴 Live Darshan Button -->
<div class="live-darshan-btn">
    <a href="#" data-bs-toggle="modal" data-bs-target="#liveDarshanModal">
        <i class="fa fa-eye"></i> लाइव दर्शन
    </a>
</div>
<!-- 🔴 Live Darshan Modal -->
<!-- 🔴 Live Darshan Modal -->
<div class="modal fade" id="liveDarshanModal" tabindex="-1">
 <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
    <h5 class="modal-title me-2">🔴 लाइव दर्शन</h5>

   

    <button type="button" class="btn btn-sm btn-secondary onclick="openFullScreen()">
    <i class="fas fa-expand"></i>
</button>

<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

      <div class="modal-body p-0">
        <div class="ratio ratio-16x9">

            @if($embedUrl)
               <iframe id="liveFrame"
                    src=""
                    data-src="{{ $embedUrl }}?rel=0&modestbranding=1&controls=1"
                    title="Live Darshan"
                    allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            @else
                <div class="text-center p-5">
                    <h5>लाइव दर्शन अभी उपलब्ध नहीं है</h5>
                </div>
            @endif

        </div>
      </div>

    </div>
  </div>
</div>
      <!-- header end -->
      <!-- Google tag (gtag.js) -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16582651535"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         
         gtag('config', 'AW-16582651535');
      </script>


<script>
document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById('liveDarshanModal');
    var iframe = document.getElementById('liveFrame');

    if(modal){

        // ✅ Open → video load (play)
        modal.addEventListener('shown.bs.modal', function () {
            if(iframe && iframe.dataset.src){
                iframe.src = iframe.dataset.src + "&autoplay=1";
            }
        });

        // ✅ Close → video stop
        modal.addEventListener('hidden.bs.modal', function () {
            if(iframe){
                iframe.src = "";
            }
        });
    }
});
</script>
<script>
function openFullScreen() {
    var iframe = document.getElementById("liveFrame");
    if (iframe.requestFullscreen) {
        iframe.requestFullscreen();
    } else if (iframe.webkitRequestFullscreen) {
        iframe.webkitRequestFullscreen();
    } else if (iframe.msRequestFullscreen) {
        iframe.msRequestFullscreen();
    }
}
</script>
