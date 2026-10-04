<!DOCTYPE html>
<html lang="en">
<head>
    @include('Admin.common.headerlink')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

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
        <li class="breadcrumb-item active">Objectives List</li>
    </ol>
</div>

<div class="app-body">
<div class="row">
<div class="col-xl-12">

<div class="card">

<div class="card-header d-flex justify-content-between align-items-center">
    <h5>Objectives List</h5>

    <a href="{{ route('objectives.form') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Add Objective
    </a>
</div>

<div class="card-body">
<div id="tableLoader" style="text-align:center; padding:20px;">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p>Loading data...</p>
                                </div>
<table id="objectiveTable" class="display" style="width:100%; display:none;">
<thead>
<tr>
    <th>#</th>
    <th>Image</th>
    <th>Title</th>
    <th>Description</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
@foreach ($objectives as $index => $item)
<tr>

    <td>{{ $index + 1 }}</td>

    <td>
        <img src="{{ asset($item->image) }}" width="70" height="50">
    </td>

    <td>{{ $item->title }}</td>

    <td>
        {!! Str::limit(strip_tags($item->description), 50) !!}
    </td>

    <td>
        <span class="badge {{ $item->status == 0 ? 'bg-success' : 'bg-danger' }}">
            {{ $item->status == 0 ? 'Active' : 'Deactive' }}
        </span>
    </td>

    <td>
        <button class="btn btn-sm btn-warning"
            onclick='editObjective(@json($item))'>
            <i class="bi bi-pencil"></i>
        </button>

        <button class="btn btn-sm btn-danger" onclick="deleteObjective({{ $item->id }})">
            <i class="bi bi-trash"></i>
        </button>
    </td>

</tr>
@endforeach
</tbody>

</table>

</div>
</div>

</div>
</div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Objective</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <form id="editForm">

                    <input type="hidden" id="edit_id">

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" id="edit_title" class="form-control">
                    </div>

                    <!-- CKEDITOR -->
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea id="edit_description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" id="edit_image" class="form-control">
                        <img id="old_image" width="80" class="mt-2">
                    </div>

                    <button type="button" id="updateBtn" class="btn btn-success w-100">
                        Update
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>

@include('Admin.common.footer')

</div>
</div>
</div>

@include('Admin.common.footerlink')

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
        $(document).ready(function() {

            let table = $('#objectiveTable').DataTable();

            // ✅ Loader hide + table show
            $('#tableLoader').fadeOut(300, function() {
                $('#objectiveTable').fadeIn(300);
            });

        });
    </script> 
<script>
$(document).ready(function() {
    $('#objectiveTable').DataTable();
});
</script>

<!-- CKEDITOR INIT -->
<script>
let editEditor;

ClassicEditor
    .create(document.querySelector('#edit_description'))
    .then(editor => {
        editEditor = editor;
    })
    .catch(error => console.error(error));
</script>

<!-- PAGE LOADER HIDE -->
<script>
$(window).on('load', function () {
    $('#pageLoader').fadeOut(300);
});
</script>

<!-- EDIT -->
<script>
function editObjective(data) {

    $('#edit_id').val(data.id);
    $('#edit_title').val(data.title);

    if (editEditor) {
        editEditor.setData(data.description);
    }

    $('#old_image').attr('src', '/' + data.image);

    new bootstrap.Modal(document.getElementById('editModal')).show();
}
</script>

<!-- UPDATE -->
<script>
$('#updateBtn').on('click', function () {

    let btn = $('#updateBtn');
    let formData = new FormData();

    formData.append('id', $('#edit_id').val());
    formData.append('title', $('#edit_title').val());
    formData.append('description', editEditor.getData());

    let image = $('#edit_image')[0].files[0];
    if (image) {
        formData.append('image', image);
    }

    formData.append('_token', "{{ csrf_token() }}");

    btn.prop('disabled', true);
    btn.html('<span class="spinner-border spinner-border-sm me-2"></span> Updating...');

    $.ajax({
        url: "{{ route('objectives.update') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,

        success: function(res) {

            btn.prop('disabled', false);
            btn.html('Update');

            if (res.success) {
                showToast('Updated successfully', 'success');
                location.reload();
            } else {
                showToast('Update failed', 'error');
            }
        },

        error: function() {
            btn.prop('disabled', false);
            btn.html('Update');
            showToast('Server Error!', 'error');
        }
    });
});
</script>

<!-- DELETE -->
<script>
function deleteObjective(id) {

    if (!confirm("Are you sure?")) return;

    $('#pageLoader').show();

    $.ajax({
        url: "{{ route('objectives.delete', '') }}/" + id,
        type: "DELETE",
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function(res) {

            $('#pageLoader').hide();

            if (res.success) {
                $(`button[onclick="deleteObjective(${id})"]`).closest('tr').remove();
                showToast('Deleted successfully', 'success');
            } else {
                showToast('Delete failed', 'error');
            }
        }
    });
}
</script>

<!-- TOAST -->
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
            padding: 10px 15px;
            border-radius: 5px;
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