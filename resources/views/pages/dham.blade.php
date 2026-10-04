@include('pages.common.header')
<div class="page-title page-title-inner padding-bottom9" style=" background-image: url(assets/img/1526x620_about.jpg);
   background-repeat: no-repeat;
   background-position: center;
   background-size: cover;">
   <div class="overlay-page-tile"></div>
   <div class="page-title-content">
      <div class="container">
         <div class="blog-title color-white">
            <h2 style="color:#f9f6ef !important;">धाम </h2>
            <span><a href="/" class="hv-color-st1 color-white"> Home </a>  »  &nbsp;&nbsp;धाम</span>
         </div>
      </div>
   </div>
</div>



<div class="container">
  <div class="row align-items-center">
    <div class="col-md-12">
      <div class="iner-text text-center">
        <h4 class="typing-animation">पंडित प्रदीप मिश्रा जी के संकल्प</h4>
        <p class="animated-text" style="font-size: 18px; line-height: 1.8; color: #555; max-width: 800px; margin: 0 auto;">
          जो अपने लिए ना जी कर दूसरों के लिए जीएं, अपना पूरा समय मानवता की सेवा और सनातन धर्म के उत्थान के लिए दें, ऐसे महापुरुष का हमारी इस पावन धरती पर होना गर्व की बात है। पूज्य गुरुदेव के संकल्पों ने मानव कल्याण की परिभाषा को एक नया आयाम दिया है। ना जाति, ना धर्म और ना समुदाय…बिना किसी भेदभाव के जो मानव सेवा को भी अपना धर्म समझे ऐसे संत को नमन। आइए इस संकल्पों के बारे में जानते हैं।
        </p>
      </div>
    </div>
  </div>
</div>

<section class="inner-page">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-12">
        <div class="iner-text side-by">
          <img src="https://kubreshwardham.org/wp-content/uploads/2024/12/1X3A4723-1536x863.jpg" alt="गौशाला" class="float-animation">
          <div>
            <h4 class="pulse-animation">मुरलीमनोहर गौशाला</h4>
            <p class="animated-text">हमारे देश में गाय को माता की तरह पूजा जाता है और इसका मान दुनियाभर के हिन्दू करे इसके लिए पूज्य गुरुदेव ने नारा दिया है – "गौशाला नहीं उपाय, एक हिन्दू…एक गाय"। गुरुदेव का मानना है कि अगर आप एक गाय नहीं भी रख सकते हैं तो अगर आपके आसपास कोई गरीब गाय पाल रहा है तो आप हर महीने उसे ही कुछ धनराशि दे दें ताकि वह गरीब गाय को भरण – पोषण कर सके और उस गाय से जो दूध हो उससे अपने परिवार का भरण – पोषण कर पाएगा।</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row align-items-center nextt">
      <div class="container" style="padding:40px 0;">
        <div class="row" style="row-gap:20px;">
          
          <!-- Image Gallery with Animations -->
          <div class="col-lg-3 col-md-4 col-sm-6 gallery-item">
            <img src="https://kubreshwardham.org/wp-content/uploads/2024/12/1X3A4723-1536x863.jpg" alt="गैलरी छवि 1">
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6 gallery-item">
            <img src="https://kubreshwardham.org/wp-content/uploads/2024/12/1X3A4723-1536x863.jpg" alt="गैलरी छवि 2">
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6 gallery-item">
            <img src="https://kubreshwardham.org/wp-content/uploads/2024/12/1X3A4723-1536x863.jpg" alt="गैलरी छवि 3">
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6 gallery-item">
            <img src="https://kubreshwardham.org/wp-content/uploads/2024/12/1X3A4723-1536x863.jpg" alt="गैलरी छवि 4">
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6 gallery-item">
            <img src="https://kubreshwardham.org/wp-content/uploads/2024/12/1X3A4723-1536x863.jpg" alt="गैलरी छवि 5">
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6 gallery-item">
            <img src="https://kubreshwardham.org/wp-content/uploads/2024/12/1X3A4723-1536x863.jpg" alt="गैलरी छवि 6">
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6 gallery-item">
            <img src="https://kubreshwardham.org/wp-content/uploads/2024/12/1X3A4723-1536x863.jpg" alt="गैलरी छवि 7">
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6 gallery-item">
            <img src="https://kubreshwardham.org/wp-content/uploads/2024/12/1X3A4723-1536x863.jpg" alt="गैलरी छवि 8">
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<!-- Add Scroll Animation Trigger -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add animation class to elements when they come into view
    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe all gallery items
    document.querySelectorAll('.gallery-item').forEach(item => {
        observer.observe(item);
    });
    
    // Add floating animation to main image
    const mainImage = document.querySelector('.iner-text.side-by img');
    if(mainImage) {
        setInterval(() => {
            mainImage.style.transform = 'translateY(-5px)';
            setTimeout(() => {
                mainImage.style.transform = 'translateY(0)';
            }, 1500);
        }, 3000);
    }
});
</script>

@include('pages.common.footer')