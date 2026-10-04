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
                        <li class="breadcrumb-item"><i class="bi bi-house"></i><a href="">Home</a></li>
                        <li class="breadcrumb-item">Banner</li>
                        <li class="breadcrumb-item active">Banner List</li>
                    </ol>

                </div>


                <div class="app-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div id="tableLoader" style="text-align:center; padding:20px;">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p>Loading data...</p>
                                </div>
                                <div class="card-header">
                                    <h5 class="card-title">Banner List</h5>
                                    <div class="text-end">
                                        <a href="{{ route('Banner_add') }}" class="btn btn-primary">
                                            <i class="bi bi-plus-lg"></i> Add Banner
                                        </a>
                                    </div>
                                </div>

                                <div class="card-body">
                                   <table id="courseTable" class="display" style="width:100%; display:none;">
                                        <thead>
                                            <tr>
                                                <th>#</th> <!-- Serial Number Column -->
                                                <th>Banner Title</th>
                                                <th>Banner Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($banner as $index => $banner)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td> 
                                                    <td>{{ $banner->banner_title }}</td>
                                                
                                                    <td><img src="{{ asset($banner->banner_image) }}" width="100"></td>
                                                    
                                                    <td>
                                                       <a href="{{ route('Banner_edit', $banner->id) }}" class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                        <button class="btn btn-sm btn-danger" onclick="deleteCourse({{ $banner->id }})"><i class="bi bi-trash"></i></button>
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

                @include('Admin.common.footer')
            </div>
        </div>
    </div>

    @include('Admin.common.footerlink')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {

            let table = $('#courseTable').DataTable();

            // ✅ Loader hide + table show
            $('#tableLoader').fadeOut(300, function() {
                $('#courseTable').fadeIn(300);
            });

        });
    </script> 
    <script>
        $(document).ready(function() {
            $('#courseTable').DataTable();
        });


        function deleteCourse(courseId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.banner.delete', '') }}/" + courseId,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: courseId
                        },
                        success: function(response) {
                            Swal.fire("Deleted!", "Banner has been deleted.", "success");
                            location.reload();
                        },
                        error: function(xhr) {
                            Swal.fire("Error!", "Something went wrong.", "error");
                        }
                    });
                }
            });
        }


    </script>
    
</body>
</html>
