 <div class="app-header d-flex align-items-center">
                  <!-- Toggle buttons start -->
                  <div class="d-flex">
                     <button class="btn btn-outline-primary me-2 toggle-sidebar" id="toggle-sidebar">
                     <i class="bi bi-text-indent-left fs-5"></i>
                     </button>
                     <button class="btn btn-outline-primary me-2 pin-sidebar" id="pin-sidebar">
                     <i class="bi bi-text-indent-left fs-5"></i>
                     </button>
                  </div>
                  <!-- Toggle buttons end -->
                  <!-- App brand sm start -->
                  <div class="app-brand-sm d-md-none d-sm-block">
                     <a href="index.html">
                     <img src="{{ asset('admin/assets/images/logo-sm.svg')}}" class="logo" alt="Bootstrap Gallery">
                     </a>
                  </div>
                  <!-- App brand sm end -->
                  <!-- App header actions start -->
                  <div class="header-actions">
                     <!-- Search container start -->
                     <div class="search-container d-lg-block d-none mx-3">
                        <input type="text" class="form-control" id="searchId" placeholder="Search" />
                        <i class="bi bi-search"></i>
                     </div>
                     <!-- Search container end -->
                    
                     <!-- Header settings starts -->
                     <div class="dropdown ms-3">
                        <a id="userSettings" class="dropdown-toggle" href="#!" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                        <img src="{{ asset('assets/admin/images/user.png')}}" class="profile-avatar" alt="Bootstrap Gallery" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end shadow">
                           <a class="dropdown-item d-flex align-items-center" href="#"><i
                              class="bi bi-person fs-4 me-2"></i>Profile</a>
                           <a class="dropdown-item d-flex align-items-center" href="settings.html"><i
                              class="bi bi-gear fs-4 me-2"></i>Account Settings</a>
                           <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}"><i
                              class="bi bi-escape fs-4 me-2"></i>Logout</a>
                        </div>
                     </div>
                     <!-- Header settings ends -->
                  </div>
                  <!-- App header actions end -->
               </div>