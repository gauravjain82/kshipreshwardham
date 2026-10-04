@include('pages.common.header')

@php
    $header = DB::table('setting')->first();
    $top = DB::table('top_banner')->first();
    $content = DB::table('content')->first();
@endphp

<div class="page-title page-title-inner padding-bottom9"
     style="background-image: url('{{ asset('admin/bbanner.jpg') }}'); background-size: cover;">
     
    <div class="overlay-page-tile"></div>
    <div class="page-title-content">
        <div class="container">
            <div class="blog-title color-white">
                <h2 class="asas">Refund Policy – Prem Yamuna Seva Trust</h2>
                <span style="color: #fff;">
                    <a href="/" style="color: #fff;">Home</a>
                    » &nbsp;&nbsp;Refund Policy
                </span>
            </div>
        </div>
    </div>
</div>

<section class="about-area pt-80 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="about-content">

                    <p>At <strong>Prem Yamuna Seva Trust</strong>, every donation and contribution is made voluntarily to support our charitable, religious, and social welfare activities. We sincerely thank all our donors for their generous support.</p>

                    <h4 class="mt-4 mb-2">1. General Policy</h4>
                    <p>All donations made to <strong>Prem Yamuna Seva Trust</strong> are voluntary and are non-refundable.</p>
                    <p>Once a donation has been successfully processed, it cannot be cancelled or refunded except in the case of a duplicate transaction.</p>

                    <h4 class="mt-4 mb-2">2. Refund Eligibility</h4>
                    <p>A refund will be considered only in the following circumstance:</p>
                    <ul>
                        <li>The donor has made a duplicate payment or duplicate transaction for the same donation.</li>
                    </ul>
                    <p>No other refund requests, including change of mind, incorrect donation amount entered by the donor, or any other reason, will be accepted.</p>

                    <h4 class="mt-4 mb-2">3. Refund Request</h4>
                    <p>To request a refund for a duplicate transaction, the donor must contact us within <strong>7 days</strong> from the date of the transaction and provide the following details:</p>
                    <ul>
                        <li>Donor Name</li>
                        <li>Transaction ID(s)</li>
                        <li>Date of Transaction</li>
                        <li>Donation Amount</li>
                        <li>Proof of Payment</li>
                        <li>Contact Number</li>
                    </ul>
                    <p>Refund requests can be submitted via:</p>
                    <p><strong>Email:</strong> <a href="mailto:info.kshipreshwardham@gmail.com">info.kshipreshwardham@gmail.com</a></p>

                    <h4 class="mt-4 mb-2">4. Refund Processing</h4>
                    <p>After verification of the duplicate transaction, the approved refund will be processed to the original payment method within <strong>7–10 business days</strong>.</p>
                    <p>The actual time taken for the amount to reflect in the donor's account may vary depending on the bank or payment service provider.</p>

                    <h4 class="mt-4 mb-2">5. Fraud Prevention</h4>
                    <p><strong>Prem Yamuna Seva Trust</strong> reserves the right to verify all refund requests. Any fraudulent, misleading, or unverifiable refund requests may be rejected.</p>

                    <h4 class="mt-4 mb-2">6. Changes to This Policy</h4>
                    <p><strong>Prem Yamuna Seva Trust</strong> reserves the right to amend or update this Refund Policy at any time without prior notice. The revised policy will be effective immediately upon publication on the website.</p>

                    <h4 class="mt-4 mb-2">7. Contact Us</h4>
                    <p><strong>Prem Yamuna Seva Trust</strong></p>
                    <p>113, Hariom Vihar, Mahashakti Nagar, Ujjain, Madhya Pradesh – 456010, India</p>
                    <p>
                        <strong>Phone:</strong><br>
                        +91 9575044096<br>
                        +91 7879780667<br>
                        +91 7987651007
                    </p>
                    <p><strong>Email:</strong> <a href="mailto:info.kshipreshwardham@gmail.com">info.kshipreshwardham@gmail.com</a></p>
                    <p><strong>Website:</strong> <a href="http://www.kshipreshwardham.com" target="_blank">www.kshipreshwardham.com</a></p>

                </div>
            </div>
        </div>
    </div>
</section>

@include('pages.common.footer')