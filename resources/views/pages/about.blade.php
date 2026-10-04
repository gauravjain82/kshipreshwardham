@include('pages.common.header')

<style>
    /* About section - elegant card style */
    .about-card-img {
        border-radius: 32px;
        box-shadow: 0 25px 40px -18px rgba(0, 0, 0, 0.25);
        transition: transform 0.4s ease, box-shadow 0.3s;
        border: 1px solid rgba(218, 165, 32, 0.2);
    }
    .about-card-img:hover {
        transform: scale(1.01);
        box-shadow: 0 28px 36px -12px rgba(0, 0, 0, 0.3);
    }
    
    .about-text-content {
        font-weight: 500;
        font-size: 1rem;
        line-height: 1.75;
        color: #2c2a2a;
        background: #ffffffdd;
        backdrop-filter: blur(2px);
        padding: 0.5rem 0;
    }
    .about-text-content p {
        margin-bottom: 1.2rem;
        font-size: 1.05rem;
    }
    .about-text-content strong, .about-text-content b {
        color: #b45f1b;
        font-weight: 700;
    }
    
    /* Vision Section - Sacred Card Style */
    .vision-card {
        background: linear-gradient(135deg, #fff9ef 0%, #fff5e6 100%);
        border-radius: 48px;
        padding: 3rem 3rem;
        position: relative;
        box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(218, 165, 32, 0.35);
        transition: all 0.3s;
        margin: 30px 0 40px;
        overflow: hidden;
    }
    
    .vision-card::before {
        content: "🕉️";
        position: absolute;
        bottom: -30px;
        right: -30px;
        font-size: 180px;
        opacity: 0.05;
        pointer-events: none;
        font-family: monospace;
    }
    
    .vision-card:hover {
        box-shadow: 0 30px 45px -15px rgba(0, 0, 0, 0.15);
        border-color: #d4af37;
        transform: translateY(-5px);
    }
    
    .vision-icon {
        position: absolute;
        top: -28px;
        left: 40px;
        background: linear-gradient(145deg, #e6c86e, #c9a92b);
        width: 70px;
        height: 70px;
        border-radius: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        z-index: 2;
    }
    
    .vision-icon i {
        font-size: 2.5rem;
        color: #2c1a0a;
    }
    
    .vision-title {
        font-size: 2.2rem;
        font-weight: 800;
        background: linear-gradient(135deg, #8b5a2b, #d4af37);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        margin-bottom: 1.8rem;
        letter-spacing: -0.3px;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        border-left: 5px solid #d4af37;
        padding-left: 20px;
    }
    
    .vision-title i {
        background: linear-gradient(135deg, #8b5a2b, #d4af37);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        font-size: 2rem;
    }
    
    .vision-text {
        font-size: 1.1rem;
        line-height: 1.8;
        font-weight: 500;
        color: #2f2e2e;
    }
    
    /* Handle plain text bullet points */
.vision-text {
    font-size: 1.1rem;
    line-height: 1.8;
    font-weight: 500;
    color: #2f2e2e;
}

.vision-text p {
    margin-bottom: 1rem;
}

/* Style for lines starting with - or • */
.vision-text br + br {
    display: none;
}

/* Convert plain text bullet points to styled list items */
.vision-text {
    white-space: pre-wrap;
}

/* Alternative: Use JavaScript to convert plain text bullets */
    /* Professional List Styling */
    .vision-list {
        list-style: none;
        padding: 0;
        margin: 25px 0 0 0;
    }
    
    .vision-list li {
        padding: 12px 0 12px 35px;
        margin-bottom: 10px;
        position: relative;
        font-size: 1.05rem;
        line-height: 1.6;
        color: #3a3a3a;
        border-bottom: 1px dashed rgba(184, 134, 11, 0.15);
        transition: all 0.3s ease;
    }
    
    .vision-list li:hover {
        transform: translateX(8px);
        color: #5a3a1a;
        border-bottom-color: rgba(184, 134, 11, 0.3);
    }
    
    .vision-list li:before {
        content: "🔱";
        position: absolute;
        left: 0;
        top: 12px;
        font-size: 1.2rem;
        color: #d4af37;
        transition: transform 0.3s ease;
    }
    
    .vision-list li:hover:before {
        transform: scale(1.2) rotate(5deg);
    }
    
    /* Alternative icons for different items */
    .vision-list li:nth-child(1):before { content: "✨"; }
    .vision-list li:nth-child(2):before { content: "🌿"; }
    .vision-list li:nth-child(3):before { content: "🧘"; }
    .vision-list li:nth-child(4):before { content: "🌟"; }
    .vision-list li:nth-child(5):before { content: "🕉️"; }
    .vision-list li:nth-child(6):before { content: "🔔"; }
    .vision-list li:nth-child(7):before { content: "🌺"; }
    .vision-list li:nth-child(8):before { content: "🙏"; }
    
    /* Vision Heading Style */
    .vision-main-heading {
        font-size: 1.8rem;
        font-weight: 800;
        color: #8b5a2b;
        margin-bottom: 20px;
        text-align: center;
        position: relative;
        padding-bottom: 15px;
    }
    
    .vision-main-heading:after {
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
    
    .vision-subheading {
        font-size: 1.4rem;
        font-weight: 700;
        color: #b8860b;
        margin: 25px 0 15px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .vision-subheading i {
        font-size: 1.6rem;
    }
    
    /* Decorative Divider */
    .temple-divider {
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg, #d4af37, transparent);
        margin: 15px 0 20px 0;
        border-radius: 3px;
    }
    
    /* Responsive fine-tune */
    @media (max-width: 768px) {
        .blog-title h2 {
            font-size: 2.2rem;
        }
        .vision-card {
            padding: 2rem 1.5rem;
        }
        .vision-title {
            font-size: 1.8rem;
        }
        .vision-icon {
            width: 55px;
            height: 55px;
            top: -20px;
            left: 20px;
        }
        .vision-icon i {
            font-size: 1.8rem;
        }
        .vision-list li {
            font-size: 0.95rem;
            padding: 10px 0 10px 30px;
        }
        .vision-list li:before {
            font-size: 1rem;
            top: 10px;
        }
        .vision-main-heading {
            font-size: 1.4rem;
        }
        .vision-subheading {
            font-size: 1.2rem;
        }
    }
    
    /* Mantra/Shloka Style */
    .shloka-mantra {
        font-style: italic;
        font-weight: 500;
        color: #a5712c;
        border-left: 3px solid #e7b42c;
        padding-left: 20px;
        margin-top: 1rem;
        background: #fff7e8;
        border-radius: 20px;
        padding: 12px 20px;
    }
    
    /* Rich content styling for editor content */
    .about-text-content ul, .vision-text ul {
        padding-left: 0;
        list-style: none;
    }
    
    .about-text-content li, .vision-text li {
        margin-bottom: 0.8rem;
        position: relative;
        padding-left: 28px;
    }
    
    .about-text-content li:before {
        content: "🔱";
        position: absolute;
        left: 0;
        color: #d4af37;
    }
    
 .about-card-img {
        border-radius: 32px;
        box-shadow: 0 25px 40px -18px rgba(0, 0, 0, 0.25);
        transition: transform 0.4s ease, box-shadow 0.3s;
        border: 1px solid rgba(218, 165, 32, 0.2);
    }
    .about-card-img:hover {
        transform: scale(1.01);
        box-shadow: 0 28px 36px -12px rgba(0, 0, 0, 0.3);
    }
    
    /* Vision Section - Sacred Card Style */
    .vision-card {
        background: linear-gradient(135deg, #fff9ef 0%, #fff5e6 100%);
        border-radius: 48px;
        padding: 3rem 3rem;
        position: relative;
        box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(218, 165, 32, 0.35);
        transition: all 0.3s;
        margin: 30px 0 40px;
        overflow: hidden;
    }
    
    .vision-card::before {
        content: "🕉️";
        position: absolute;
        bottom: -30px;
        right: -30px;
        font-size: 180px;
        opacity: 0.05;
        pointer-events: none;
    }
    
    .vision-card:hover {
        box-shadow: 0 30px 45px -15px rgba(0, 0, 0, 0.15);
        border-color: #d4af37;
        transform: translateY(-5px);
    }
    
    .vision-icon {
        position: absolute;
        top: -28px;
        left: 40px;
        background: linear-gradient(145deg, #e6c86e, #c9a92b);
        width: 70px;
        height: 70px;
        border-radius: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        z-index: 2;
    }
    
    .vision-icon i {
        font-size: 2.5rem;
        color: #2c1a0a;
    }
    
    .vision-title {
        font-size: 2.2rem;
        font-weight: 800;
        background: linear-gradient(135deg, #8b5a2b, #d4af37);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        margin-bottom: 1rem;
        letter-spacing: -0.3px;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        border-left: 5px solid #d4af37;
        padding-left: 20px;
    }
    
    /* Vision Text Styling */
    .vision-text {
        font-size: 1.05rem;
        line-height: 1.8;
        font-weight: 500;
        color: #2c2c2c;
    }
    
    .vision-text h3 {
        font-size: 1.6rem;
        font-weight: 700;
        color: #8b5a2b;
        margin-top: 30px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(218, 165, 32, 0.3);
        display: inline-block;
    }
    
    .vision-text h3 strong {
        font-weight: 700;
    }
    
    .vision-text p {
        margin-bottom: 18px;
        line-height: 1.8;
    }
    
    /* Professional List Styling - This will style all UL tags inside vision-text */
    .vision-text ul {
        list-style: none;
        padding: 0;
        margin: 25px 0 30px 0;
    }
    
    .vision-text ul li {
        padding: 12px 0 12px 40px;
        margin-bottom: 8px;
        position: relative;
        font-size: 1rem;
        line-height: 1.6;
        color: #3a3a3a;
        border-bottom: 1px dashed rgba(184, 134, 11, 0.15);
        transition: all 0.3s ease;
    }
    
    .vision-text ul li:hover {
        transform: translateX(8px);
        color: #5a3a1a;
        border-bottom-color: rgba(184, 134, 11, 0.3);
    }
    
    /* Beautiful icons for each list item */
    .vision-text ul li:before {
        content: "🔱";
        position: absolute;
        left: 0;
        top: 12px;
        font-size: 1.2rem;
        color: #d4af37;
        transition: transform 0.3s ease;
    }
    
    .vision-text ul li:hover:before {
        transform: scale(1.2) rotate(5deg);
    }
    
    /* Different icons for different list items based on content */
    .vision-text ul li:nth-child(1):before { content: "✨"; }
    .vision-text ul li:nth-child(2):before { content: "🌿"; }
    .vision-text ul li:nth-child(3):before { content: "🧘"; }
    .vision-text ul li:nth-child(4):before { content: "🌟"; }
    .vision-text ul li:nth-child(5):before { content: "🕉️"; }
    .vision-text ul li:nth-child(6):before { content: "🔔"; }
    .vision-text ul li:nth-child(7):before { content: "🌺"; }
    .vision-text ul li:nth-child(8):before { content: "🙏"; }
    
    /* Decorative Divider */
    .temple-divider {
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg, #d4af37, transparent);
        margin: 0 0 25px 0;
        border-radius: 3px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .vision-card {
            padding: 2rem 1.5rem;
        }
        .vision-title {
            font-size: 1.6rem;
        }
        .vision-icon {
            width: 55px;
            height: 55px;
            top: -20px;
            left: 20px;
        }
        .vision-icon i {
            font-size: 1.8rem;
        }
        .vision-text h3 {
            font-size: 1.3rem;
        }
        .vision-text ul li {
            font-size: 0.9rem;
            padding: 10px 0 10px 35px;
        }
        .vision-text ul li:before {
            font-size: 1rem;
            top: 10px;
        }
    }
    
    /* Button effects */
    .btn-gold {
        background: linear-gradient(45deg, #b8860b, #d4af37);
        border: none;
        color: #fff;
        padding: 10px 25px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(184, 134, 11, 0.3);
    }
</style>

<!-- Page Title -->
<div class="page-title page-title-inner padding-bottom9"
    style="background-image: url('{{ asset('admin/topbanner.jpg') }}'); background-size: cover;">
    <div class="overlay-page-tile"></div>
    <div class="page-title-content">
        <div class="container">
            <div class="blog-title color-white">
                <h2 class="asas">श्री क्षिप्रेश्वर धाम परिचय</h2>
                <span style="color: #fff;">
    <a href="/" style="color: #fff;"> Home </a>
    » &nbsp;&nbsp;About Us
</span>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<section class="inner-page py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- Image -->
            <div class="col-md-6 mb-4">
                <img src="{{ asset($frontend->about_us_image) }}"
                     alt="About Kshipreshwar Dham"
                     class="img-fluid rounded shadow about-card-img">
            </div>
            
            <!-- Content -->
            <div class="col-md-6" style="font-weight: 500; font-size: 15px; color: #000922;">
                {!! $frontend->about_us !!}
            </div>
        </div>
    </div>
</section>

<!-- Vision Section -->
<section class="inner-page pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="vision-card">
                    
                    
                    <h2 class="vision-title">
                        <i class="fas fa-spa"></i> ॥ हमारा नज़रिया ॥
                    </h2>
                    <div class="temple-divider"></div>
                    
                    <div class="vision-text">
                        {!! $frontend->vision !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const visionText = document.querySelector('.vision-text');
    if (visionText) {
        let html = visionText.innerHTML;
        
        // Split by lines
        let lines = html.split('<br>');
        let newHtml = '';
        let inList = false;
        
        lines.forEach(line => {
            line = line.trim();
            // Check if line starts with - or •
            if (line.match(/^[-•]\s/)) {
                if (!inList) {
                    newHtml += '<ul class="vision-list">';
                    inList = true;
                }
                // Remove the bullet character and add as list item
                let content = line.replace(/^[-•]\s/, '');
                newHtml += '<li>' + content + '</li>';
            } else {
                if (inList) {
                    newHtml += '</ul>';
                    inList = false;
                }
                if (line) {
                    newHtml += '<p>' + line + '</p>';
                }
            }
        });
        
        if (inList) {
            newHtml += '</ul>';
        }
        
        if (newHtml) {
            visionText.innerHTML = newHtml;
        }
    }
});
</script>

@include('pages.common.footer')