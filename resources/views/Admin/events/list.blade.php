<!DOCTYPE html>
<html lang="en">
<head>
    @include('Admin.common.headerlink')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- ✅ CKEDITOR CDN -->
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
        <li class="breadcrumb-item">Events</li>
        <li class="breadcrumb-item active">Events List</li>
    </ol>
</div>

<div class="app-body">
<div class="card">
    <div id="tableLoader" style="text-align:center; padding:20px;">
        <div class="spinner-border text-primary" role="status"></div>
        <p>Loading data...</p>
    </div>

<div class="card-header">
    <h5 class="card-title">Events</h5>
    <a href="{{ route('events_add') }}" class="btn btn-primary float-end">Add Event</a>
</div>

<div class="card-body">

<table id="eventTable" class="display" style="display:none;">
<thead>
<tr>
    <th>#</th>
    <th>Banner</th>
    <th>Event Name</th>
    <th>Location</th>
    <th>Start</th>
    <th>End</th>
    <th>Status</th>
    <th>Featured</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
@foreach($events as $index => $event)
<tr>
<td>{{ $index+1 }}</td>

<td>
@if($event->banner_image)
<img src="{{ asset($event->banner_image) }}" width="80">
@else
<span class="text-muted">No Image</span>
@endif
</td>

<td>{{ $event->event_name }}</td>
<td>{{ $event->location }}</td>
<td>{{ $event->start_date }}</td>
<td>{{ $event->end_date }}</td>

<td>
@if($event->status == 1)
<span class="badge bg-success">Active</span>
@else
<span class="badge bg-danger">Closed</span>
@endif
</td>

<td>
@if($event->featured == 1)
<span class="badge bg-primary">Yes</span>
@else
<span class="badge bg-secondary">No</span>
@endif
</td>

<td>
<a href="javascript:void(0)" class="btn btn-sm btn-warning"
onclick='openEditModal(@json($event))'>
<i class="bi bi-pencil"></i>
</a>

<button onclick="deleteEvent({{ $event->id }})" class="btn btn-sm btn-danger">
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

<!-- ================= EDIT MODAL ================= -->
<div class="modal fade" id="eventModal">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<h5>Edit Event</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<form id="eventForm" enctype="multipart/form-data">
@csrf
<input type="hidden" name="id" id="event_id">

<div class="row">

<div class="col-md-6 mb-3">
<label>Event Name</label>
<input type="text" name="event_name" id="event_name" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Slug</label>
<input type="text" name="slug" id="slug" class="form-control" readonly>
</div>

<div class="col-md-6 mb-3">
<label>Location</label>
<input type="text" name="location" id="location" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Banner Image</label>
<input type="file" name="banner_image" id="banner_image" class="form-control">
<img id="banner_preview" width="120" class="mt-2">
</div>

<div class="col-md-4 mb-3">
<label>Start Date</label>
<input type="date" name="start_date" id="start_date" class="form-control">
</div>

<div class="col-md-4 mb-3">
<label>End Date</label>
<input type="date" name="end_date" id="end_date" class="form-control">
</div>

<div class="col-md-4 mb-3">
<label>Registration Last Date</label>
<input type="date" name="registration_last_date" id="registration_last_date" class="form-control">
</div>

<div class="col-md-4 mb-3">
<label>Volunteer Required</label>
<select name="volunteer_required" id="volunteer_required" class="form-control">
<option value="1">Yes</option>
<option value="0">No</option>
</select>
</div>

<div class="col-md-4 mb-3">
<label>Status</label>
<select name="status" id="status" class="form-control">
<option value="1">Active</option>
<option value="0">Closed</option>
</select>
</div>

<div class="col-md-4 mb-3">
<label>Featured</label>
<select name="featured" id="featured" class="form-control">
<option value="1">Yes</option>
<option value="0">No</option>
</select>
</div>

<div class="col-md-12 mb-3">
<label>Description</label>
<textarea name="description" id="description" class="form-control"></textarea>
</div>

</div>
</form>
</div>

<div class="modal-footer">
<button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
<button class="btn btn-primary" onclick="submitEdit()">Update Event</button>
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

<!-- ✅ CKEDITOR INIT -->
<script>
let editor;

ClassicEditor.create(document.querySelector('#description'))
.then(newEditor => {
    editor = newEditor;
})
.catch(error => {
    console.error(error);
});
</script>

<script>
$(document).ready(function () {

    $('#eventTable').DataTable();

    $('#tableLoader').fadeOut(300, function () {
        $('#eventTable').fadeIn(300);
    });

});

function deleteEvent(id){

    Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        confirmButtonText: "Yes delete"
    }).then((result)=>{

        if(result.isConfirmed){

            $.ajax({
                type: "DELETE",
                data: {_token:"{{ csrf_token() }}"},
                success:function(){
                    Swal.fire("Deleted!","Event deleted","success")
                    .then(()=> location.reload());
                }
            });

        }
    });

}

function openEditModal(event){

    $('#event_id').val(event.id);
    $('#event_name').val(event.event_name);
    $('#slug').val(event.slug);
    $('#location').val(event.location);
    $('#start_date').val(event.start_date);
    $('#end_date').val(event.end_date);
    $('#registration_last_date').val(event.registration_last_date);
    $('#volunteer_required').val(event.volunteer_required);
    $('#status').val(event.status);
    $('#featured').val(event.featured);

    // ✅ CKEDITOR SET DATA
    if(editor){
        editor.setData(event.description ?? '');
    }

    if(event.banner_image){
        $('#banner_preview').attr('src','/'+event.banner_image).show();
    }else{
        $('#banner_preview').hide();
    }

    $('#eventModal').modal('show');
}

function submitEdit(){

    let formData = new FormData($('#eventForm')[0]);

    // ✅ CKEDITOR GET DATA
    formData.set('description', editor.getData());

    $.ajax({
        url:"{{ route('Events_update') }}",
        type:"POST",
        data:formData,
        processData:false,
        contentType:false,
        success:function(res){
            Swal.fire("Success!","Event Updated","success")
            .then(()=> location.reload());
        },
        error:function(){
            Swal.fire("Error!","Update failed","error");
        }
    });

}
</script>

</body>
</html>