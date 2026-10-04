<!DOCTYPE html>
<html lang="en">
<head>
    @include('Admin.common.headerlink')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
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
                    <li class="breadcrumb-item active">Update Content</li>
                </ol>
            </div>

            <div class="app-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Update Website Consssssssstent</h5>
                            </div>
                            <div class="card-body">
                                <form id="contentForm">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $frontend->id }}">

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">About Us Content</label>
                                            <textarea id="about_us" name="about_us" class="form-control">{{ $frontend->about_us ?? '' }}</textarea>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                        <label class="form-label">About Us Image</label>

                                        @if(!empty($frontend->about_us_image))
                                            <div class="mb-2">
                                                <img src="{{ asset($frontend->about_us_image) }}" 
                                                     id="about_preview"
                                                     style="max-width:200px; border-radius:8px;">
                                            </div>
                                        @else
                                            <img id="about_preview" style="max-width:200px; display:none;">
                                        @endif

                                        <input type="file" 
                                               name="about_us_image" 
                                               id="about_us_image"
                                               class="form-control"
                                               accept="image/*"
                                               onchange="previewImage(event)">
                                    </div>
                                        
                                    

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Vision</label>
                                            <textarea id="terms_conditions" name="privacy_policy" class="form-control">{{ $frontend->privacy_policy ?? '' }}</textarea>
                                        </div>

                                      

                                        

                                        <div class="col-12">
                                            <button type="button" id="updateBtn" class="btn btn-primary" onclick="submitContentForm()">
                                                    Update Content
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
   let editors = {}; 

    ['about_us', 'disclaimer', 'privacy_policy', 'refund_policy', 'terms_conditions', 'support', 'elite_club_service'].forEach(id => {

        if(document.querySelector('#' + id)){

            ClassicEditor.create(document.querySelector('#' + id), {
                toolbar: [
                    'heading',
                    '|',
                    'bold', 'italic', 'link',
                    '|',
                    'bulletedList', 'numberedList',
                    '|',
                    'fontSize',   // 🔥 FONT SIZE ADDED
                    '|',
                    'undo', 'redo'
                ],
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 24, 28, 32]
                }
            })
            .then(editor => {
                editors[id] = editor;
            })
            .catch(error => {
                console.error(error);
            });

        }

    });

    function submitContentForm() {

    // CKEditor data sync
    for (let id in editors) {
        if (editors[id]) {
            document.getElementById(id).value = editors[id].getData();
        }
    }

    let formData = new FormData($('#contentForm')[0]);
    let btn = $('#updateBtn');

    // 🔥 LOADER START
    btn.prop('disabled', true);
    btn.html('<span class="spinner-border spinner-border-sm me-2"></span> Updating...');

    $.ajax({
        url: "{{ route('admin.updateFrontendContent') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,

        success: function(response) {

            // 🔄 RESET BUTTON
            btn.prop('disabled', false);
            btn.html('Update Content');

            if (response.success) {

                // ✅ Small toast instead of swal (better UX)
                showToast(response.message, 'success');

                setTimeout(() => {
                    window.location.reload();
                }, 1200);

            } else {
                showToast(response.message, 'error');
            }
        },

        error: function(xhr) {

            btn.prop('disabled', false);
            btn.html('Update Content');

            showToast('Something went wrong!', 'error');
        }
    });
}
function showToast(message, type = 'success') {

    let bg = type === 'success' ? '#28a745' : '#dc3545';

    let toast = $(`
        <div style="
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${bg};
            color: #fff;
            padding: 10px 16px;
            border-radius: 6px;
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
function showToast(message, type = 'success') {

    let bg = type === 'success' ? '#28a745' : '#dc3545';

    let toast = $(`
        <div style="
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${bg};
            color: #fff;
            padding: 10px 16px;
            border-radius: 6px;
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
    function previewImage(event) {
    let reader = new FileReader();
    reader.onload = function(){
        let output = document.getElementById('about_preview');
        output.src = reader.result;
        output.style.display = "block";
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

</body>
</html>
