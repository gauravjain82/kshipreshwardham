@include('pages.common.header')
@php
    $header = DB::table('setting')->first();
    $top = DB::table('top_banner')->first();
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Page Title -->
<div class="page-title page-title-inner padding-bottom9"
     style="background-image: url('{{ asset('admin/bbanner.jpg') }}'); background-size: cover;">
     
    <div class="overlay-page-tile"></div>
    <div class="page-title-content">
        <div class="container">
            <div class="blog-title color-white">
                <h2 class="asas">श्री क्षिप्रेश्वर धाम परिचय</h2>
                <span style="color: #fff;">
                    <a href="/" style="color: #fff;"> Home </a>
                    » &nbsp;&nbsp;Contact Us
                </span>
            </div>
        </div>
    </div>
</div>

<section class="inner-page">
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="footer-box " style="text-align: left;">
                <ul class="contactuss-">
                    <li class="contact-1">
    <i class="fa fa-university" aria-hidden="true"></i>
    <strong>प्रेम यमुना सेवा ट्रस्ट</strong>
</li>

<li class="contact-1">
    <i class="fa fa-map-marker" aria-hidden="true"></i>
    <a href="https://maps.app.goo.gl/ZgHE424p7pm54tEw7" target="_blank" style="color: inherit; text-decoration: none;">
        113, Hariom Vihar, Mahashakti Nagar,<br>
        Ujjain (M.P.) - 456010
    </a>
</li>
                    <li class="contact-1">
                        <i class="fa fa-user" aria-hidden="true"></i><strong>हमें कॉल करें </strong><br>
                        <!-- <a href="tel:{{$header->mobile_number}}">{{$header->mobile_number}} ,</a> -->
                        <a href="tel:{{$header->whatsapp_number}}">{{$header->whatsapp_number}} </a>,
                        <a href="tel:_+919575044096"> +919575044096 </a>
                    </li>
                    <li class="contact-1">
                        <i class="fa fa-envelope" aria-hidden="true"></i><strong>हमें ईमेल करें </strong><br>
                        <a href="mailto:{{$header->email}}"> {{$header->email}}</a>
                    </li>
                    <li class="contact-1">
                        <i class="fa fa-user" aria-hidden="true"></i><strong>संस्थापक एवं अध्यक्ष ( प्रेम यमुना सेवा ट्रस्ट / क्षिप्रेश्वर धाम, उज्जैन ) </strong><br>
                        परम पूज्य श्री महेश गुरु जी (उज्जैन वाले)
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-12">
            <div class="as_contact_form">
                <h4 class="as_subheading text-white">संपर्क में रहो </h4>
                
                <!-- 🔥 Ajax-friendly HTML form changes -->
                <form id="ajaxContactForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <label>Name <span class="req">*</span></label>
                                    <input name="name" type="text" class="form-control" placeholder="Enter your name" required style="padding: 12px 15px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <label>Email <span class="req">*</span></label>
                                    <input name="email" type="email" class="form-control" placeholder="Enter your email address" required style="padding: 12px 15px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <label>Phone Number <span class="req">*</span></label>
                                    <input name="phone" type="text" class="form-control" placeholder="Enter your phone number" required style="padding: 12px 15px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <label>Message <span class="req">*</span></label>
                                    <textarea name="message" rows="4" class="form-control" placeholder="Write your message here..." required style="padding: 12px 15px;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <!-- Recaptcha Container -->
                            <div class="g-recaptcha" data-sitekey="6LdQPHIpAAAAAAUuEKMJkoCglj6y48UWjcfhYoJH"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <button type="submit" id="submitBtn" class="site-button contact_btn" style="padding: 12px 30px; border:none; outline:none;">अभी सबमिट करें</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
</section>

<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3667.8606045216125!2d75.72525577509661!3d23.175287179067006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396375a43e4b98e9%3A0x624ece3d81fa6e18!2sShipreshwar%20Dham%20(Shri%20Mahesh%20Guruji)%20Ujjain!5e0!3m2!1sen!2sin!4v1772195211021!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3668.487068313756!2d75.79796607430596!3d23.152416811472154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3963750066315ddb%3A0x19a43a113814b615!2s38%20hariom%20vihar!5e0!3m2!1sen!2sin!4v1784793831348!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
@include('pages.common.footer')

<!-- 🔥 Add JQuery and SweetAlert2 for notifications -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {

    $('#ajaxContactForm').on('submit', function (e) {
        e.preventDefault();

        let formData = $(this).serialize();
        let btn = $('#submitBtn');

        btn.prop('disabled', true);
        btn.text('भेज रहा है...');

        $.ajax({
            url: "{{ route('send.contact.mail') }}",
            type: "POST",

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            data: formData,

            success: function (res) {

                btn.prop('disabled', false);
                btn.text('अभी सबमिट करें');

                if (res.success) {

                    Swal.fire({
                        title: "धन्यवाद!",
                        text: res.message,
                        icon: "success",
                        confirmButtonText: "ठीक है"
                    });

                    $('#ajaxContactForm')[0].reset();

                    if (typeof grecaptcha !== "undefined") {
                        grecaptcha.reset();
                    }

                } else {

                    Swal.fire({
                        title: "त्रुटि!",
                        text: res.message,
                        icon: "error",
                        confirmButtonText: "ठीक है"
                    });
                }
            },

            error: function (xhr) {

                btn.prop('disabled', false);
                btn.text('अभी सबमिट करें');

                console.log(xhr.responseText);

                let errorMsg = "कुछ गड़बड़ हो गई। कृपया बाद में प्रयास करें।";

                if (xhr.status === 419) {
                    errorMsg = "CSRF token expired or invalid. कृपया पेज refresh करके दोबारा प्रयास करें।";
                } else if (
                    xhr.responseJSON &&
                    xhr.responseJSON.message
                ) {
                    errorMsg = xhr.responseJSON.message;
                }

                Swal.fire({
                    title: "त्रुटि!",
                    text: errorMsg,
                    icon: "error",
                    confirmButtonText: "ठीक है"
                });
            }
        });
    });

});
</script>