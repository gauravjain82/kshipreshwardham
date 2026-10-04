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
                <h2 class="asas">गोपनीयता नीति (Privacy Policy)</h2>
                <span style="color: #fff;">
                    <a href="/" style="color: #fff;"> Home </a>
                    » &nbsp;&nbsp;Privacy Policy
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Privacy Policy Section -->
<section class="inner-page" style="padding: 60px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="privacy-content-box" style="text-align: left; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.05); line-height: 1.8; font-size: 16px; color: #333;">
                    
                    @if(!empty($content) && !empty($content->privacy_policy))
                        {!! $content->privacy_policy !!}
                    @else
                        <p class="text-center" style="color: #666; font-style: italic;">गोपनीयता नीति अभी अपडेट की जा रही है। कृपया जल्द ही दोबारा देखें।</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>


@include('pages.common.footer')