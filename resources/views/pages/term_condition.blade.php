@include('pages.common.header')

@php
    $header = DB::table('setting')->first();
    $top = DB::table('top_banner')->first();
    $content = DB::table('content')->first();
@endphp

<!-- Page Title -->
<div class="page-title page-title-inner padding-bottom9"
     style="background-image: url('{{ asset('admin/bbanner.jpg') }}'); background-size: cover;">
     
    <div class="overlay-page-tile"></div>
    <div class="page-title-content">
        <div class="container">
            <div class="blog-title color-white">
                <h2 class="asas">नियम और शर्तें (Terms & Conditions)</h2>
                <span style="color: #fff;">
                    <a href="/" style="color: #fff;"> Home </a>
                    » &nbsp;&nbsp;Terms & Conditions
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Terms & Conditions Section -->
<section class="inner-page" style="padding: 60px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="privacy-content-box" style="text-align: left; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.05); line-height: 1.8; font-size: 16px; color: #333;">
                    
                    @if(!empty($content) && !empty($content->terms_conditions))
                        {!! $content->terms_conditions !!}
                    @else
                        <h3>Terms & Conditions – Prem Yamuna Seva Trust</h3>
                        <p>Welcome to the official website of Prem Yamuna Seva Trust. By accessing or using <a href="https://www.kshipreshwardham.com" target="_blank" style="color: #007bff; text-decoration: underline;">www.kshipreshwardham.com</a>, you agree to comply with the following Terms & Conditions. If you do not agree with these terms, please do not use the website.</p>

                        <h4>1. Trust Information</h4>
                        <p><strong>Trust Name:</strong> Prem Yamuna Seva Trust</p>
                        <p><strong>Address:</strong><br>
                        113, Hariom Vihar, Mahashakti Nagar, Ujjain, Madhya Pradesh – 456010, India</p>
                        <p><strong>Phone:</strong><br>
                        <a href="tel:+917879780667" style="color: #007bff; text-decoration: none;">+91 7879780667</a><br>
                        <a href="tel:+917987651007" style="color: #007bff; text-decoration: none;">+91 7987651007</a></p>
                        <p><strong>Email:</strong> <a href="mailto:info.kshipreshwardham@gmail.com" style="color: #007bff; text-decoration: underline;">info.kshipreshwardham@gmail.com</a></p>
                        <p><strong>Website:</strong> <a href="https://www.kshipreshwardham.com" target="_blank" style="color: #007bff; text-decoration: underline;">www.kshipreshwardham.com</a></p>

                        <h4>2. Purpose of the Website</h4>
                        <p>The website is intended to provide information about the activities, services, religious and charitable initiatives, events, facilities, and other activities associated with Prem Yamuna Seva Trust.</p>
                        <p>Information published on the website is provided for general informational purposes and may be updated from time to time.</p>

                        <h4>3. Use of the Website</h4>
                        <p>Visitors agree to use the website only for lawful purposes. You must not:</p>
                        <ul>
                            <li>Use the website for any unlawful or fraudulent purpose.</li>
                            <li>Attempt to gain unauthorized access to the website or its systems.</li>
                            <li>Upload or transmit malicious software or harmful content.</li>
                            <li>Copy, reproduce, or misuse website content without permission.</li>
                            <li>Interfere with the security or normal functioning of the website.</li>
                        </ul>

                        <h4>4. Information Accuracy</h4>
                        <p>Prem Yamuna Seva Trust makes reasonable efforts to keep the information on the website accurate and up to date. However, event schedules, facilities, activities, contact information, availability, and other details may change without prior notice.</p>
                        <p>The Trust does not guarantee that all information displayed on the website will always be complete, accurate, or current.</p>

                        <h4>5. Donations and Contributions</h4>
                        <p>Where online donations or contributions are made available through the website, donors are responsible for providing accurate information during the transaction.</p>
                        <p>All donation transactions are subject to verification and successful payment confirmation.</p>
                        <p>Where applicable, refunds or reversals of duplicate or erroneous transactions will be handled according to the Trust's Refund Policy.</p>

                        <h4>6. Third-Party Services</h4>
                        <p>The website may use third-party services such as payment gateways, hosting providers, analytics services, communication services, or social-media platforms.</p>
                        <p>The Trust is not responsible for the policies, availability, security, or practices of third-party services. Users should review the applicable terms and policies of such third parties when using their services.</p>

                        <h4>7. Intellectual Property</h4>
                        <p>Unless otherwise stated, the content available on the website, including text, photographs, graphics, logos, designs, videos, and other materials, belongs to or is used by Prem Yamuna Seva Trust with appropriate rights.</p>
                        <p>No content may be copied, reproduced, modified, distributed, or commercially exploited without prior permission, except where permitted by applicable law.</p>

                        <h4>8. External Links</h4>
                        <p>The website may contain links to third-party websites for informational or convenience purposes. Prem Yamuna Seva Trust does not control these external websites and is not responsible for their content, availability, privacy practices, or terms.</p>

                        <h4>9. Limitation of Liability</h4>
                        <p>Prem Yamuna Seva Trust will make reasonable efforts to maintain the website; however, the Trust does not guarantee uninterrupted or error-free access.</p>
                        <p>To the extent permitted by applicable law, the Trust shall not be liable for losses or damages arising from temporary website unavailability, technical errors, third-party services, or reliance on information published on the website.</p>

                        <h4>10. Privacy</h4>
                        <p>The collection and use of personal information through the website are governed by the Trust's Privacy Policy. By using the website, you acknowledge that you have read and understood the applicable Privacy Policy.</p>

                        <h4>11. Changes to These Terms</h4>
                        <p>Prem Yamuna Seva Trust reserves the right to modify or update these Terms & Conditions at any time. Changes will become effective once published on the website.</p>
                        <p>Visitors are encouraged to review this page periodically.</p>

                        <h4>12. Governing Law</h4>
                        <p>These Terms & Conditions shall be governed by and interpreted in accordance with the laws of India.</p>
                        <p>Any dispute arising in connection with the website or these Terms shall be subject to the applicable courts having jurisdiction over Ujjain, Madhya Pradesh.</p>

                        <h4>13. Contact Us</h4>
                        <p>For questions, concerns, or clarification regarding these Terms & Conditions, please contact:</p>
                        <p><strong>Prem Yamuna Seva Trust</strong><br>
                        113, Hariom Vihar, Mahashakti Nagar,<br>
                        Ujjain, Madhya Pradesh – 456010, India</p>
                        <p><strong>Phone:</strong> <a href="tel:+917879780667" style="color: #007bff; text-decoration: none;">+91 7879780667</a> / <a href="tel:+917987651007" style="color: #007bff; text-decoration: none;">+91 7987651007</a><br>
                        <strong>Email:</strong> <a href="mailto:info.kshipreshwardham@gmail.com" style="color: #007bff; text-decoration: underline;">info.kshipreshwardham@gmail.com</a><br>
                        <strong>Website:</strong> <a href="https://www.kshipreshwardham.com" target="_blank" style="color: #007bff; text-decoration: underline;">www.kshipreshwardham.com</a></p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

@include('pages.common.footer')