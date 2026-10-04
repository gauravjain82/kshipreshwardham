@include('pages.common.header')

<style>
.hotel-card {
    background: #ffffff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: 0.4s ease;
    border-top: 5px solid #b8860b;
}

.hotel-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.hotel-img {
    height: 260px;
    overflow: hidden;
}

.hotel-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.hotel-desc {
    display: -webkit-box;
    -webkit-line-clamp: 2; /* 👈 kitni lines dikhani hai */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    min-height: 48px; /* equal height maintain */
    line-height: 1.5;
}

/* Professional Bhakt Overlay Section */
.bhakt-overlay {
    background: linear-gradient(135deg, #fff8f0 0%, #fffdf9 100%);
    border-left: 5px solid #b8860b;
    border-right: 1px solid rgba(184, 134, 11, 0.2);
    border-radius: 12px;
    padding: 30px 35px;
    margin: 40px auto;
    max-width: 1200px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    position: relative;
    transition: 0.3s ease;
}

.bhakt-overlay:hover {
    box-shadow: 0 12px 35px rgba(184, 134, 11, 0.1);
    transform: translateY(-2px);
}



.bhakt-overlay h5 {
    font-size: 18px;
    line-height: 1.8;
    color: #2c2c2c;
    font-weight: 500;
    text-align: center;
    letter-spacing: 0.3px;
    margin: 0;
    position: relative;
    z-index: 1;
}

.bhakt-overlay h5::first-letter {
    font-size: 24px;
    color: #b8860b;
    font-weight: 700;
}

/* Responsive Design */
@media (max-width: 768px) {
    .bhakt-overlay {
        padding: 20px 25px;
        margin: 30px 20px;
    }
    
    .bhakt-overlay h5 {
        font-size: 16px;
        line-height: 1.6;
    }
}

.hotel-body {
    padding: 25px;
}

.hotel-title {
    font-size: 22px;
    font-weight: 700;
    color: #b8860b;
}

.hotel-price {
    font-size: 20px;
    font-weight: 700;
    color: #222;
}

.hotel-type {
    background: #fff8e7;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 13px;
    display: inline-block;
    margin-bottom: 10px;
}

.hotel-btn {
    background: linear-gradient(45deg,#b8860b,#d4af37);
    border: none;
    color: #fff;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
}

.hotel-btn:hover {
    opacity: 0.9;
}
/* ================= KUMBH SPECIAL SECTION ================= */
.kumbh-overlay {
    background: linear-gradient(135deg, #fff3e0, #fffaf5);
    border: 2px dashed #d4af37;
    border-radius: 15px;
    padding: 35px 40px;
    margin: 40px auto;
    max-width: 1200px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    text-align: center;
    position: relative;
    transition: 0.3s ease;
}

.kumbh-overlay:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(212, 175, 55, 0.2);
}

/* Heading Style */
.kumbh-overlay h4 {
    font-size: 20px;
    line-height: 1.9;
    color: #2b2b2b;
    font-weight: 500;
}

/* Bullet Points Style */
.kumbh-overlay h4 br {
    line-height: 2.2;
}

/* Highlight icons spacing */
.kumbh-overlay h4 {
    letter-spacing: 0.3px;
}

/* First line highlight */
.kumbh-overlay h4::first-line {
    font-weight: 700;
    color: #b8860b;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .kumbh-overlay {
        padding: 20px;
        margin: 20px;
    }

    .kumbh-overlay h4 {
        font-size: 16px;
        line-height: 1.7;
    }
}
.btn-book {
    display: inline-block;
    background: linear-gradient(45deg, #b8860b, #d4af37);
    color: #fff;
    padding: 8px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}

.btn-book:hover {
    background: linear-gradient(45deg, #9a7209, #c4a22c);
    color: #fff;
    transform: translateY(-2px);
}
</style>

<!-- Page Title -->
<div class="page-title page-title-inner padding-bottom9"
     style="background-image: url('{{ asset('admin/bhaktbanner.jpg') }}'); background-size: cover;">
    <div class="overlay-page-tile"></div>
    <div class="page-title-content">
        <div class="container">
            <div class="blog-title color-white">
                <h2 class="asas">भक्त निवास</h2>
                
                <span style="color: #fff;">
    <a href="/" style="color: #fff;"> होम </a>
    » &nbsp;&nbsp;होटल
</span>
            </div>
        </div>
    </div>
</div>

<!-- Professional Bhakt Overlay Section -->
<div class="container">
    <div class="bhakt-overlay">
        <h5>
            🔱 बाबा क्षिप्रेश्वर के आशीर्वाद में पावन भक्त निवास 🔱 <br>

                यह भक्त निवास एक शांत, पवित्र और आध्यात्मिक वातावरण से परिपूर्ण स्थान है, जहाँ हर श्रद्धालु को सुकून, सुविधा और दिव्य अनुभूति का अनुभव होता है।

                बाबा क्षिप्रेश्वर की कृपा से यहाँ ठहरने की उत्तम व्यवस्था सुलभ और किफायती दरों पर उपलब्ध है, ताकि हर भक्त बिना किसी चिंता के दर्शन और साधना कर सके।

                मंदिर के निकट स्थित यह पावन स्थान आपको प्रकृति की गोद में शांति और सकारात्मक ऊर्जा का अनुभव कराता है। स्वच्छ वातावरण, हरियाली से घिरा परिसर और शांत माहौल मन को आध्यात्मिकता से जोड़ देता है। यहाँ ठहरकर भक्त न केवल विश्राम पाते हैं, बल्कि भगवान के और भी करीब होने का दिव्य अनुभव करते हैं।

                आइए, बाबा क्षिप्रेश्वर के आशीर्वाद में इस पावन भक्त निवास का लाभ उठाएँ
                और अपनी यात्रा को शांत, सुखद और आध्यात्मिक बनाएं।
        </h5>
    </div>

        <div id="kumbh-section" class="kumbh-overlay mt-5">
        <h4>
            यदि आप सिंहस्त महाकुंभ 2028 में शामिल होना चाहते हैं और <br>
            यात्रा, दर्शन, पूजा या संपूर्ण मार्गदर्शन के लिए सहायता चाहते हैं,    <br>        
            तो हमसे अवश्य संपर्क करें। हम आपको कुंभ यात्रा से जुड़ी हर सुविधा <br>
            📿 दर्शन व्यवस्था <br>
            🏨 ठहरने की सुविधा <br>
            🚗 यात्रा मार्गदर्शन <br>
            🔥 विशेष पूजन एवं अनुष्ठान <br>
            के साथ एक सहज और दिव्य अनुभव प्रदान करने के लिए तत्पर हैं। 
        </h4>
    </div>
</div>

<!-- Hotel Section -->
<section class="hotel-section pos-rel z-1 pt-70 pb-125" data-bg-color="#f5f5f5">
    <div class="category-shape1">
        <img src="assets/img/Group6473.png" alt="">
    </div>
    <div class="as_banner_img text-center">
        <img src="assets/img/Group69351.png" width="100px" alt="" class="img-responsive">
    </div>
    <div class="container">
        <div class="row">
            @foreach($hotels as $hotel)
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="hotel-card">
                    <div class="hotel-img">
                        <img src="{{ asset($hotel->hotel_image) }}" alt="{{ $hotel->hotel_name }}">
                    </div>
                    <div class="hotel-body">
                        <!-- <span class="hotel-type">
                            {{ ucfirst($hotel->hotel_type) }} कमरा
                        </span> -->
                        <h4 class="hotel-title">
                            {{ $hotel->hotel_name }}
                        </h4>
                        <p>
                            क्षमता: {{ $hotel->capacity }} व्यक्ति
                        </p>
                        <p class="hotel-desc">
                            {!! Str::limit(strip_tags($hotel->description),120) !!}
                        </p>
                        <p>
                            <strong>Amenities:</strong><br>
                            {{ $hotel->amenities }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="hotel-price">
                            ₹ {{ $hotel->price_per_night }} / रात
                        </div>

                        <div class="about-k ddd1">
                            <a href="tel:7987651007" class="btn-book mt-2 d-flex align-items-center gap-2">
                                <i class="fa fa-phone"></i>
                                अभी बुक करें
                            </a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@include('pages.common.footer')