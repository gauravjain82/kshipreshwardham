<div class="security-watermark"></div>

<script>
/* 
=========================
RIGHT CLICK DISABLE
=========================

document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
});

=========================
COPY / CUT / PASTE
=========================

document.addEventListener('copy', function(e) {
    e.preventDefault();
});

document.addEventListener('cut', function(e) {
    e.preventDefault();
});

document.addEventListener('paste', function(e) {
    e.preventDefault();
});

=========================
TEXT SELECT DISABLE
=========================

document.addEventListener('selectstart', function(e) {
    e.preventDefault();
});

=========================
DRAG DISABLE
=========================

document.addEventListener('dragstart', function(e) {
    e.preventDefault();
});

=========================
DEVTOOLS BLOCK
=========================

document.onkeydown = function(e) {
    // F12
    if (e.keyCode == 123) {
        return false;
    }

    // CTRL + SHIFT + I
    if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
        return false;
    }

    // CTRL + SHIFT + J
    if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
        return false;
    }

    // CTRL + U
    if (e.ctrlKey && e.keyCode == 85) {
        return false;
    }

    // CTRL + S
    if (e.ctrlKey && e.keyCode == 83) {
        return false;
    }

    // CTRL + C
    if (e.ctrlKey && e.keyCode == 67) {
        return false;
    }

    // CTRL + A
    if (e.ctrlKey && e.keyCode == 65) {
        return false;
    }
};

=========================
INSPECT DETECT
=========================

setInterval(function () {
    let widthThreshold = window.outerWidth - window.innerWidth > 160;
    let heightThreshold = window.outerHeight - window.innerHeight > 160;

    if (widthThreshold || heightThreshold) {
        document.body.innerHTML = `
            <div style="
                display:flex;
                justify-content:center;
                align-items:center;
                height:100vh;
                font-size:30px;
                font-weight:bold;
                background:#fff;
            ">
                Developer tools detected
            </div>
        `;
    }
}, 1000);
*/
</script>

<!--
<script>
(function () {
    const fullUrl = window.location.href;

    // detect view-source
    if (fullUrl.startsWith('view-source:')) {
        document.body.innerHTML = '';
        window.stop();
        window.location.href = 'about:blank';
    }
})();
</script>
-->

<!-- footer start -->
@php
    $header = DB::table('setting')->first();
@endphp
<footer class="site-footer bg-white footer-style-three pt-80"
        style="background-image: url('{{ asset('assets/img/testimonial_bg1.png') }}');">
   
   <div class="category-shape1">
      <img src="assets/img/Group6473.png" alt="">
   </div>
   <div class="container pb-20">
      <div class="xb-footer-widget-wrap ul_li">
         <div class="footer__widget">
            <div class="footer-logo " style="width: 145px; font-size: 14px;">
               <a href="{{ url('home') }}">
                  <img src="{{ asset($header->footer_logo) }}" alt="">
               </a>

               <p style="font-size: 15px;">
                  || जय क्षिप्रेश्वर महादेव ||
               </p>
            </div>
         </div>
         <div class="footer__widget">
            <h3 class="widget-title">उपयोगी कड़ियां</h3>
            <ul class="footer__links">
               <li><a href="{{ url('home') }}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> घर</a></li>
               <li><a href="{{route('about-us')}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> के बारे में</a></li>
               <li><a href="{{route('donate')}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> दान करें</a></li>
               <li><a href="{{route('volunteer')}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> स्वयंसेवक</a></li>
               <li><a href="{{route('events')}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> घटनाएँ और अपडेट</a></li>
               <li><a href="{{route('book-hotels')}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> भक्त निवास </a></li>
               <li><a href="{{route('privacy-policy')}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> गोपनीयता नीति </a></li>
               <li><a href="{{route('term_condition')}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> नियम और शर्तें </a></li>
               <li><a href="{{route('refund-policy')}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> धन-वापसी नीति </a></li>
            </ul>
         </div>
         <div class="footer__widget">
            <h3 class="widget-title">स्थान मैप</h3>
            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3667.8606045216125!2d75.72525577509661!3d23.175287179067006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396375a43e4b98e9%3A0x624ece3d81fa6e18!2sShipreshwar%20Dham%20(Shri%20Mahesh%20Guruji)%20Ujjain!5e0!3m2!1sen!2sin!4v1772195211021!5m2!1sen!2sin" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3668.487068313756!2d75.79796607430596!3d23.152416811472154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3963750066315ddb%3A0x19a43a113814b615!2s38%20hariom%20vihar!5e0!3m2!1sen!2sin!4v1784793831348!5m2!1sen!2sin" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
         </div>
         <div class="footer__widget">
            <h3 class="widget-title">हमसे संपर्क करें</h3>
            <ul class="contactus-">
                <li>
                    <i class="fa fa-university" aria-hidden="true"></i>
                    <strong>प्रेम यमुना सेवा ट्रस्ट</strong>
                </li>

                <li>
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <a href="https://maps.app.goo.gl/ZgHE424p7pm54tEw7" target="_blank">
                        113, Hariom Vihar, Mahashakti Nagar,<br>
                        Ujjain (M.P.) - 456010
                    </a>
                </li>

                <li>
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <a href="tel:+919575044096">+91 9575044096</a>
                </li>

                <!-- <li>
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <a href="tel:+{{ $header->mobile_number }}">{{ $header->mobile_number }}</a>
                </li> -->

                <li>
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <a href="tel:+{{ $header->whatsapp_number }}">{{ $header->whatsapp_number }}</a>
                </li>

                <li>
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <a href="mailto:{{ $header->email }}">{{ $header->email }}</a>
                </li>

                <li>
                    <i class="fa fa-globe" aria-hidden="true"></i>
                    <a href="{{ url('home') }}">www.kshipreshwardham.com</a>
                </li>
            </ul>
         </div>
      </div>
   </div>
   <div class="copyright-area ul_li_between">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">
              <div class="copyright-text notranslate" translate="no">
                  <p>
                      <a href="#" target="_blank">
                          {{ $header->footer_line }}
                      </a>
                  </p>
              </div>
            </div>
         </div>
      </div>
   </div>
</footer>

<script>
   const audio = document.getElementById("bellAudio");
   let played = false;
   
   function playSoundOnce() {
     if (played) return;
   
     audio.volume = 1;
     audio.play().catch(err => console.log("Autoplay blocked"));
   
     // stop after 30 seconds
     setTimeout(() => {
       audio.pause();
       audio.currentTime = 0;
     }, 30000);
   
     played = true;
   
     document.removeEventListener("click", playSoundOnce);
     document.removeEventListener("scroll", playSoundOnce);
     document.removeEventListener("touchstart", playSoundOnce);
   }
   
   document.addEventListener("click", playSoundOnce);
   document.addEventListener("scroll", playSoundOnce);
   document.addEventListener("touchstart", playSoundOnce);
</script>
<!-- jquery include -->
<script src="assets/js/jquery-3.7.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/swiper.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/appear.js"></script>
<script src="assets/js/odometer.min.js"></script>
<script src="assets/js/jquery.nice-select.min.js"></script>
<script src="assets/js/imagesloaded.pkgd.min.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/parallax-scroll.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>