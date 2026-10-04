<!DOCTYPE html>
<html lang="en">
<head>
    @include('Admin.common.headerlink')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

<div class="page-wrapper">
<div class="main-container">
@include('Admin.common.sidebar')

<div class="app-container">
@include('Admin.common.header')

<div class="app-hero-header d-flex align-items-start">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="bi bi-house"></i><a href="#">Home</a></li>
        <li class="breadcrumb-item">Top Banner</li>
        <li class="breadcrumb-item active">Update</li>
    </ol>
</div>

<div class="app-body">
<div class="row">
<div class="col-xl-12">

<div class="card mb-4">
<div class="card-header">
    <h5 class="card-title">Top Banner Images</h5>
</div>

<div class="card-body">

@php
$fields = [
    'about_us' => 'About Us',
    'donate' => 'Donate',
    'voluntree' => 'Voluntree',
    'events' => 'Events',
    'bhakt_nivas' => 'Bhakt Nivas',
    'contact_us' => 'Contact Us',
];
@endphp

<form id="topBannerForm" enctype="multipart/form-data">
@csrf

<div class="row">

@foreach($fields as $key => $label)
<div class="col-md-4 mb-3">

    <label class="form-label">{{ $label }}</label>

    <input type="file" name="{{ $key }}" class="form-control"
        onchange="previewImage(this, '#{{ $key }}Preview')">

    <img id="{{ $key }}Preview"
         src="{{ !empty($top->$key) ? asset($top->$key) : '' }}"
         class="img-thumbnail mt-2"
         style="max-width:200px; {{ !empty($top->$key) ? '' : 'display:none;' }}">

</div>
@endforeach

<div class="col-12 mt-2">
    <button type="button" id="bannerBtn" class="btn btn-success">
        Update Top Banner
    </button>
</div>

</div>

</form>

</div>
</div>

</div>
</div>
</div>

@include('Admin.common.footer')

</div>
</div>
</div>

@include('Admin.common.footerlink')

<!-- IMAGE PREVIEW -->
<script>
function previewImage(input, previewId) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.querySelector(previewId);
            preview.src = e.target.result;
            preview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}
</script>

<!-- UPDATE -->
<script>
$('#bannerBtn').on('click', function () {

    let formData = new FormData($('#topBannerForm')[0]);
    let btn = $('#bannerBtn');

    btn.prop('disabled', true);
    btn.html('<span class="spinner-border spinner-border-sm me-2"></span> Updating...');

    $.ajax({
        url: "{{ route('topbanner.update') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success: function(res) {

            btn.prop('disabled', false);
            btn.html('Update Top Banner');

            if (res.success) {
                showToast(res.message, 'success');
                setTimeout(() => location.reload(), 1200);
            } else {
                showToast('Update failed', 'error');
            }
        },

        error: function() {
            btn.prop('disabled', false);
            btn.html('Update Top Banner');
            showToast('Server Error!', 'error');
        }
    });

});
</script>

<!-- TOAST -->
<script>
function showToast(message, type = 'success') {

    let bg = type === 'success' ? '#28a745' : '#dc3545';

    let toast = $(`
        <div style="
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${bg};
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            z-index: 9999;
        ">
            ${message}
        </div>
    `);

    $('body').append(toast);

    setTimeout(() => {
        toast.fadeOut(300, function () {
            $(this).remove();
        });
    }, 2000);
}
</script>

</body>
</html>