<!DOCTYPE html>
<html lang="en">
<head>
    @include('Admin.common.headerlink')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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
        <li class="breadcrumb-item active">Hotel List</li>
    </ol>
</div>

<div class="app-body">
<div class="card">
<div id="tableLoader" style="text-align:center; padding:20px;">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p>Loading data...</p>
                                </div>
<div class="card-header">
    <h5 class="card-title">Hotel List</h5>
    <div class="text-end">
        <a href="{{ route('Hotel_add') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Hotel
        </a>
    </div>
</div>

<div class="card-body">

<table id="hotelTable" class="display" style="width:100%; display: none;">
<thead>
<tr>
    <th>#</th>
    <th>Image</th>
    <th>Type</th>
    <th>Name</th>
    <th>Price</th>
    <th>Capacity</th>
    <th>Status</th>
    <th>Actions</th>
</tr>
</thead>

<tbody>
@foreach ($hotels as $index => $hotel)
<tr>
<td>{{ $index + 1 }}</td>

<td>
@if($hotel->hotel_image)
    <img src="{{ asset($hotel->hotel_image) }}" width="60">
@endif
</td>

<td>{{ ucfirst($hotel->hotel_type) }}</td>
<td>{{ $hotel->hotel_name }}</td>
<td>₹ {{ $hotel->price_per_night }}</td>
<td>{{ $hotel->capacity }} Persons</td>

<td>
@if($hotel->status == 1)
<span class="badge bg-success">Active</span>
@else
<span class="badge bg-danger">Inactive</span>
@endif
</td>

<td>
<button class="btn btn-sm btn-warning"
onclick="openEditModal(
{{ $hotel->id }},
'{{ $hotel->hotel_type }}',
'{{ addslashes($hotel->hotel_name) }}',
{{ $hotel->price_per_night }},
{{ $hotel->capacity }},
'{{ addslashes($hotel->amenities) }}',
`{{ addslashes($hotel->description) }}`,
'{{ asset($hotel->hotel_image) }}'
)">
<i class="bi bi-pencil"></i>
</button>

<button class="btn btn-sm btn-danger"
onclick="deleteHotel({{ $hotel->id }})">
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

<div class="modal fade" id="editHotelModal">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Edit Hotel</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<form id="editHotelForm" enctype="multipart/form-data">
@csrf
<input type="hidden" name="id" id="edit_id">

<div class="mb-3">
<label>Hotel Type</label>
<select name="hotel_type" id="edit_type" class="form-control">
<option value="delux">Delux</option>
<option value="super">Super Delux</option>
</select>
</div>

<div class="mb-3">
<label>Hotel Name</label>
<input type="text" name="hotel_name" id="edit_name" class="form-control">
</div>

<div class="mb-3">
<label>Price</label>
<input type="number" name="price_per_night" id="edit_price" class="form-control">
</div>

<div class="mb-3">
<label>Capacity</label>
<input type="number" name="capacity" id="edit_capacity" class="form-control">
</div>

<div class="mb-3">
<label>Amenities</label>
<input type="text" name="amenities" id="edit_amenities" class="form-control">
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description" id="edit_description" class="form-control"></textarea>
</div>

<!-- Current Image -->
<div class="mb-3">
<label>Current Image</label><br>
<img id="current_image" src="" width="80" class="mb-2">
</div>

<!-- Upload New Image -->
<div class="mb-3">
<label>Change Image</label>
<input type="file" name="hotel_image" class="form-control">
</div>

<button type="submit" class="btn btn-primary w-100">
Update Hotel
</button>

</form>

</div>
</div>
</div>
</div>

@include('Admin.common.footerlink')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
        $(document).ready(function() {

            let table = $('#hotelTable').DataTable();

            // ✅ Loader hide + table show
            $('#tableLoader').fadeOut(300, function() {
                $('#hotelTable').fadeIn(300);
            });

        });
    </script> 
<script>
$(document).ready(function(){
    $('#hotelTable').DataTable();
});

// Open Edit Modal
function openEditModal(id,type,name,price,capacity,amenities,description,image){

    $('#edit_id').val(id);
    $('#edit_type').val(type);
    $('#edit_name').val(name);
    $('#edit_price').val(price);
    $('#edit_capacity').val(capacity);
    $('#edit_amenities').val(amenities);
    $('#edit_description').val(description);

    $('#current_image').attr('src', image);

    $('#editHotelModal').modal('show');
}

// Update Hotel
$('#editHotelForm').on('submit', function(e){

    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "{{ route('Hotel_update') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){
            Swal.fire("Updated!", "Hotel updated successfully", "success")
            .then(()=> location.reload());
        },
        error:function(){
            Swal.fire("Error!", "Something went wrong", "error");
        }
    });

});

// Delete Hotel
function deleteHotel(id){

Swal.fire({
title: "Are you sure?",
icon: "warning",
showCancelButton: true,
confirmButtonColor: "#d33",
confirmButtonText: "Yes delete"
}).then((result)=>{

if(result.isConfirmed){

$.ajax({
type: "POST",
data: {_token:"{{ csrf_token() }}", id:id},
success:function(){
Swal.fire("Deleted!","Hotel removed successfully","success")
.then(()=> location.reload());
}
});

}

});

}
</script>

</body>
</html>