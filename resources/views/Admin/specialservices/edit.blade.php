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
                        <li class="breadcrumb-item"><i class="bi bi-house"></i><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Course</li>
                        <li class="breadcrumb-item active">Course Edit</li>
                    </ol>
                </div>

                <div class="app-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Edit Course</h5>
                                </div>
                                <div class="card-body">
                                    <form id="courseForm" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" id="courseName" name="id" class="form-control" 
                                                           value="{{ $course->id ?? '' }}" />
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="courseName" class="form-label">Course Name</label>
                                                    <input type="text" id="courseName" name="course_name" class="form-control" 
                                                           value="{{ $course->name ?? '' }}" required />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="coursePrice" class="form-label">Price</label>
                                                    <input type="number" id="coursePrice" name="course_price" class="form-control" 
                                                           value="{{ $course->price ?? '' }}" required />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="courseDiscount" class="form-label">Discount (%)</label>
                                                    <input type="number" id="courseDiscount" name="course_discount" class="form-control" 
                                                           value="{{ $course->discount ?? '' }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="courseImage" class="form-label">Course Image</label>
                                                    <input type="file" id="courseImage" name="course_image" class="form-control" />

                                                    @if(!empty($course->image))
                                                        <img src="{{ asset($course->image) }}" alt="Course Image" 
                                                             class="mt-2 img-thumbnail" width="100">
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="courseDuration" class="form-label">Duration (Months)</label>
                                                    <input type="number" id="courseDuration" name="course_duration" class="form-control" 
                                                           value="{{ $course->duration ?? '' }}" required />
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="courseDescription" class="form-label">Description</label>
                                                    <textarea id="courseDescription" name="course_description" class="form-control" rows="4">{{ $course->description ?? '' }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary" onclick="submitCourseForm()">Update Course</button>
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
        url: "{{ route('admin.course.update') }}",
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
