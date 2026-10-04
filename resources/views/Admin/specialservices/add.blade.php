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
                        <li class="breadcrumb-item">Services</li>
                        <li class="breadcrumb-item active">Services Add</li>
                    </ol>
                </div>

                <div class="app-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Add New Service</h5>
                                </div>
                                <div class="card-body">
                                  <form id="courseForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <!-- Service Name -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="courseName" class="form-label">Services Name</label>
                                                <input type="text" id="courseName" name="service_name" class="form-control" required />
                                            </div>
                                        </div>

                                        <!-- Service Content -->
                                        

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Service Content</label>
                                            <textarea id="service_content" name="service_content" class="form-control"></textarea>
                                        </div>

                                        <!-- Service Image -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="serviceImage" class="form-label">Service Image</label>
                                                <input type="file" id="serviceImage" name="service_image" accept="image/*" class="form-control" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="serviceImage" class="form-label">Small Image</label>
                                                <input type="file" id="small_image" name="small_image" accept="image/*" class="form-control" required />
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-12">
                                            <button type="button" class="btn btn-primary" onclick="submitCourseForm()">Add Services</button>
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
          let subEditors = {};
            ['service_content', 'report', 'tracksheet'].forEach(id => {
                ClassicEditor.create(document.querySelector('#' + id))
                    .then(editor => {
                        subEditors[id] = editor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });

function submitCourseForm() {

    let form = document.getElementById('courseForm');
    let formData = new FormData(form); // ✅ Direct form se lo

    // CKEditor content update
    if (subEditors['service_content']) {
        formData.set(
            'service_content',
            subEditors['service_content'].getData()
        );
    }

    $.ajax({
        url: "{{ route('Special_Services_store') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                Swal.fire("Success!", response.message, "success")
                .then(() => window.location.href = response.redirect);
            } else {
                Swal.fire("Error!", response.message, "error");
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            Swal.fire("Error!", "CSRF or Server issue.", "error");
        }
    });
}

    </script>

</body>
</html>
