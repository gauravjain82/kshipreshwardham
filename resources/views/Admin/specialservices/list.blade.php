<!DOCTYPE html>
<html lang="en">
<head>
    @include('Admin.common.headerlink')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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
        <li class="breadcrumb-item">Special Services</li>
        <li class="breadcrumb-item active">Special Services List</li>
    </ol>
</div>

<div class="app-body">
<div class="card">
<div class="card-header d-flex justify-content-between align-items-center">
    <h5>Special Services List</h5>
    <a href="{{ route('Special_add') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Add Special Services
    </a>
</div>

<div class="card-body">
<table id="courseTable" class="display">
<thead>
<tr>
    <th>#</th>
    <th>Name</th>
    <th>Main Image</th>
    <th>Small Image</th>
    <th>Actions</th>
</tr>
</thead>

<tbody>
@foreach ($courses as $index => $course)
<tr>
<td>{{ $index + 1 }}</td>
<td>{{ $course->service_name }}</td>

<td>
@if($course->service_image)
<img src="{{ asset($course->service_image) }}" width="70">
@endif
</td>

<td>
@if($course->small_image)
<img src="{{ asset($course->small_image) }}" width="60">
@endif
</td>

<td>
<button class="btn btn-warning btn-sm"
onclick="openEditModal(
{{ $course->id }},
`{{ addslashes($course->service_name) }}`,
`{{ asset($course->service_image) }}`,
`{{ asset($course->small_image) }}`,
`{{ addslashes($course->service_content) }}`
)">
<i class="bi bi-pencil"></i>
</button>

<button class="btn btn-danger btn-sm"
onclick="deleteCourse({{ $course->id }})">
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

@include('Admin.common.footer')
</div>
</div>
</div>

<!-- ================= EDIT MODAL ================= -->

<div class="modal fade" id="editModal">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<h5>Edit Special Service</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<input type="hidden" id="edit_id">

<div class="mb-3">
<label>Service Name</label>
<input type="text" id="edit_service_name" class="form-control">
</div>

<div class="row">

<div class="col-md-6">
<label>Main Image</label>
<img id="current_service_image" width="100" class="mb-2">
<input type="file" id="edit_service_image" class="form-control">
</div>

<div class="col-md-6">
<label>Small Image</label>
<img id="current_small_image" width="80" class="mb-2">
<input type="file" id="edit_small_image" class="form-control">
</div>

</div>

<div class="mt-3">
<label>Service Content</label>
<textarea id="edit_service_content" class="form-control"></textarea>
</div>

</div>

<div class="modal-footer">
<button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
<button class="btn btn-primary" onclick="submitEdit()">Update</button>
</div>

</div>
</div>
</div>

@include('Admin.common.footerlink')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>

let editor;

ClassicEditor
.create(document.querySelector('#edit_service_content'))
.then(newEditor => {
    editor = newEditor;
})
.catch(error => console.error(error));

$(document).ready(function() {
    $('#courseTable').DataTable();
});

function openEditModal(id, name, imageUrl, smallImageUrl, content) {

    $('#edit_id').val(id);
    $('#edit_service_name').val(name);

    $('#current_service_image').attr('src', imageUrl);
    $('#current_small_image').attr('src', smallImageUrl);

    if(editor){
        editor.setData(content);
    }

    $('#editModal').modal('show');
}

function submitEdit(){

let formData = new FormData();

formData.append('_token',"{{ csrf_token() }}");
formData.append('id',$('#edit_id').val());
formData.append('service_name',$('#edit_service_name').val());
formData.append('service_content',editor.getData());

let mainImage = $('#edit_service_image')[0].files[0];
let smallImage = $('#edit_small_image')[0].files[0];

if(mainImage){
formData.append('service_image',mainImage);
}

if(smallImage){
formData.append('small_image',smallImage);
}

$.ajax({
url:"{{ route('Special_Services_update') }}",
type:"POST",
data:formData,
processData:false,
contentType:false,
success:function(){
Swal.fire("Updated!","Service updated successfully","success")
.then(()=>location.reload());
}
});
}

</script>
</body>
</html>