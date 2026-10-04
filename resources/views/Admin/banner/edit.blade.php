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
                        <li class="breadcrumb-item">Banner</li>
                        <li class="breadcrumb-item active">Banner Edit</li>
                    </ol>
                </div>

                <div class="app-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Edit Banner</h5>
                                </div>
                                <div class="card-body">
                                    <form id="bannerForm" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="banner_id" value="{{ $banner->id }}">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="bannerTitle" class="form-label">Banner Title</label>
                                                <input type="text" id="bannerTitle" name="banner_title" class="form-control" value="{{ $banner->banner_title }}" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="bannerImage" class="form-label">Banner Image</label>
                                                <input type="file" id="bannerImage" name="banner_image" class="form-control" />
                                                
                                                <div class="mt-2">
                                                    <img src="{{ asset($banner->banner_image) }}" width="200" alt="Banner Image">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="button" class="btn btn-primary" onclick="submitBannerForm()">Update Banner</button>
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
       function submitBannerForm() {
    let formData = new FormData($('#bannerForm')[0]);

    $.ajax({
        url: "{{ route('Banner_update', $banner->id) }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                Swal.fire("Updated!", response.message, "success").then(() => {
                    window.location.href = response.redirect;
                });
            } else {
                Swal.fire("Error!", response.message, "error");
            }
        },
        error: function(xhr) {
            Swal.fire("Error!", "Something went wrong. Please try again.", "error");
        }
    });
}

    </script>

</body>
</html>
