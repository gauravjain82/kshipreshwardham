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
                        <li class="breadcrumb-item">Gallery List</li>
                        <li class="breadcrumb-item active">Gallery List</li>
                    </ol>
                </div>

                <div class="app-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                <h5>Gallery List</h5>
                                <a href="{{ route('gallery') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-lg"></i> Add Gallery
                                </a>
                            </div>

                                <div class="card-body">

                                <!-- ✅ Loader -->
                                <div id="tableLoader" style="text-align:center; padding:20px;">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p>Loading data...</p>
                                </div>

                                   <table id="galleryTable" class="display" style="width:100%; display:none;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Preview</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($gallery as $index => $img)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>

                                                <td>
                                                    @if($img->gallery_images)
                                                        <img src="{{ asset($img->gallery_images) }}" width="80" height="60">
                                                    @elseif($img->youtube_url)
                                                        @php
                                                            preg_match('/(live\/|v=)([^\?&]+)/', $img->youtube_url, $matches);
                                                            $videoId = $matches[2] ?? '';
                                                        @endphp

                                                        @if($videoId)
                                                            <iframe width="100" height="60"
                                                                src="https://www.youtube.com/embed/{{ $videoId }}"
                                                                frameborder="0"
                                                                allowfullscreen>
                                                            </iframe>
                                                        @else
                                                            <span>Invalid Link</span>
                                                        @endif
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($img->gallery_images)
                                                        <span class="badge bg-success">Image</span>
                                                    @elseif($img->youtube_url)
                                                        <span class="badge bg-danger">YouTube</span>
                                                    @endif
                                                </td>
                                                <td>
                                                <button 
                                                    class="btn btn-sm toggleStatus {{ $img->status == 0 ? 'btn-success' : 'btn-secondary' }}"
                                                    data-id="{{ $img->id }}"
                                                >
                                                    {{ $img->status == 0 ? 'Active' : 'Deactive' }}
                                                </button>
                                            </td>

                                                <td>
                                                    <button class="btn btn-sm btn-danger" onclick="deleteImage({{ $img->id }})">
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

    @include('Admin.common.footerlink')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

     <script>
        $(document).ready(function() {

            let table = $('#galleryTable').DataTable();

            // ✅ Loader hide + table show
            $('#tableLoader').fadeOut(300, function() {
                $('#galleryTable').fadeIn(300);
            });

        });
    </script> 

    <script>
function deleteImage(id) {

    if (!confirm("Are you sure you want to delete?")) return;

    $.ajax({
        url: "{{ route('admin.deleteGallery') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            id: id
        },

        success: function (res) {
            if (res.success) {

                $(`button[onclick="deleteImage(${id})"]`).closest('tr').remove();

                showToast(res.message, 'success');

            } else {
                showToast(res.message, 'error');
            }
        },

        error: function () {
            showToast('Delete failed', 'error');
        }
    });
}
</script>

<script>
$(document).on('click', '.toggleStatus', function () {
    let btn = $(this);
    let id = btn.data('id');

    $.ajax({
        url: "{{ route('admin.toggleStatus') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            id: id
        },
        success: function (res) {
            if (res.success) {

                if (res.status == 0) {
                    btn.removeClass('btn-secondary').addClass('btn-success').text('Active');
                } else {
                    btn.removeClass('btn-success').addClass('btn-secondary').text('Deactive');
                }

                showToast(res.message, 'success');
            } else {
                showToast(res.message, 'error');
            }
        },
        error: function () {
            showToast('Something went wrong', 'error');
        }
    });
});
</script>

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