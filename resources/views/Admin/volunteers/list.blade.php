<!DOCTYPE html>
<html lang="en">
<head>
    @include('Admin.common.headerlink')

    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Bootstrap (for modal) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="page-wrapper">
    <div class="main-container">

        @include('Admin.common.sidebar')

        <div class="app-container">

            @include('Admin.common.header')

            <!-- Breadcrumb -->
            <div class="app-hero-header d-flex align-items-start">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <i class="bi bi-house"></i> <a href="">Home</a>
                    </li>
                    <li class="breadcrumb-item">Volunteers</li>
                    <li class="breadcrumb-item active">Volunteer List</li>
                </ol>
            </div>

            <!-- Body -->
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
                                <h5 class="card-title">Volunteer List</h5>
                            </div>

                            <div class="card-body">

                                <!-- TABLE -->
                                <table id="volunteerTable" class="display" style="width:100%;display:none;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Event</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>City</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($volunteers as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->event_name ?? '-' }}</td>
                                                <td>{{ $item->full_name }}</td>
                                                <td>{{ $item->mobile }}</td>
                                                <td>{{ $item->city }}</td>

                                               

                                                <td>
                                                    <button class="btn btn-sm btn-info"
                                                        onclick='viewVolunteer(@json($item))'>
                                                        View
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

<!-- ================= MODAL ================= -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Volunteer Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <table class="table table-bordered">
                    <tr><th>Event</th><td id="v_event"></td></tr>
                    <tr><th>Name</th><td id="v_name"></td></tr>
                    <tr><th>Email</th><td id="v_email"></td></tr>
                    <tr><th>Mobile</th><td id="v_mobile"></td></tr>
                    <tr><th>Gender</th><td id="v_gender"></td></tr>
                    <tr><th>Age</th><td id="v_age"></td></tr>
                    <tr><th>City</th><td id="v_city"></td></tr>
                    <tr><th>Address</th><td id="v_address"></td></tr>
                    <tr><th>Availability</th><td id="v_availability"></td></tr>
                    <tr><th>Experience</th><td id="v_experience"></td></tr>
                    <tr><th>Message</th><td id="v_message"></td></tr>
                </table>

            </div>

        </div>
    </div>
</div>

<!-- ================= SCRIPTS ================= -->
@include('Admin.common.footerlink')

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
        $(document).ready(function() {

            let table = $('#volunteerTable').DataTable();

            // ✅ Loader hide + table show
            $('#tableLoader').fadeOut(300, function() {
                $('#volunteerTable').fadeIn(300);
            });

        });
    </script> 
<script>
    $(document).ready(function () {
        $('#volunteerTable').DataTable();
    });

    function viewVolunteer(data) {

        document.getElementById('v_event').innerText = data.event_name ?? '-';
        document.getElementById('v_name').innerText = data.full_name ?? '-';
        document.getElementById('v_email').innerText = data.email ?? '-';
        document.getElementById('v_mobile').innerText = data.mobile ?? '-';
        document.getElementById('v_gender').innerText = data.gender ?? '-';
        document.getElementById('v_age').innerText = data.age ?? '-';
        document.getElementById('v_city').innerText = data.city ?? '-';
        document.getElementById('v_address').innerText = data.address ?? '-';
        document.getElementById('v_availability').innerText = data.availability ?? '-';
        document.getElementById('v_experience').innerText = data.experience ?? '-';
        document.getElementById('v_message').innerText = data.message ?? '-';

        new bootstrap.Modal(document.getElementById('viewModal')).show();
    }
</script>

</body>
</html>