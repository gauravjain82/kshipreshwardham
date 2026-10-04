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
                    <li class="breadcrumb-item">Sub Services</li>
                    <li class="breadcrumb-item active">Sub Services List</li>
                </ol>
            </div>

            <div class="app-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Sub Services List</h5>
                                <a href="{{ route('Sub_add') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-lg"></i> Add Sub Services
                                </a>
                            </div>

                            <div class="card-body">
                               <table id="courseTable" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th> 
                                            <th>Sub Services Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $index => $course)
                                            <tr>
                                                <td>{{ $index + 1 }}</td> 
                                                <td>{{ $course->service_name }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning" onclick="window.location.href='{{ route('SubService_edit', $course->id) }}'">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>

                                                    <button class="btn btn-sm btn-danger" onclick="deleteCourse({{ $course->id }})">
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

            @include('Admin.common.footer')
        </div>
    </div>
</div>

<!-- Edit Modal -->
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Service</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="edit_id">
            <div class="mb-3">
                <label for="edit_service_name" class="form-label">Service Name</label>
                <input type="text" class="form-control" id="edit_service_name" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" onclick="submitEdit()">Save Changes</button>
        </div>
    </div>
  </div>
</div>


@include('Admin.common.footerlink')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#courseTable').DataTable();
    });

function openEditModal(id, serviceName) {
    $('#edit_id').val(id);
    $('#edit_service_name').val(serviceName);
    $('#editModal').modal('show');
}

function submitEdit() {
    var id = $('#edit_id').val();
    var serviceName = $('#edit_service_name').val();

    if (serviceName.trim() === '') {
        Swal.fire("Validation Error", "Service Name is required!", "warning");
        return;
    }

    $.ajax({
        url: "{{ route('admin.service.edit') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            id: id,
            service_name: serviceName
        },
        success: function(response) {
            $('#editModal').modal('hide');
            Swal.fire("Success!", "Service updated successfully.", "success").then(() => {
                location.reload();
            });
        },
        error: function(xhr) {
            Swal.fire("Error!", "Something went wrong while updating.", "error");
        }
    });
}

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
                    url: "{{ route('admin.course.delete', '') }}/" + courseId,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire("Deleted!", "Course has been deleted.", "success");
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
