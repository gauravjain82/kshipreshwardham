<!DOCTYPE html>
<html lang="en">
<head>
    @include('Admin.common.headerlink')
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
        <li class="breadcrumb-item">Settings</li>
        <li class="breadcrumb-item active">Update Information</li>
    </ol>
</div>

<div class="app-body">
<div class="row">
<div class="col-xl-12">

<div class="card mb-4">
<div class="card-header">
    <h5 class="card-title">Update Website Settings</h5>
</div>

<div class="card-body">
<form id="settingsForm" enctype="multipart/form-data">
@csrf

<div class="row">

<!-- Logo -->
<div class="col-md-4">
    <label>Logo</label>
    <input type="file" name="logo" class="form-control" onchange="previewImage(this, '#logoPreview')">
    <img id="logoPreview" src="{{ asset($frontend->logo ?? '') }}" class="img-thumbnail mt-2" style="max-width:200px; {{ $frontend->logo ? '' : 'display:none;' }}">
</div>

<!-- Favicon -->
<div class="col-md-4">
    <label>Favicon</label>
    <input type="file" name="favicon" class="form-control" onchange="previewImage(this, '#faviconPreview')">
    <img id="faviconPreview" src="{{ asset($frontend->favicon ?? '') }}" class="img-thumbnail mt-2" style="max-width:200px; {{ $frontend->favicon ? '' : 'display:none;' }}">
</div>

<!-- Footer -->
<div class="col-md-4">
    <label>Footer logo</label>
    <input type="file" name="footer_logo" class="form-control" onchange="previewImage(this, '#footerPreview')">
    <img id="footerPreview" src="{{ asset($frontend->footer_logo ?? '') }}" class="img-thumbnail mt-2" style="max-width:200px; {{ $frontend->footer_logo ? '' : 'display:none;' }}">
</div>

<!-- Title -->
<div class="col-md-4">
    <label>Website Title</label>
    <input type="text" name="title" class="form-control" value="{{ $frontend->title ?? '' }}">
</div>

<!-- Email -->
<div class="col-md-4">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ $frontend->email ?? '' }}">
</div>

<div class="col-md-4">
    <label>Footer line</label>
    <input type="text" name="footer_line" class="form-control" value="{{ $frontend->footer_line ?? '' }}">
</div>

<div class="col-md-6">
    <label>Phone</label>
    <input type="text" name="mobile_number" class="form-control" value="{{ $frontend->mobile_number ?? '' }}">
</div>

<div class="col-md-6">
    <label>WhatsApp</label>
    <input type="text" name="whatsapp_number" class="form-control" value="{{ $frontend->whatsapp_number ?? '' }}">
</div>

<div class="col-md-12">
    <label>Address</label>
    <textarea name="address" class="form-control">{{ $frontend->address ?? '' }}</textarea>
</div>

@php
$socials = json_decode($frontend->icon_name ?? '[]');
@endphp

<div id="socialWrapper">

@if(!empty($socials))

@foreach($socials as $item)
<div class="row mb-2 social-row mt-5">

<div class="col-md-5">
<select name="icon_name[]" class="form-control" onchange="setSocialUrl(this)">
<option value="">Select Platform</option>
<option value="facebook" {{ $item->name == 'facebook' ? 'selected' : '' }}>Facebook</option>
<option value="instagram" {{ $item->name == 'instagram' ? 'selected' : '' }}>Instagram</option>
<option value="youtube" {{ $item->name == 'youtube' ? 'selected' : '' }}>YouTube</option>
<option value="twitter" {{ $item->name == 'twitter' ? 'selected' : '' }}>Twitter</option>
<option value="whatsapp" {{ $item->name == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
</select>
</div>

<div class="col-md-5">
<input type="text" name="icon_url[]" class="form-control" value="{{ $item->url }}">
</div>

<div class="col-md-2 d-flex gap-1">
<button type="button" class="btn btn-success w-50" onclick="addSocialRow()">+</button>
<button type="button" class="btn btn-danger w-50" onclick="removeRow(this)">-</button>
</div>

</div>
@endforeach

@else

<div class="row mb-2 social-row mt-5">
<div class="col-md-5">
<select name="icon_name[]" class="form-control" onchange="setSocialUrl(this)">
<option value="">Select Platform</option>
<option value="facebook">Facebook</option>
<option value="instagram">Instagram</option>
<option value="youtube">YouTube</option>
<option value="twitter">Twitter</option>
<option value="whatsapp">WhatsApp</option>
</select>
</div>

<div class="col-md-5">
<input type="text" name="icon_url[]" class="form-control">
</div>

<div class="col-md-2">
<button type="button" class="btn btn-success w-100" onclick="addSocialRow()">+</button>
</div>
</div>

@endif

</div>

<div class="col-12">
<button type="button" id="submitBtn" class="btn btn-primary" onclick="submitSettingsForm()">
Update Settings
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

<script>
function previewImage(input, previewId) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            let img = document.querySelector(previewId);
            img.src = e.target.result;
            img.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}

function setSocialUrl(select){
    let urls={
        facebook:"https://facebook.com/",
        instagram:"https://instagram.com/",
        youtube:"https://youtube.com/",
        twitter:"https://twitter.com/",
        whatsapp:"https://wa.me/"
    };

    let input=select.closest('.social-row').querySelector('input[name="icon_url[]"]');
    if(urls[select.value]){
        input.value=urls[select.value];
    }
}

function addSocialRow(){
    let html=`
    <div class="row mb-2 social-row">
        <div class="col-md-5">
            <select name="icon_name[]" class="form-control" onchange="setSocialUrl(this)">
                <option value="">Select Platform</option>
                <option value="facebook">Facebook</option>
                <option value="instagram">Instagram</option>
                <option value="youtube">YouTube</option>
                <option value="twitter">Twitter</option>
                <option value="whatsapp">WhatsApp</option>
            </select>
        </div>

        <div class="col-md-5">
            <input type="text" name="icon_url[]" class="form-control">
        </div>

        <div class="col-md-2 d-flex gap-1">
            <button type="button" class="btn btn-success w-50" onclick="addSocialRow()">+</button>
            <button type="button" class="btn btn-danger w-50" onclick="removeRow(this)">-</button>
        </div>
    </div>
    `;
    document.getElementById('socialWrapper').insertAdjacentHTML('beforeend',html);
}

function removeRow(btn){
    btn.closest('.social-row').remove();
}

function submitSettingsForm(){
    let formData=new FormData($('#settingsForm')[0]);
    let btn=$('#submitBtn');

    btn.prop('disabled',true);
    btn.html('<span class="spinner-border spinner-border-sm me-2"></span> Updating...');

    $.ajax({
        url:"{{ route('admin.updateFrontend') }}",
        type:"POST",
        data:formData,
        processData:false,
        contentType:false,
        success:function(res){
            btn.prop('disabled',false);
            btn.html('Update Settings');
            location.reload();
        }
    });
}
</script>

</body>
</html>