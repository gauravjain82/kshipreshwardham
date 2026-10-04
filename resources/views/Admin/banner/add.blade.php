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
                        <li class="breadcrumb-item active">Banner Add</li>
                    </ol>
                </div>

                <div class="app-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Add New Banner</h5>
                                </div>
                                <div class="card-body">
                                    <form id="courseForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="courseName" class="form-label">Banner Title</label>
                                                    <input type="text" id="courseName" name="banner_title" class="form-control" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="courseName" class="form-label">Banner Desc</label>
                                                    <input type="text" id="courseName" name="banner_desc" class="form-control" required />
                                                </div>
                                            </div>

                                            

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="courseImage" class="form-label">Banner Image</label>
                                                    <input type="file" id="courseImage" name="banner_image" class="form-control" required />
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary" onclick="submitCourseForm()">Add Banner</button>
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
        function submitCourseForm() {
            let formData = new FormData($('#courseForm')[0]);

            $.ajax({
                url: "{{ route('Banner_store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                     if (response.success) {
                         Swal.fire("Success!", response.message, "success").then(() => {
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
