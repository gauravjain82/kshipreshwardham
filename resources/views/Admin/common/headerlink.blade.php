 <meta charset="utf-8" />
 @php
    $header = DB::table('setting')->first();
@endphp
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>{{$header->title}}</title>
      <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
      <meta name="author" content="Bootstrap Gallery" />
      <link rel="canonical" href="https://www.bootstrap.gallery/">
      <meta property="og:url" content="https://www.bootstrap.gallery/">
      <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
      <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
      <meta property="og:type" content="Website">
      <meta property="og:site_name" content="Bootstrap Gallery">
      <link rel="shortcut icon" href="{{ asset($header->favicon) }}" />
      <!-- *************
         ************ CSS Files *************
         ************* -->
      <link rel="stylesheet" href="{{ asset('assets/admin/fonts/bootstrap/bootstrap-icons.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/admin/css/main.min.css') }}" />
      <!-- *************
         ************ Vendor Css Files *************
         ************ -->
      <!-- Scrollbar CSS -->
      <link rel="stylesheet" href="{{ asset('assets/admin/vendor/overlay-scroll/OverlayScrollbars.min.css') }}" />
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>