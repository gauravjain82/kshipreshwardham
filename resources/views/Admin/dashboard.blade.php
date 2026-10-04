<!DOCTYPE html>
<html lang="en">
   <head>
    @include('Admin.common.headerlink')
     
   </head>
   <body>
      <!-- Page wrapper start -->
      <div class="page-wrapper">
         <!-- Main container start -->
         <div class="main-container">
            <!-- Sidebar wrapper start -->
            @include('Admin.common.sidebar')
            <!-- Sidebar wrapper end -->
            <!-- App container starts -->
            <div class="app-container">
               <!-- App header starts -->
              @include('Admin.common.header')

               <!-- App header ends -->
               <!-- App hero header starts -->
               <div class="app-hero-header d-flex align-items-start">
                  <!-- Breadcrumb start -->
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item">
                        <i class="bi bi-house"></i>
                        <a href="#">Home</a>
                     </li>
                     <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                  </ol>
                  <!-- Breadcrumb end -->
                 
               </div>
               <!-- App Hero header ends -->
               <!-- App body starts -->
               <div class="app-body">
                  <!-- Row starts -->
                  <div class="row">
                     <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card mb-4">
                           <div class="card-body d-flex align-items-center p-0">
                              <div class="stats-icon bg-danger">
                                 <i class="bi bi-pie-chart fs-2 text-white"></i>
                              </div>
                              <div class="py-4">
                                 <h5 class="text-secondary fw-light mb-1">Total volunteers</h5>
                                 <h1 class="m-0">@php echo DB::table('volunteers')->count(); @endphp</h1>
                              </div>
                              <span class="badge bg-primary-subtle text-primary position-absolute top-0 end-0 m-3"><i
                                 class="bi bi-caret-up-fill"></i>18%</span>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card mb-4">
                           <div class="card-body d-flex align-items-center p-0">
                              <div class="stats-icon bg-danger">
                                 <i class="bi bi-sticky fs-2 text-white"></i>
                              </div>
                              <div class="py-4">
                                 <h5 class="text-secondary fw-light mb-1">Banner</h5>
                                 <h1 class="m-0">@php echo DB::table('banner')->count(); @endphp</h1>
                              </div>
                              <span class="badge bg-primary-subtle text-primary position-absolute top-0 end-0 m-3"><i
                                 class="bi bi-caret-up-fill"></i>15%</span>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card mb-4">
                           <div class="card-body d-flex align-items-center p-0">
                              <div class="stats-icon bg-danger">
                                 <i class="bi bi-emoji-smile fs-2 text-white"></i>
                              </div>
                              <div class="py-4">
                                 <h5 class="text-secondary fw-light mb-1">Events</h5>
                                 <h1 class="m-0">@php echo DB::table('events')->count(); @endphp</h1>
                              </div>
                              <span class="badge bg-primary-subtle text-primary position-absolute top-0 end-0 m-3"><i
                                 class="bi bi-caret-up-fill"></i>11%</span>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card mb-4">
                           <div class="card-body d-flex align-items-center p-0">
                              <div class="stats-icon bg-danger">
                                 <i class="bi bi-star fs-2 text-white"></i>
                              </div>
                              <div class="py-4">
                                 <h5 class="text-secondary fw-light mb-1">Gallery</h5>
                                 <h1 class="m-0 text-danger">@php echo DB::table('gallery')->count(); @endphp</h1>
                              </div>
                              <span class="badge bg-danger-subtle text-danger position-absolute top-0 end-0 m-3"><i
                                 class="bi bi-caret-down-fill"></i>9%</span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-title">Overview Statistics</h5>
                     </div>
                     <div class="card-body">
                        <canvas id="dashboardChart" height="100"></canvas>
                     </div>
                  </div>
               </div>
              </div>
               </div>
               <!-- App body ends -->
               <!-- App footer start -->
                 @include('Admin.common.footer')

               <!-- App footer end -->
            </div>
            <!-- App container ends -->
         </div>
         <!-- Main container end -->
      </div>
      <!-- Page wrapper end -->
      <!-- *************
         ************ JavaScript Files *************
         ************* -->
      <!-- Required jQuery first, then Bootstrap Bundle JS -->
      @include('Admin.common.footerlink')
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('dashboardChart').getContext('2d');

    const dashboardChart = new Chart(ctx, {
        type: 'bar', // bar / line / pie bhi kar sakte ho
        data: {
            labels: ['Services', 'Banner', 'Events', 'Gallery'],
            datasets: [{
                label: 'Total Count',
                data: [12, 5, 8, 15], // Static values
                backgroundColor: [
                    '#0d6efd',
                    '#198754',
                    '#ffc107',
                    '#dc3545'
                ],
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

});
</script>
   </body>
</html>