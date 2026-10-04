<!DOCTYPE html>
<html lang="en">
<head>
    @include('Admin.common.headerlink')

    <!-- ✅ CSRF TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ✅ jQuery (MUST) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- CKEditor -->
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
        <li class="breadcrumb-item"><i class="bi bi-house"></i> Home</li>
        <li class="breadcrumb-item">Objectives</li>
        <li class="breadcrumb-item active">Add Objective</li>
    </ol>
</div>

<div class="app-body">
<div class="row">
<div class="col-xl-12">
<div class="card mb-4">

<div class="card-header">
    <h5 class="card-title">Add Objective</h5>
</div>

<div class="card-body">

<form id="objectiveForm" enctype="multipart/form-data">
@csrf

<div class="row">

<!-- Title -->
<div class="col-md-6">
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>
</div>

<!-- Image -->
<div class="col-md-6">
    <div class="mb-3">
        <label class="form-label">Image</label>
        <input type="file" name="image" class="form-control" required>
    </div>
</div>

<!-- Description -->
<div class="col-md-12">
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" id="description"></textarea>
    </div>
</div>

<!-- Button -->
<div class="col-12">
    <button type="button" id="submitBtn" class="btn btn-primary">
        Add Objective
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

<!-- ✅ CKEDITOR -->
<script>
let descriptionEditor;

ClassicEditor
    .create(document.querySelector('#description'))
    .then(editor => {
        descriptionEditor = editor;
    })
    .catch(error => console.error(error));
</script>

<!-- ✅ TOAST -->
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

<!-- ✅ AJAX SUBMIT -->
<script>
$('#submitBtn').on('click', function () {

    let form = document.getElementById('objectiveForm');
    let formData = new FormData(form);
    let btn = $('#submitBtn');

    // CKEditor data
    if (descriptionEditor) {
        formData.set('description', descriptionEditor.getData());
    }

    // Loader
    btn.prop('disabled', true);
    btn.html('<span class="spinner-border spinner-border-sm me-2"></span> Saving...');

    $.ajax({
        url: "{{ route('objectives.store') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success: function(response) {

            btn.prop('disabled', false);
            btn.html('Add Objective');

            if (response.success) {
                showToast(response.message, 'success');

                setTimeout(() => {
                    window.location.href = response.redirect;
                }, 1200);
            } else {
                showToast(response.message, 'error');
            }
        },

        error: function(xhr) {

            btn.prop('disabled', false);
            btn.html('Add Objective');

            console.log("ERROR:", xhr.responseText);
            showToast('Server Error!', 'error');
        }
    });

});
</script>

</body>
</html>