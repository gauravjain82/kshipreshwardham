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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Services</li>
                    <li class="breadcrumb-item active">Edit Sub Service</li>
                </ol>
            </div>

            <div class="app-body">
                <form id="subServiceEditForm" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $subService->id }}">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Select Service</label>
                            <select name="service_id" class="form-control">
                                <option value="">Select Service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" {{ $subService->service_id == $service->id ? 'selected' : '' }}>
                                        {{ $service->service_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Service Name</label>
                            <input type="text" name="service_name" value="{{ $subService->service_name }}" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Short Title</label>
                            <textarea name="short_title" class="form-control">{{ $subService->short_title }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Quarterly</label>
                            <input type="number" name="quarterly" value="{{ $subService->quarterly }}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Half Yearly</label>
                            <input type="number" name="half_yearly" value="{{ $subService->half_yearly }}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Yearly</label>
                            <input type="number" name="yearly" value="{{ $subService->yearly }}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Bi-Yearly</label>
                            <input type="number" name="bi_yearly" value="{{ $subService->bi_yearly }}" class="form-control">
                        </div>

                        {{-- ...Other pricing inputs similar... --}}

                        <div class="col-md-12 mb-3">
                            <label>Long Description</label>
                            <textarea id="long_description" name="long_description">{{ $subService->long_description }}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Tracksheet</label>
                            <textarea id="tracksheet" name="tracksheet">{{ $subService->tracksheet }}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Report (PDF)</label>
                            <input type="file" name="report" class="form-control">
                            @if($subService->report)
                                <small class="text-muted">Current: <a href="{{ asset($subService->report) }}" target="_blank">View</a></small>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Service Image</label>
                            <input type="file" name="service_image" class="form-control">
                            @if($subService->service_image)
                                <img src="{{ asset($subService->service_image) }}" alt="Service Image" height="60" />
                            @endif
                        </div>

                        {{-- Dynamic Returns --}}
                        <div class="col-12 mb-3">
                            <h3>Returns</h3>
                        </div>

                        <div id="titleNameContainer">
                            @php $returns = json_decode($subService->return, true); @endphp
                            @foreach($returns as $title => $name)
                                <div class="row mb-3 title-name-group">
                                    <div class="col-md-5">
                                        <input type="text" name="titles[]" value="{{ $title }}" class="form-control" />
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="names[]" value="{{ $name }}" class="form-control" />
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger remove-title-name"><i class="bi bi-dash-lg"></i></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-success add-title-name"><i class="bi bi-plus-lg"></i></button>
                        </div>

                        <div class="col-12">
                            <button type="button" class="btn btn-primary" onclick="updateSubService({{ $subService->id }})">Update</button>
                        </div>
                    </div>
                </form>
            </div>

            @include('Admin.common.footer')
        </div>
    </div>
</div>

<script>
    let subEditors = {};
    ['long_description', 'tracksheet'].forEach(id => {
        ClassicEditor.create(document.querySelector('#' + id))
            .then(editor => { subEditors[id] = editor; })
            .catch(error => console.error(error));
    });

    function updateSubService(id) {
        for (let id in subEditors) {
            document.getElementById(id).value = subEditors[id].getData();
        }

        let formData = new FormData($('#subServiceEditForm')[0]);

        $.ajax({
            url: "/admin/subservice/update/" + id,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.success) {
                    Swal.fire("Updated!", res.message, "success").then(() => {
                        window.location.href = "/admin/subservice/list"; // change this as per your route
                    });
                } else {
                    Swal.fire("Error", res.message, "error");
                }
            },
            error: function() {
                Swal.fire("Error", "Update failed", "error");
            }
        });
    }

    $(document).on('click', '.add-title-name', function () {
        $('#titleNameContainer').append(`
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
        `);
    });

    $(document).on('click', '.remove-title-name', function () {
        $(this).closest('.title-name-group').remove();
    });
</script>
</body>
</html>
