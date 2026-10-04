@include('pages.common.header')
<!-- sidebar-info end -->
 <!-- Kumbh Modal -->
  <style>
#kumbhModal .modal-content {
    background: linear-gradient(135deg, #fff8e1, #ffe0b2);
    border-radius: 15px;
    border: 2px solid #ff9800;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
.temple-text {
    display: block;
    white-space: nowrap;   /* desktop पर single line */
    line-height: 1.6;      /* spacing fix */
}

/* mobile पर wrapping allow */
@media (max-width: 768px) {
    .temple-text {
        white-space: normal;   /* अब break होगा */
        line-height: 1.8;      /* lines chipkenge नहीं */
    }
}
#kumbhModal h4 {
    color: #d84315;
    font-weight: bold;
}

#kumbhModal p {
    color: #5d4037;
    font-size: 15px;
}
.about-content {
    font-size: 20px;
    line-height: 1.8;
}

/* CKEditor अंदर के सभी tags को target */
.about-content p,
.about-content span,
.about-content div,
.about-content li {
    font-size: 20px !important;
    line-height: 1.8;
}
#kumbhModal .btn-warning {
    background: linear-gradient(45deg, #ff9800, #ff5722);
    border: none;
    color: #fff;
    border-radius: 30px;
}

#kumbhModal .btn-warning:hover {
    background: linear-gradient(45deg, #e65100, #bf360c);
}

#kumbhModal .modal-content::before {
    content: "🛕";
    font-size: 40px;
    display: block;
    margin-bottom: 10px;
}
</style>
<div class="modal fade" id="kumbhModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4 position-relative">

      <!-- CLOSE BUTTON -->
      <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>

      <h4 class="mb-3">🕉️ सिंहस्थ महाकुंभ 2028</h4>

      <p class="mb-4">
        सिंहस्थ महाकुंभ 2028 से जुड़ी सेवाएं
      </p>

      <a href="{{ url('donate') }}" class="btn btn-warning fw-bold px-4">
      और पढ़ें
      </a>

    </div>
  </div>
</div>
<div class="body-overlay"></div>
<main>
 <div class="toppp-slider1">
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">

    <!-- Indicators -->
    <div class="carousel-indicators">
      @foreach($banner as $key => $item)
        <button type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide-to="{{ $key }}"
          class="{{ $key == 0 ? 'active' : '' }}"
          aria-current="{{ $key == 0 ? 'true' : 'false' }}"
          aria-label="Slide {{ $key + 1 }}">
        </button>
      @endforeach
    </div>

    <!-- Slides -->
    <div class="carousel-inner">
      @foreach($banner as $key => $item)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
          <img src="{{ asset($item->banner_image) }}" class="d-block w-100" alt="Banner {{ $key + 1 }}">
        </div>
      @endforeach
    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button"
      data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button"
      data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>

  </div>
</div>
   <section class="marquee">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-12">
            <marquee>
               <p>
              🌼🔔🔔🌼|| जय क्षिप्रेश्वर धाम ||🌼🔔🔔🌼 बाबा शिप्रेश्वर की दिव्य छत्रछाया आपके जीवन से भय, बाधाएँ और संकट दूर करे तथा सुख-समृद्धि व विजय का आशीष प्रदान करें। 🌼🔔🔔🌼 || जय क्षिप्रेश्वर धाम ||🌼🔔🔔🌼 बाबा शिप्रेश्वर की दिव्य छत्रछाया आपके जीवन से भय, बाधाएँ और संकट दूर करे तथा सुख-समृद्धि व विजय का आशीष प्रदान करें। 🌼🔔🔔🌼   
               </p>
            </marquee>
     
         </div>
      </div>
   </div>
   <!-- about start -->
   <section class="about-us-section pb-60 pt-60" style="background-image: url(assets/img/bg-one1.png); background-attachment: fixed; background-size: cover;">
    <div class="container">
        <div class="row align-items-center mt-none-30">
            <div class="col-lg-6 mt-30">
                <div class="xb-about xb-about2">
                    <div class="xb-item--img text-center pos-rel">
                        <div class="xb-item--main-img">
                            <img src="assets/img/362x456.jpg" alt="">
                        </div>
                        <div class="xb-item--sml-img1">
                            <img src="assets/img/178x188.jpg" alt="">
                        </div>
                        <div class="xb-item--sml-img2">
                            <img src="assets/img/145x153.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-30">
                <div class="xb-travel-about-content">
                    <div class="sec-title sec-title--travel abouttt">
                        <span class="subtitle">आपका स्वागत है</span>
                        <h2 class="mb-25">क्षिप्रेश्वर धाम</h2>
                        <p class="mb-25" about-content"> {!! $frontend->about_us !!}

                        </p>
                    </div>
                    <div class="about-k ddd1">
                        <a href="{{route('about-us')}}">और पढ़ें</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Three Boxes Section - Our Mission, Our Vision, and Our Values -->
        <!-- <div class="row mt-60">
            <div class="col-md-4">
                <div class="xb-feature-box text-center" style="background: #fff; padding: 30px 20px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); height: 100%;">
                    <div class="xb-feature--icon mb-20">
                        <i class="fas fa-bullseye" style="font-size: 48px; color: #f7b731;"></i>
                    </div>
                    <h3 style="color: #333; margin-bottom: 15px;">Our Mission</h3>
                    <p style="color: #666; margin-bottom: 0;">To preserve and promote the sacred heritage of Baba Kshipreshwar Mahadev Temple while providing spiritual guidance and peace to all devotees who seek blessings.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="xb-feature-box text-center" style="background: #fff; padding: 30px 20px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); height: 100%;">
                    <div class="xb-feature--icon mb-20">
                        <i class="fas fa-eye" style="font-size: 48px; color: #f7b731;"></i>
                    </div>
                    <h3 style="color: #333; margin-bottom: 15px;">Our Vision</h3>
                    <p style="color: #666; margin-bottom: 0;">To become a beacon of spiritual enlightenment and cultural preservation, spreading the divine wisdom of Baba Kshipreshvar across the world.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="xb-feature-box text-center" style="background: #fff; padding: 30px 20px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); height: 100%;">
                    <div class="xb-feature--icon mb-20">
                        <i class="fas fa-heart" style="font-size: 48px; color: #f7b731;"></i>
                    </div>
                    <h3 style="color: #333; margin-bottom: 15px;">Our Values</h3>
                    <p style="color: #666; margin-bottom: 0;">Rooted in devotion, compassion, and tradition, we strive to maintain the sanctity of the temple and serve humanity with love and humility.</p>
                </div>
            </div>
        </div> -->
    </div>
    
    <div class="xb-about-shape">
        <img src="assets/img/shape/about_shape.html" alt="">
    </div>
    
</section>
   <!-- about end -->
      <marquee behavior="scroll" direction="left">

    <p class="text-white"> 🌼 📞 शिवमहापुराण, भागवत, रामकथा एवं देवी भागवत कथा करवाने हेतु संपर्क सूत्र -
    
    <a href="tel:+919575044096" style="color:#ffff;">9575044096</a>, 
    <a href="tel:+917987651007" style="color:#ffff;">7987651007</a>, 
    <a href="tel:+917879780667" style="color:#ffff;">7879780667</a> 🌼 </p>

</marquee>
   <section class="package package-bg pos-rel pt-60 pb-60" style="background-image: url(assets/img/bpackage_bg1.jpg);  background-size: cover; background-position:  center center;">
      <div class="category-shape1">
         <img src="assets/img/Group6473.png" alt="">
      </div>
      <div class="container">
         <div class="sec-title sec-title--travel text-center mb-55">
            <span class="subtitle">उद्देश्य
            </span>
            <h2> <span>क्षिप्रेश्वर</span>   धाम  🪔 </h2>
         </div>
         <div class="row mt-none-30">

   <!-- Box 1 -->
 @foreach($objectives as $item)
<div class="col-lg-4 col-md-6">

   <div class="xb-package mt-30" style="background:#fff; border-radius:12px; box-shadow:0 8px 20px rgba(0,0,0,0.08);">
      
      <div class="xb-item--inner">

         <!-- Image -->
         <div class="xb-item--img">
            <a href="#">
               <img src="{{ asset($item->image) }}" alt="" style="width:100%;">
            </a>
         </div>

         <!-- Content -->
         <div class="xb-item--holder" style="padding:20px; color:#000;">

            <!-- Title -->
            <h2 class="xb-item--title">
               <a href="#" style="color:#000; text-decoration:none;">
                  {{ $item->title }}
               </a>
            </h2>

            <!-- Description -->
            <!-- <p style="color:#444; margin-top:10px;">
               {!! Str::limit(strip_tags($item->description), 100) !!}
            </p> -->

            <!-- Button -->
            <div class="about-k ddd" style="margin-top:15px;">
               <a href="{{ $item->redirect }}">और पढ़ें</a>
            </div>

         </div>

      </div>

   </div>

</div>
@endforeach

</div>
      </div>
   </section>

<section class="hero hero__style-three pos-rel bg_img" data-background="assets/img/hero_bg-3.jpg" style="background-image: url(&quot;assets/img/hero_bg-3.jpg&quot;);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-7">
                        <div class="xb-hero-content2 pos-rel">
                            <div class="xb-item--holder">
                                <span class="mb-5 temple-text">
                                        मंदिर में विशेष पूजा, हवन और अनुष्ठानों की सुविधा उपलब्ध है।
                                    </span>
                                <h1 class="xb-item--title">📿 यहां पूजा बुक करें <br> क्षिप्रेश्वर धाम</h1>
                                <p class="text-justify">यदि आप अपने जीवन में सुख शांति, समृद्धि या किसी विशेष कार्य सिद्धि हेतु पूजन, हवन या विशेष अनुष्ठान करवाना चाहते हैं, तो आप मंदिर में आकर या अपने घर से भी पूर्ण विधि विधान एवं योग्य आचार्यों के मार्गदर्शन में यह पावन कार्य करवा सकते हैं।
मंदिर प्रशासन के साथ इस दिव्य अनुष्ठान का लाभ लें और अपने जीवन में सकारात्मक ऊर्जा, सुख एवं शांति का अनुभव करें।.

</p>
<div class="mt-4">
            <a href="tel:7987651007" class="thm-btn5 btn-grad1 d-inline-flex align-items-center gap-2">
                <i class="fa fa-phone"></i>
                अभी कॉल करें
            </a>
        </div>
                            </div>
                          <!--   <div class="xb-item--btn btns gap-20">
                                <a class="thm-btn5 btn-grad1" href="https://maabaglamukhiofficial.org/webservices/">Book Puja<span><img src="assets/img/icon/arrow-right.svg" alt=""></span></a>
                        
                            </div> -->
                        </div>
                    </div>




                <div class="col-xl-5 col-lg-5 mt-50">
                         <div class="cr-testtimonial-wrapper">










<div class="cr-testtimonial-slider swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
  <div class="swiper-wrapper" id="swiper-wrapper-75108221d91066afc1" aria-live="off" style="transform: translate3d(-1030px, 0px, 0px); transition-duration: 0ms;"><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="4" style="width: 515px;" role="group" aria-label="1 / 7"  onclick="window.location.href='{{ url('donate') }}'">
      <div class="cr-testimonial-item cr-tes-item-2"> <img src="assets/img/maabaglamukhiofficial-05.jpg" alt="">
        <div class="xb-item--inner">
          <div class="xb-item--avatar text-center">
            <h3 class="xb-item--author jkll">भंडारा सेवा</h3>
          </div>
          <p class="xb-item--content">शत्रुनाश, कानूनी विजय, बाधा निवारण और शत्रुओं से सुरक्षा के लिए क्षिप्रेश्वर हवन.</p>
          <div class="xb-item--holder ul_li text-center"> </div>
        <!--   <div class="xb-item--btn btns gap-20"> <a class="thm-btn1 btn-block btn-grad" href="https://maabaglamukhiofficial.org/webservices/"> Book Puja<span><img src="assets/img/icon/arrow-right.svg" alt="" /></span> </a> </div> -->
        </div>
      </div>
    </div>
    <div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="0" style="width: 515px;" role="group" aria-label="2 / 7"  onclick="window.location.href='{{ url('donate') }}'">
      <div class="cr-testimonial-item"> <img src="assets/img/003.jpg" alt="">
        <div class="xb-item--inner">
          <div class="xb-item--avatar text-center">
            <h3 class="xb-item--author jkll">क्षिप्रेश्वर हवन </h3>
          </div>
          <p class="xb-item--content">महामृत्युंजय हवन, रुद्र हवन,  पंचाक्षरी मंत्र हवन, दारिद्र्य दहन हवन, शिव महापुराण हवन, शिवाष्टक हवन.</p>
          <div class="xb-item--holder ul_li text-center"> </div>
      <!--     <div class="xb-item--btn btns gap-20"> <a class="thm-btn1 btn-block btn-grad" href="https://maabaglamukhiofficial.org/webservices/"> Book Puja<span><img src="assets/img/icon/arrow-right.svg" alt="" /></span> </a> </div> -->
        </div>
      </div>
    </div>


    <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="1" style="width: 515px;" role="group" aria-label="3 / 7" onclick="window.location.href='{{ url('donate') }}'">
      <div class="cr-testimonial-item cr-tes-item-2"> <img src="assets/img/0001.png" alt="">
        <div class="xb-item--inner">
          <div class="xb-item--avatar text-center">
            <h3 class="xb-item--author jkll">क्षिप्रेश्वर पूजा</h3>
          </div>
          <p class="xb-item--content">इसके अंतर्गत आप एक दिवसीय पूजन एवं शृंगार बाबा का करवा सकते हैं।.</p>
          <div class="xb-item--holder ul_li text-center"> </div>
       <!--    <div class="xb-item--btn btns gap-20"> <a class="thm-btn1 btn-block btn-grad" href="https://maabaglamukhiofficial.org/webservices/"> Book Puja<span><img src="assets/img/icon/arrow-right.svg" alt="" /></span> </a> </div> -->
        </div>
      </div>
    </div>


    


     <div class="swiper-slide" data-swiper-slide-index="3" style="width: 515px;" role="group" aria-label="5 / 7" onclick="window.location.href='{{ url('donate') }}'">
      <div class="cr-testimonial-item cr-tes-item-2"> <img src="assets/img/002.jpg" alt="">
        <div class="xb-item--inner">
          <div class="xb-item--avatar text-center">
            <h3 class="xb-item--author jkll">क्षिप्रेश्वर अनुष्ठान </h3>
          </div>
          <p class="xb-item--content">आप अपनी कुंडली दिखा कर विशेष पूजन अनुष्ठान क्षिप्रेश्वर धाम में करवा सकते हैं।.</p>
          <div class="xb-item--holder ul_li text-center"> </div>
       <!--    <div class="xb-item--btn btns gap-20"> <a class="thm-btn1 btn-block btn-grad" href="https://maabaglamukhiofficial.org/webservices/"> Book Puja<span><img src="assets/img/icon/arrow-right.svg" alt="" /></span> </a> </div> -->
        </div>
      </div>
    </div>




  <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev" data-swiper-slide-index="0" style="width: 515px;" role="group" aria-label="7 / 7" onclick="window.location.href='{{ url('donate') }}'">
      <div class="cr-testimonial-item"> <img src="assets/img/0001.png" alt="">
        <div class="xb-item--inner">
          <div class="xb-item--avatar text-center">
            <h3 class="xb-item--author jkll">क्षिप्रेश्वर पूजा</h3>
          </div>
          <p class="xb-item--content">इसके अंतर्गत आप एक दिवसीय पूजन एवं शृंगार बाबा का करवा सकते हैं।.</p>
          <div class="xb-item--holder ul_li text-center"> </div>
      <!--     <div class="xb-item--btn btns gap-20"> <a class="thm-btn1 btn-block btn-grad" href="https://maabaglamukhiofficial.org/webservices/"> Book Puja<span><img src="assets/img/icon/arrow-right.svg" alt="" /></span> </a> </div> -->
        </div>
      </div>
    </div></div>
<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
















                    <div class="cr-tesmonial-btn">
                        <div class="cr-tes-btn crt-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-75108221d91066afc1">
                            <svg width="20" height="20" viewBox="0 0 39 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23.0987 15.9192L8.61367 1.29625C8.42587 1.10666 8.17006 1 7.90326 1H2.39757C1.50897 1 1.06176 2.07243 1.68716 2.70375L15.4783 16.6262C15.8657 17.0173 15.8642 17.6479 15.475 18.0371L1.70657 31.8055C1.07657 32.4354 1.52277 33.5126 2.41367 33.5126H7.90597C8.17127 33.5126 8.42557 33.4072 8.61307 33.2197L23.092 18.7409C23.8704 17.9624 23.8734 16.7013 23.0987 15.9192Z" fill="#fb3e2d"></path>
                            <path d="M37.5986 15.9192L23.1137 1.29625C22.9259 1.10666 22.6701 1 22.4033 1H16.8976C16.009 1 15.5618 2.07243 16.1872 2.70375L29.9783 16.6262C30.3657 17.0173 30.3642 17.6479 29.975 18.0371L16.2066 31.8055C15.5766 32.4354 16.0228 33.5126 16.9137 33.5126H22.406C22.6713 33.5126 22.9256 33.4072 23.1131 33.2197L37.5919 18.7409C38.3704 17.9624 38.3734 16.7013 37.5986 15.9192Z" fill="#fb3e2d"></path>
                          </svg>
                        </div>
                        <div class="cr-tes-btn crt-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-75108221d91066afc1">
                            <svg width="20" height="20" viewBox="0 0 39 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.9013 15.9192L30.3863 1.29625C30.5741 1.10666 30.8299 1 31.0967 1H36.6024C37.491 1 37.9382 2.07243 37.3128 2.70375L23.5217 16.6262C23.1343 17.0173 23.1358 17.6479 23.525 18.0371L37.2934 31.8055C37.9234 32.4354 37.4772 33.5126 36.5863 33.5126H31.094C30.8287 33.5126 30.5744 33.4072 30.3869 33.2197L15.908 18.7409C15.1296 17.9624 15.1266 16.7013 15.9013 15.9192Z" fill="#fb3e2d"></path>
                            <path d="M1.40137 15.9192L15.8863 1.29625C16.0741 1.10666 16.3299 1 16.5967 1H22.1024C22.991 1 23.4382 2.07243 22.8128 2.70375L9.02171 16.6262C8.63434 17.0173 8.63583 17.6479 9.02505 18.0371L22.7934 31.8055C23.4234 32.4354 22.9772 33.5126 22.0863 33.5126H16.594C16.3287 33.5126 16.0744 33.4072 15.8869 33.2197L1.40806 18.7409C0.629618 17.9624 0.626631 16.7013 1.40137 15.9192Z" fill="#fb3e2d"></path>
                          </svg>
                        </div>
                    </div>
                </div>
                        </div>
















                </div>
            </div>
          <!--   <h2 class="xb-hero-strock-text">Travel Worldwide</h2>
            <div class="xb-hero-shape">
                <img src="assets/img/shape/hr_shape.png" alt="">
            </div> -->
        </section>

<section class="testimonial pt-70 pb-70 bg_img" data-background="assets/img/testimonial_bg.png" style="background-size: cover; background-attachment: fixed; background-position: center center;">
    <div class="container">
        <div class="sec-title sec-title--travel text-center mb-60">
            <span class="subtitle">भक्तों के अनुभव</span>
            <h2>क्षिप्रेश्वर धाम के बारे में क्या कहते हैं श्रद्धालु</h2>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="xb-swiper-sliders">
                    <div class="xb-carousel-inner">
                        <div class="xb-testimonial-slider xb-swiper-container swiper-container">
                            <div class="swiper-wrapper">
                                <!-- Testimonial 1 -->
                                <div class="swiper-slide xb-swiper-slide">
                                    <div class="xb-item--inner bg-whitee">
                                        <div class="xb-item--author ul_li mb-10">
                                            <h3 class="xb-item--name">विनय कपूर</h3>
                                            <span class="xb-item--designation" style="color: #f7b731; margin-left: 10px;">⭐ ⭐ ⭐ ⭐ ⭐</span>
                                        </div>
                                        <div class="xb-item--content mb-30" style="font-size: 16px; line-height: 1.8; color: #555;">
                                            "बहुत ही शांत और पवित्र स्थान है। शहर की भीड़-भाड़ से बिल्कुल दूर सुकून मिलता है। 
                                            गुरुजी महाराज से मिलने का सौभाग्य मिला, उनका स्वभाव बहुत ही सरल और विनम्र है। 
                                            कथा का श्रवण किया और भंडारे का प्रसाद लिया, बहुत अच्छा अनुभव रहा।"
                                        </div>
                                        <div class="xb-item--bottom ul_li_between">
                                            <ul class="xb-star-rating">
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Testimonial 2 -->
                                <div class="swiper-slide xb-swiper-slide">
                                    <div class="xb-item--inner bg-whitee">
                                        <div class="xb-item--author ul_li mb-10">
                                            <h3 class="xb-item--name">रक्षित गुलानी</h3>
                                            <span class="xb-item--designation" style="color: #f7b731; margin-left: 10px;">⭐ ⭐ ⭐ ⭐ ⭐</span>
                                        </div>
                                        <div class="xb-item--content mb-30" style="font-size: 16px; line-height: 1.8; color: #555;">
                                            "उज्जैन में घूमने के दौरान क्षिप्रेश्वर धाम में आना हुआ। यहाँ का वातावरण बहुत ही सकारात्मक और शांत है। 
                                            कथा पंडाल में बैठकर कथा सुनी, मन को बहुत शांति मिली। गुरुजी महाराज का व्यवहार बेहद अच्छा है। 
                                            जरूर आना चाहिए।"
                                        </div>
                                        <div class="xb-item--bottom ul_li_between">
                                            <ul class="xb-star-rating">
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Testimonial 3 -->
                                <div class="swiper-slide xb-swiper-slide">
                                    <div class="xb-item--inner bg-whitee">
                                        <div class="xb-item--author ul_li mb-10">
                                            <h3 class="xb-item--name">कनक मिश्रा</h3>
                                            <span class="xb-item--designation" style="color: #f7b731; margin-left: 10px;">⭐ ⭐ ⭐ ⭐ ⭐</span>
                                        </div>
                                        <div class="xb-item--content mb-30" style="font-size: 16px; line-height: 1.8; color: #555;">
                                            "यह स्थान अभी प्राकृतिक वातावरण के बीच खुला खुला लगता है, जहाँ भक्त निवास और कथा पंडाल की अच्छी व्यवस्था है। 
                                            यहाँ कथा हो रही थी जब मेरा जाना हुआ, और गुरुजी महाराज का अनुभव साफ झलकता है। 
                                            यहाँ आकर भंडारे का प्रसाद लिया, बहुत ही संतोष मिला।"
                                        </div>
                                        <div class="xb-item--bottom ul_li_between">
                                            <ul class="xb-star-rating">
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Testimonial 4 -->
                                <div class="swiper-slide xb-swiper-slide">
                                    <div class="xb-item--inner bg-whitee">
                                        <div class="xb-item--author ul_li mb-10">
                                            <h3 class="xb-item--name">प्रवीण पटेल</h3>
                                            <span class="xb-item--designation" style="color: #f7b731; margin-left: 10px;">⭐ ⭐ ⭐ ⭐ ⭐</span>
                                        </div>
                                        <div class="xb-item--content mb-30" style="font-size: 16px; line-height: 1.8; color: #555;">
                                            "बहुत ही दिव्य जगह है। यहाँ आने के बाद मन शांत हो जाता है। गुरुजी महाराज से मिलकर बहुत अच्छा लगा, 
                                            उनका स्वभाव बहुत ही मधुर और सरल है। कथा का श्रवण किया और प्रसाद ग्रहण किया, 
                                            एक अलग ही अनुभूति हुई।"
                                        </div>
                                        <div class="xb-item--bottom ul_li_between">
                                            <ul class="xb-star-rating">
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Testimonial 5 -->
                                <div class="swiper-slide xb-swiper-slide">
                                    <div class="xb-item--inner bg-whitee">
                                        <div class="xb-item--author ul_li mb-10">
                                            <h3 class="xb-item--name">अमन देवकोंडा</h3>
                                            <span class="xb-item--designation" style="color: #f7b731; margin-left: 10px;">⭐ ⭐ ⭐ ⭐ ⭐</span>
                                        </div>
                                        <div class="xb-item--content mb-30" style="font-size: 16px; line-height: 1.8; color: #555;">
                                            "अगर आप उज्जैन शहर की भागदौड़ से दूर शांति चाहते हैं तो यह स्थान बहुत अच्छा है। 
                                            उज्जैन आने के दौरान यहाँ आना हुआ। मुझ यहां का चमत्कारी पेड़ देखना था। 
                                            और शाम को भोजन यही किया जो निशुल्क था।"
                                        </div>
                                        <div class="xb-item--bottom ul_li_between">
                                            <ul class="xb-star-rating">
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Testimonial 6 -->
                                <div class="swiper-slide xb-swiper-slide">
                                    <div class="xb-item--inner bg-whitee">
                                        <div class="xb-item--author ul_li mb-10">
                                            <h3 class="xb-item--name">कर्नल उदयभान ठाकुर</h3>
                                            <span class="xb-item--designation" style="color: #f7b731; margin-left: 10px;">⭐ ⭐ ⭐ ⭐ ⭐</span>
                                        </div>
                                        <div class="xb-item--content mb-30" style="font-size: 16px; line-height: 1.8; color: #555;">
                                            "यहाँ का माहौल बहुत ही शांत और आध्यात्मिक है। अभी आश्रम में कथा पंडाल और भक्त निवास की व्यवस्था है 
                                            और आगे मंदिर निर्माण की योजना है। गुरुजी महाराज बहुत ही अच्छा है, 
                                            उनसे मिलकर बहुत अच्छा अनुभव हुआ।"
                                        </div>
                                        <div class="xb-item--bottom ul_li_between">
                                            <ul class="xb-star-rating">
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Testimonial 7 -->
                                <div class="swiper-slide xb-swiper-slide">
                                    <div class="xb-item--inner bg-whitee">
                                        <div class="xb-item--author ul_li mb-10">
                                            <h3 class="xb-item--name">हिमांगिनी कालंतरी</h3>
                                            <span class="xb-item--designation" style="color: #f7b731; margin-left: 10px;">⭐ ⭐ ⭐ ⭐ ⭐</span>
                                        </div>
                                        <div class="xb-item--content mb-30" style="font-size: 16px; line-height: 1.8; color: #555;">
                                            "उज्जैन में दर्शन के साथ यहाँ आकर समय बिताना बहुत अच्छा लगा। कथा सुनने का अवसर मिला और भंडारे का प्रसाद भी लिया। 
                                            गुरुजी महाराज बहुत ही सरल और सहज व्यक्ति हैं। यहाँ की शांति मन को छू जाती है।"
                                        </div>
                                        <div class="xb-item--bottom ul_li_between">
                                            <ul class="xb-star-rating">
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Testimonial 8 -->
                                <div class="swiper-slide xb-swiper-slide">
                                    <div class="xb-item--inner bg-whitee">
                                        <div class="xb-item--author ul_li mb-10">
                                            <h3 class="xb-item--name">शक्ति आंध्रा</h3>
                                            <span class="xb-item--designation" style="color: #f7b731; margin-left: 10px;">⭐ ⭐ ⭐ ⭐ ⭐</span>
                                        </div>
                                        <div class="xb-item--content mb-30" style="font-size: 16px; line-height: 1.8; color: #555;">
                                            "बहुत ही अच्छा और सुकून भरा स्थान है। खुला वातावरण और प्रकृति के बीच स्थित यह जगह अलग ही अनुभव देती है। 
                                            कथा का आयोजन लगातार होता रहता है, जिससे आध्यात्मिक माहौल बना रहता है। 
                                            गुरुजी महाराज का स्वभाव बहुत ही विनम्र है।"
                                        </div>
                                        <div class="xb-item--bottom ul_li_between">
                                            <ul class="xb-star-rating">
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                                <li><i class="fas fa-star" style="color: #f7b731;"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- View All Feedback Button
            <div class="bookpuja1 dddsw text-center mt-40" style="margin-top: 40px; width: 100%;">
                <a href="#" class="btn-grad111" style="display: inline-block; background: linear-gradient(145deg, #f7b731, #e5a823); color: #fff; padding: 15px 40px; border-radius: 50px; font-size: 18px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 20px rgba(247, 183, 49, 0.3);">
                    और समीक्षाएं देखें <i class="fa fa-long-arrow-right" aria-hidden="true" style="margin-left: 10px;"></i>
                </a>
            </div> -->
        </div>
    </div>
</section>


    
</main>
<!-- testimonial start -->
<section class="testimonial pt-70 pb-70 bg_img"
    style="background-image: url('{{ asset('assets/img/testimonial_bg.png') }}'); background-size: cover; background-attachment: fixed; background-position: center center;">

<div class="container">

    <div class="sec-title sec-title--travel text-center mb-60">
        <h2 class="xb-item--title">📿 लाइव दर्शन</h2>
    </div>

    <div class="row">

        @foreach($gallery as $item)

            <div class="col-lg-4 col-md-6 mb-4">

                <div class="ratio ratio-16x9">

                    {{-- ✅ IMAGE --}}
                    @if($item->gallery_images)
                        <img src="{{ asset($item->gallery_images) }}" 
                             style="width:100%; height:100%; object-fit:cover;" 
                             alt="Gallery Image">

                    {{-- ✅ YOUTUBE --}}
                    @elseif($item->youtube_url)

                        @php
                            preg_match('/(live\/|v=)([^\?&]+)/', $item->youtube_url, $matches);
                            $videoId = $matches[2] ?? '';
                        @endphp

                        @if($videoId)
                            <iframe 
                                src="https://www.youtube.com/embed/{{ $videoId }}"
                                title="Live Darshan"
                                allow="autoplay; encrypted-media"
                                allowfullscreen>
                            </iframe>
                        @else
                            <div class="text-center p-4">Invalid Video</div>
                        @endif

                    @endif

                </div>

            </div>

        @endforeach

    </div>

</div>
</section>
<!-- testimonial end -->
@include('pages.common.footer')
<script>
document.addEventListener("DOMContentLoaded", function () {

    setTimeout(function () {
        var kumbhModal = new bootstrap.Modal(document.getElementById('kumbhModal'));
        kumbhModal.show();

        // auto close after 5 sec
        setTimeout(function () {
            kumbhModal.hide();
        }, 5000);

    }, 1500);

});
</script>