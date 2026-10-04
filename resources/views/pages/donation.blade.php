@include('pages.common.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
        /* Donation Page Styles */
        .donation-section {
            background: #f9f6ef;
            padding: 60px 0;
        }
        .content-box {
            padding-left: 136px;
        }

        .donation-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .donation-header .subtitle {
            display: inline-block;
            background: linear-gradient(45deg, #d4af37, #b8860b);
            color: #fff;
            padding: 5px 20px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .donation-header h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #8b5a2b;
            margin-bottom: 20px;
        }

        .donation-header p {
            font-size: 1.1rem;
            color: #666;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Donation Cards Grid */
        .donation-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
            margin-bottom: 60px;
        }

        .donation-card {
            background: #fff;
            border-radius: 20px;
            padding: 30px 20px;
            text-align: center;
            transition: 0.3s;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            position: relative;
            cursor: pointer;
        }

        .donation-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .donation-card.featured {
            border: 2px solid #d4af37;
            background: linear-gradient(135deg, #fff, #fffef5);
        }

        .donation-card .card-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #fff9e6, #fff5e6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }

        .donation-card .card-icon i {
            font-size: 2rem;
            color: #d4af37;
        }

        .donation-card h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            min-height: 50px;
        }

        .donation-card .price {
            font-size: 1.8rem;
            font-weight: 800;
            color: #b8860b;
            margin-bottom: 10px;
        }

        .donation-card .price span {
            font-size: 0.8rem;
            font-weight: 400;
            color: #999;
        }

        .donation-card .description {
            color: #666;
            margin-bottom: 15px;
            line-height: 1.4;
            font-size: 0.85rem;
            min-height: 60px;
        }

        .btn-donate-card {
            background: linear-gradient(45deg, #d4af37, #b8860b);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
            font-size: 0.9rem;
        }

        .btn-donate-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(184, 134, 11, 0.3);
        }

        /* Bank Details Section */
        .bank-details {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 60px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .bank-details h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #8b5a2b;
            margin-bottom: 30px;
            text-align: center;
        }

        .bank-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .bank-info {
            background: #f9f6ef;
            padding: 25px;
            border-radius: 15px;
        }

        .bank-info h4 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #b8860b;
            margin-bottom: 20px;
        }

        .bank-info p {
            margin-bottom: 12px;
            color: #555;
            font-size: 0.95rem;
        }

        .bank-info p strong {
            color: #333;
            min-width: 140px;
            display: inline-block;
        }

        .qr-section {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qr-code {
            text-align: center;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            border: 2px dashed #d4af37;
        }

        .qr-img {
            width: 180px;
            height: 180px;
            object-fit: contain;
            border: 1px solid #eee;
            padding: 8px;
            border-radius: 10px;
            background: #fff;
            margin-top: 10px;
        }
        .qr-box {
            text-align: center;
            margin-top: 20px;
        }
        .qr-label {
            font-size: 13px;
            color: #b8860b;
            margin-top: 8px;
            font-weight: 500;
        }

        /* Donation Form Styles */
        .donation-form {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-bottom: 60px;
        }

        .donation-form h3 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #8b5a2b;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group label i {
            color: #d4af37;
            margin-right: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
            transition: 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #d4af37;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        textarea.form-control {
            resize: vertical;
        }

        .amount-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
        }

        .amount-btn {
            background: #f0f0f0;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .amount-btn:hover,
        .amount-btn.active {
            background: #d4af37;
            color: #fff;
        }

        .submit-btn {
            background: linear-gradient(45deg, #28a745, #1e7e34);
            color: #fff;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Popup Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: fadeIn 0.3s;
        }

        .modal-overlay.active {
            display: flex;
        }

        .success-modal {
            background: #fff;
            border-radius: 20px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            padding: 40px;
            position: relative;
            animation: slideIn 0.3s;
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            cursor: pointer;
            color: #999;
            transition: 0.3s;
        }

        .modal-close:hover {
            color: #333;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: #28a745;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .success-icon i {
            font-size: 40px;
            color: #fff;
        }

        .success-modal h3 {
            font-size: 1.8rem;
            color: #28a745;
            margin-bottom: 15px;
        }

        .success-modal p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .donation-details {
            background: #f9f6ef;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
        }

        .donation-details p {
            margin: 8px 0;
            font-weight: 500;
        }

        .modal-btn {
            background: linear-gradient(45deg, #d4af37, #b8860b);
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: 0.3s;
        }

        .modal-btn:hover {
            transform: translateY(-2px);
        }

        /* Loading Spinner */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .donation-header h2 {
                font-size: 1.8rem;
            }
            .donation-cards {
                grid-template-columns: 1fr;
            }
            .donation-form {
                padding: 25px;
            }
            .bank-details-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Impact Cards */
        .impact-card {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            text-align: center;
            transition: 0.3s;
            height: 100%;
        }
        .impact-card:hover {
            transform: translateY(-5px);
        }
        .impact-card i {
            font-size: 48px;
            color: #d4af37;
            margin-bottom: 20px;
        }
        .impact-card h4 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }
        .impact-card p {
            color: #666;
            line-height: 1.6;
        }
        
        /* Special heading style */
        .special-offer-heading {
            background: linear-gradient(135deg, #fff5e6, #fff0e0);
            border-left: 5px solid #d4af37;
            border-radius: 15px;
            padding: 20px 25px;
            margin: 30px 0 40px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }
        .special-offer-heading h4 {
            font-size: 1.6rem;
            font-weight: 800;
            color: #b45f1b;
            margin-bottom: 10px;
        }
        .special-offer-heading p {
            font-size: 1.1rem;
            color: #5a3e1b;
            margin: 0;
            font-weight: 500;
        }
        .special-offer-heading i {
            color: #d4af37;
            margin-right: 10px;
        }
        .guruji-image {
            float: right;
            width: 280px;
            /* margin: 0 0 20px 30px; */
            position: absolute;
            right: 86px;
        }

        .guruji-image img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 10px;
            object-fit: cover;
        }

/* Clear float after donation section */
.donation-cards {
    clear: both;
}

/* Mobile */
@media (max-width: 768px) {
    .guruji-image {
        float: none;
        width: 150px;
        margin: 15px auto;
    }
    .content-box {
        padding:0;
    }
}
    </style>
</head>
<body>


<!-- Page Title Banner -->
<div class="page-title page-title-inner padding-bottom9"
     style="background-image: url('{{ asset(optional($top)->donate ?? 'topbanner/Donate_About.jpg') }}'); background-size: cover;">
   <div class="overlay-page-tile"></div>
   <div class="page-title-content">
      <div class="container">
         <div class="blog-title color-white">
            <h2 class="asas">दान करें</h2>
            <span style="color: #fff;">
                <a href="/" style="color: #fff;"> Home </a>
                » &nbsp;&nbsp;दान करें
            </span>
         </div>
      </div>
   </div>
</div>

<!-- Donation Page Content -->
<section class="donation-section py-5">
    <div class="container">
        <!-- Header -->
        <div class="row align-items-center donation-header position-relative">
            <!-- Text Content (Left) -->
            <div class="col-lg-9 col-md-7 mb-4 mb-md-0 content-box">
                <div class="mb-2">
                    <span class="subtitle text-primary fw-semibold">🙏 मंदिर का समर्थन करें</span>
                </div>
                <div>
                    <h2 class="fw-bold mb-3">दान पुण्य का महत्व</h2>
                </div>
                <p class="text-muted mb-0 lh-lg">
                    आपका दान मंदिर के विकास, गौशाला के संचालन और धार्मिक कार्यों में सहायक होगा। 
                    सभी दान कर मुक्त हैं और 80G के तहत टैक्स छूट प्राप्त है।
                </p>
            </div>
            
            <!-- Guruji Image (Right) -->
            <div class="col-lg-3 col-md-5 text-center text-md-end">
                <div class="guruji-image-wrapper">
                    <img src="{{ asset('uploads/Guruji.jpeg') }}" alt="Guruji" class="img-fluid rounded shadow-sm" style="max-height: 250px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Guruji Image -->


<!-- NEW Special Heading -->
<div class="special-offer-heading">
    <h4>
        <i class="fas fa-temple"></i>
        51 करोड़ रुपए – पूर्ण मंदिर निर्माण हेतु महासेवा
    </h4>

    <p>
        जो श्रद्धालु 51 करोड़ रुपए का पूर्ण मंदिर निर्माण सेवा करवाएगा,
        उसका नाम मंदिर के मुख्य द्वार पर अमर रहेगा।
        स्वर्णाक्षरों में अंकित किया जाएगा। 🙏
    </p>
</div>

<!-- Donation Cards -->
<div class="donation-cards" id="sortedCardsContainer">
</div>
        <!-- Bank Details Section -->
        <div class="bank-details">
            <h3><i class="fas fa-university"></i> बैंक खाता विवरण</h3>
            <div class="bank-details-grid">
                <!-- HDFC -->
                <div class="bank-info">
                    <h4><i class="fas fa-building"></i> बैंक विवरण (HDFC Bank)</h4>
                    <p><strong>बैंक का नाम:</strong> HDFC Bank</p>
                    <p><strong>खाता धारक:</strong> Prem Yamuna Seva Trust</p>
                    <p><strong>खाता संख्या:</strong> 50200068905430</p>
                    <p><strong>IFSC कोड:</strong> HDFC0000908</p>
                    <p><strong>UPI ID:</strong> 7987651007@hdfcbank</p>
                    <div class="qr-box">
                        <img src="{{ asset('uploads/qr1.png') }}" alt="HDFC QR" class="qr-img" onerror="this.src='https://via.placeholder.com/180?text=QR+HDFC'">
                        <p class="qr-label">Scan & Pay (HDFC)</p>
                    </div>
                </div>
                <!-- SBI -->
                <div class="bank-info">
                    <h4><i class="fas fa-building"></i> बैंक विवरण (SBI)</h4>
                    <p><strong>बैंक का नाम:</strong> State Bank of India (SBI)</p>
                    <p><strong>खाता धारक:</strong> Prem Yamuna Seva Trust</p>
                    <p><strong>खाता संख्या:</strong> 33998167437</p>
                    <p><strong>IFSC कोड:</strong> SBIN0003217</p>
                    <p><strong>UPI ID:</strong> PREMYAMUNASEVATRUST@SBI</p>
                    <div class="qr-box">
                        <img src="{{ asset('uploads/qr2.png') }}" alt="SBI QR" class="qr-img" onerror="this.src='https://via.placeholder.com/180?text=QR+SBI'">
                        <p class="qr-label">Scan & Pay (SBI)</p>
                    </div>
                </div>
            </div>
            <div style="background: #fff9e6; padding: 20px; border-radius: 10px; margin-top: 30px; text-align: center;">
                <i class="fas fa-file-invoice" style="color: #f7b731; font-size: 24px; margin-right: 10px;"></i>
                <span style="color: #333; font-size: 16px;">सभी दान धारा 80G के तहत कर मुक्त हैं। आपको 50% छूट प्राप्त होगी।</span>
            </div>
        </div>
        
        <!-- Donation Form -->
        <div class="donation-form" id="donationForm">
            <h3><i class="fas fa-edit"></i> दान फॉर्म भरें</h3>
            <form id="donationFormElement">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> पूरा नाम *</label>
                        <input type="text" id="fullName" class="form-control" placeholder="अपना नाम लिखें" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-mobile-alt"></i> मोबाइल नंबर *</label>
                        <input type="tel" id="mobile" class="form-control" placeholder="10 अंकों का मोबाइल नंबर" pattern="[0-9]{10}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> ईमेल आईडी *</label>
                        <input type="email" id="email" class="form-control" placeholder="ईमेल आईडी" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-map-marker-alt"></i> शहर *</label>
                        <input type="text" id="city" class="form-control" placeholder="शहर का नाम" required>
                    </div>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-map-marked-alt"></i> पूरा पता *</label>
                    <textarea id="address" class="form-control" rows="3" placeholder="अपना पूरा पता लिखें" required></textarea>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-rupee-sign"></i> दान राशि *</label>
                    <div class="amount-options" id="amountButtonsContainer">
                        <!-- dynamic amount buttons also sorted -->
                    </div>
                    <input type="number" id="customAmount" class="form-control" placeholder="कोई अन्य राशि" min="1">
                    <input type="hidden" id="purposeHidden">
                </div>
                <div class="form-group">
                    <label><i class="fas fa-pray"></i> दान का उद्देश्य</label>
                    <select id="purpose" class="form-control">
                        <!-- options will be populated by JS sorted by amount? keep original but ok -->
                    </select>
                </div>
                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-hand-holding-heart"></i> दान करें
                </button>
            </form>
        </div>
        
       
    </div>
</section>

<!-- Success Popup Modal -->
<div id="successModal" class="modal-overlay">
    <div class="success-modal">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        <h3>धन्यवाद! 🙏</h3>
        <p>आपके दान के लिए हृदय से आभार।</p>
        <p>आपका सहयोग हमारे धार्मिक कार्यों को और मजबूत करेगा।</p>
        <div class="donation-details" id="donationSummary">
            <p><strong>दाता का नाम:</strong> <span id="summaryName">-</span></p>
            <p><strong>दान राशि:</strong> <span id="summaryAmount">-</span></p>
            <p><strong>दान का उद्देश्य:</strong> <span id="summaryPurpose">-</span></p>
            <p><strong>भुगतान आईडी:</strong> <span id="paymentId">-</span></p>
        </div>
        <p style="font-size: 14px; color: #999;">आपको जल्द ही एक पुष्टिकरण ईमेल भेजा जाएगा।</p>
        <button class="modal-btn" onclick="closeModal()">ठीक है</button>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
// All donation plans sorted by amount (ascending)
const donationPlans = [
    { amount: 1100, purpose: "भगवान के एक दिन की सेवा व भोग प्रसादी, पूजा, आरती", desc: "भगवान के एक दिन की सेवा, पूजा, आरती व भोग प्रसादी", period: "/ दिन" },
    { amount: 1600, purpose: "एक माह की गौसेवा हेतु", desc: "एक माह की गौसेवा हेतु सहयोग", period: "/ माह" },
    { amount: 2100, purpose: "भगवान का अभिषेक किसी भी एक दिन", desc: "भगवान का अभिषेक किसी भी एक दिन", period: "/ एक बार" },
    { amount: 5100, purpose: "एक गज भूमि दान हेतु", desc: "एक गज भूमि दान हेतु सहयोग", period: "/ एक बार" },
    { amount: 11000, purpose: "एक वर्ष की गौसेवा हेतु", desc: "एक वर्ष की गौसेवा हेतु सहयोग", period: "/ वर्ष" },
    { amount: 11000, purpose: "एक दिन भंडारा हेतु", desc: "एक दिन के भंडारे का सहयोग", period: "/ दिन" },
    { amount: 11000, purpose: "सात दिन पोथी पाठ भागवत या शिवपुराण", desc: "सात दिन पोथी पाठ भागवत या शिवपुराण", period: "/ 7 दिन" },
    { amount: 11000, purpose: "महामृत्युंजय जाप", desc: "महामृत्युंजय जाप हेतु सहयोग", period: "/ एक बार" },
    { amount: 11000, purpose: "दो गज भूमि दान हेतु", desc: "दो गज भूमि दान हेतु सहयोग", period: "/ एक बार" },
    { amount: 21000, purpose: "भगवान की एक माह की सेवा पूजा व भोग प्रसादी, आरती", desc: "भगवान की एक माह की सेवा, पूजा, आरती व भोग प्रसादी", period: "/ माह" },
    { amount: 31000, purpose: "आजीवन गौसेवा हेतु", desc: "गौशाला में आजीवन गौसेवा हेतु सहयोग", period: "/ आजीवन" },
    { amount: 31000, purpose: "आजीवन भंडारा हेतु", desc: "आजीवन भंडारा सेवा हेतु सहयोग", period: "/ आजीवन" },
    { amount: 51000, purpose: "अपना नाम आजीवन लिखवाने हेतु", desc: "अपना नाम मंदिर में आजीवन लिखवाने हेतु", period: "/ एक बार" },
    { amount: 351000, purpose: "कक्ष निर्माण हेतु", desc: "मंदिर परिसर में कक्ष निर्माण हेतु सहयोग", period: "/ एक बार" }
];

// Function to render sorted cards ascending by amount
function renderSortedCards() {
    const sorted = [...donationPlans].sort((a,b) => a.amount - b.amount);
    const container = document.getElementById('sortedCardsContainer');
    if(container) {
        container.innerHTML = '';
        sorted.forEach(plan => {
            const isFeatured = (plan.amount === 351000 || plan.amount === 31000 || plan.amount === 21000 || plan.amount === 51000);
            const cardDiv = document.createElement('div');
            cardDiv.className = `donation-card ${isFeatured ? 'featured' : ''}`;
            cardDiv.innerHTML = `
                <div class="card-icon"><i class="fas ${plan.amount >= 50000 ? 'fa-gem' : (plan.amount >= 20000 ? 'fa-hands-helping' : 'fa-heart')}"></i></div>
                <h3>${plan.purpose}</h3>
                <div class="price">₹${plan.amount.toLocaleString('en-IN')} <span>${plan.period}</span></div>
                <p class="description">${plan.desc}</p>
                <button class="btn-donate-card" onclick="openDonationModal(${plan.amount}, '${plan.purpose.replace(/'/g, "\\'")}')">दान करें</button>
            `;
            container.appendChild(cardDiv);
        });
    }
    // populate amount buttons sorted
    const amountBtnContainer = document.getElementById('amountButtonsContainer');
    if(amountBtnContainer) {
        amountBtnContainer.innerHTML = '';
        const uniqueAmounts = [...new Set(sorted.map(p => p.amount))];
        uniqueAmounts.forEach(amt => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'amount-btn';
            btn.innerText = `₹${amt.toLocaleString('en-IN')}`;
            btn.onclick = (function(amount) { return function() { setAmount(amount); }; })(amt);
            amountBtnContainer.appendChild(btn);
        });
    }
    // populate purpose dropdown sorted by amount
    const purposeSelect = document.getElementById('purpose');
    if(purposeSelect) {
        purposeSelect.innerHTML = '';
        sorted.forEach(plan => {
            const option = document.createElement('option');
            option.value = plan.purpose;
            option.textContent = `${plan.purpose} (₹${plan.amount.toLocaleString('en-IN')})`;
            purposeSelect.appendChild(option);
        });
    }
}

let selectedPurposeFromCard = '';

function setAmount(amount) {
    document.getElementById('customAmount').value = amount;
    document.querySelectorAll('.amount-btn').forEach(btn => {
        btn.classList.remove('active');
        if(btn.innerText.includes(amount.toLocaleString('en-IN'))) {
            btn.classList.add('active');
        }
    });
}

function openDonationModal(amount, purpose) {
    setAmount(amount);
    selectedPurposeFromCard = purpose;
    const purposeSelect = document.getElementById('purpose');
    for(let i=0; i<purposeSelect.options.length; i++) {
        if(purposeSelect.options[i].value === purpose) {
            purposeSelect.selectedIndex = i;
            break;
        }
    }
    document.getElementById('purposeHidden').value = purpose;
    document.getElementById('donationForm').scrollIntoView({ behavior: 'smooth' });
    document.getElementById('purpose').style.borderColor = '#d4af37';
    setTimeout(() => { if(document.getElementById('purpose')) document.getElementById('purpose').style.borderColor = ''; }, 2000);
}

function closeModal() {
    document.getElementById('successModal').classList.remove('active');
    document.body.style.overflow = 'auto';
    document.getElementById('donationFormElement').reset();
    document.querySelectorAll('.amount-btn').forEach(btn => btn.classList.remove('active'));
    selectedPurposeFromCard = '';
    document.getElementById('purposeHidden').value = '';
}

document.getElementById('successModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

document.getElementById('customAmount')?.addEventListener('input', function() {
    if (selectedPurposeFromCard) selectedPurposeFromCard = '';
    document.querySelectorAll('.amount-btn').forEach(btn => btn.classList.remove('active'));
});

document.getElementById('donationFormElement')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    let name = document.getElementById('fullName').value.trim();
    let mobile = document.getElementById('mobile').value.trim();
    let email = document.getElementById('email').value.trim();
    let city = document.getElementById('city').value.trim();
    let address = document.getElementById('address').value.trim();
    let amount = document.getElementById('customAmount').value;
    let purpose = document.getElementById('purpose').value;
    
    if(!name) { alert('कृपया अपना पूरा नाम दर्ज करें'); return; }
    if(!mobile || mobile.length !== 10 || !/^\d+$/.test(mobile)) { alert('कृपया सही 10 अंकों का मोबाइल नंबर दर्ज करें'); return; }
    if(!email || !email.includes('@')) { alert('कृपया सही ईमेल आईडी दर्ज करें'); return; }
    if(!city) { alert('कृपया शहर का नाम दर्ज करें'); return; }
    if(!address) { alert('कृपया अपना पूरा पता दर्ज करें'); return; }
    if(!amount || amount < 1) { alert('कृपया दान राशि दर्ज करें'); return; }
    
    const submitBtn = document.getElementById('submitBtn');
    const originalBtnText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="loading-spinner"></span> कृपया प्रतीक्षा करें...';
    
    try {
        const orderResponse = await fetch("{{ route('create.order') }}", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
            body: JSON.stringify({ amount: parseInt(amount), name, email, mobile, city, address, purpose })
        });
        const orderData = await orderResponse.json();
        if (!orderResponse.ok) throw new Error(orderData.error || 'Failed to create order');
        
        // PhonePe Standard Checkout Redirect Flow
        if (orderData.redirectUrl) {
            window.location.href = orderData.redirectUrl;
        } else {
            throw new Error('Redirect URL not found in response');
        }

    } catch (error) {
        console.error(error);
        alert('Payment process failed. Please try again. Error: ' + error.message);
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
    }
});

window.onload = () => {
    renderSortedCards();
};
</script>

@include('pages.common.footer')
