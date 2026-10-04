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
                        <li class="breadcrumb-item">youtube</li>
                        <li class="breadcrumb-item active">Add youtube link and image</li>
                    </ol>
                </div>

                <div class="app-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Upload Images</h5>
                                </div>
                                <div class="card-body">
                                    <form id="galleryForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <!-- Image -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Upload Image</label>
                                                    <input type="file" name="gallery_image" class="form-control" />
                                                </div>
                                            </div>

                                            <!-- YouTube URL -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">YouTube URL</label>
                                                    <input type="text" name="youtube_url" class="form-control" placeholder="Enter YouTube Link" />
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="button" id="submitGalleryBtn" class="btn btn-primary" onclick="submitGalleryForm()">
                                                    Submit
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
function submitGalleryForm() {
    let formData = new FormData($('#galleryForm')[0]);
    let btn = $('#submitGalleryBtn');

    // 🔥 Loader start
    btn.prop('disabled', true);
    btn.html('<span class="spinner-border spinner-border-sm me-2"></span> Processing...');

    $.ajax({
    url: "{{ route('Gallery_store') }}",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    dataType: 'json', // ✅ IMPORTANT

    success: function(response) {

        console.log("Response:", response); // 👈 debug

        btn.prop('disabled', false);
        btn.html('Submit');

        if (response.success === true) {

            showToast(response.message || 'Success', 'success');

            if (response.redirect) {
                setTimeout(() => {
                    window.location.href = response.redirect;
                }, 1500);
            }

        } else {
            showToast(response.message || 'Error', 'error');
        }
    },

    error: function(xhr) {
        btn.prop('disabled', false);
        btn.html('Submit');

        console.log("Error:", xhr.responseText); // 👈 debug

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
</script>

</body>
</html>
