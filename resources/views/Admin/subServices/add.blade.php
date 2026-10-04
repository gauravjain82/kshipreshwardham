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
                    <li class="breadcrumb-item active">Add Sub Service</li>
                </ol>
            </div>

            <div class="app-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title">Add Sub Service</h5>
                            </div>
                            <div class="card-body">
                                <form id="subServiceForm" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Select Service</label>
                                            <select name="service_id" class="form-control">
                                                <option value="">Select Service</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Service Name</label>
                                            <input type="text" name="service_name" class="form-control" />
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Short Title</label>
                                            <textarea name="short_title" class="form-control" rows="2"></textarea>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Quarterly</label>
                                            <input type="number" name="quarterly" class="form-control" />
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Half Yearly</label>
                                            <input type="number" name="half_yearly" class="form-control" />
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Yearly</label>
                                            <input type="number" name="yearly" class="form-control" />
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Bi-Yearly</label>
                                            <input type="number" name="bi_yearly" class="form-control" />
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Long Description</label>
                                            <textarea id="long_description" name="long_description" class="form-control"></textarea>
                                        </div>

                                         <div class="col-md-12 mb-3">
                                            <label class="form-label">Tracksheet</label>
                                             <textarea id="tracksheet" name="tracksheet" class="form-control"></textarea>
                                        </div>

                                        

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Service Type</label>
                                            <input type="text" name="service_type" class="form-control" />
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Service Feature</label>
                                            <textarea name="service_feature" class="form-control" rows="2"></textarea>
                                        </div>

                                       
                                          <div class="col-md-12 mb-3">
                                            <label class="form-label">Report</label>
                                            <input type="file" name="report" class="form-control" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Service Image</label>
                                            <input type="file" name="service_image" class="form-control" />
                                        </div>

                                        <!-- Returns Section -->
                                        <div class="col-12 mb-3">
                                            <h3>Returns</h3>
                                        </div>

                                        <div id="titleNameContainer">
                                            <div class="row mb-3 title-name-group">
                                                <div class="col-md-5">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" name="titles[]" class="form-control" />
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" name="names[]" class="form-control" />
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <button type="button" class="btn btn-success add-title-name"><i class="bi bi-plus-lg"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="button" class="btn btn-primary" onclick="submitSubServiceForm()">Submit</button>
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
    ['long_description', 'report', 'tracksheet'].forEach(id => {
        ClassicEditor.create(document.querySelector('#' + id))
            .then(editor => {
                subEditors[id] = editor;
            })
            .catch(error => {
                console.error(error);
            });
    });

    function submitSubServiceForm() {
        for (let id in subEditors) {
            if (subEditors[id]) {
                document.getElementById(id).value = subEditors[id].getData();
            }
        }

        let formData = new FormData($('#subServiceForm')[0]);

        $.ajax({
            url: "{{route('SubService_store')}}", // Your POST route here
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire("Success!", response.message, "success").then(() => {
                        window.location.reload();
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
<script>
    $(document).on('click', '.add-title-name', function () {
        const fieldHTML = `
            <div class="row mb-3 title-name-group">
                <div class="col-md-5">
                    <input type="text" name="titles[]" class="form-control" placeholder="Title" />
                </div>
                <div class="col-md-5">
                    <input type="text" name="names[]" class="form-control" placeholder="Name" />
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-title-name"><i class="bi bi-dash-lg"></i></button>
                </div>
            </div>
        `;
        $('#titleNameContainer').append(fieldHTML);
    });

    $(document).on('click', '.remove-title-name', function () {
        $(this).closest('.title-name-group').remove();
    });
</script>

</body>
</html>