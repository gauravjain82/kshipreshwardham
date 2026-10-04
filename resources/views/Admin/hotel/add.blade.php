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
                        <li class="breadcrumb-item">Rooms</li>
                        <li class="breadcrumb-item active">Rooms Add</li>
                    </ol>
                </div>

                <div class="app-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">Add New Rooms</h5>
                                </div>
                                <div class="card-body">
                                    <form id="hotelForm" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label>Hotel Type</label>
                                            <select name="hotel_type" class="form-control" required>
                                                <option value="">Select Type</option>
                                                <option value="delux">Delux Room</option>
                                                <option value="super">Super Delux Room</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Hotel Name</label>
                                            <input type="text" name="hotel_name" class="form-control" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Price Per Night (₹)</label>
                                            <input type="number" name="price_per_night" class="form-control" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Capacity (Persons)</label>
                                            <input type="number" name="capacity" class="form-control" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Hotel Image</label>
                                            <input type="file" name="hotel_image" class="form-control" required>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label>Amenities (Comma separated)</label>
                                            <input type="text" name="amenities" class="form-control"
                                                   placeholder="AC, WiFi, TV, Attached Bathroom">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control"></textarea>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Add Hotel</button>
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
$(document).ready(function(){

    $('#hotelForm').on('submit', function(e){

        e.preventDefault(); // page reload rokega

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('Hotel_store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response){

                if(response.success){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        confirmButtonColor: '#b8860b'
                    }).then(()=>{
                        window.location.href = response.redirect;
                    });
                }

            },

            error: function(xhr){
                Swal.fire("Error!", "Something went wrong!", "error");
            }

        });

    });

});
</script>

</body>
</html>
