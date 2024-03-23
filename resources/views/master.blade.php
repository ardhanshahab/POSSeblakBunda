<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Dashboard Page | @yield('title')</title>
   <!-- plugins:css -->
   <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
   <!-- endinject -->
   <!-- Plugin css for this page -->
   <link rel="stylesheet" href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">

   {{-- Bootstrap Icons --}}
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
   <!-- End plugin css for this page -->
   <!-- inject:css -->
   <!-- endinject -->
   <!-- Layout styles -->
   <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
   <!-- End layout styles -->
   <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body>
   <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
         <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            {{-- <a class="sidebar-brand brand-logo" href="index.html"><img src="{{ asset('assets/images/logo.svg') }}"
                  alt="logo" /></a> --}}
            <a class="sidebar-brand brand-logo text-white" style="text-decoration: none" href="">Cafe Bisa Ngopi</a>
            {{-- <a class="sidebar-brand brand-logo-mini" href="index.html"><img
                  src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a> --}}
            <a class="sidebar-brand brand-logo-mini text-white" style="text-decoration: none" href="">CBN</a>
         </div>
         <ul class="nav">
            <li class="nav-item profile">
               <div class="profile-desc">
                  <div class="profile-pic">
                     <div class="count-indicator">
                        @if (Auth::user()->profile_image == true)
                        <img class="img-xs rounded-circle" src="{{ asset(auth()->user()->profile_image) }}" alt="Profile Image">
                        @else
                        <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/blank-profile-picture.png') }}" alt="Profile Image">
                        @endif
                        <span class="count bg-success"></span>
                     </div>
                     <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">{{ Str::limit(auth()->user()->name, 16, '...') }}</h5>
                        <span>Role: {{ auth()->user()->role }}</span>
                     </div>
                  </div>
               </div>
            </li>
            <li class="nav-item nav-category">
               <span class="nav-link">Navigation</span>
            </li>
            @if (auth()->user()->role == 'Admin')
            <li class="nav-item menu-items">
               <a class="nav-link" href="/admin/dashboard">
                  <span class="menu-icon">
                     <i class="mdi mdi-account"></i>
                  </span>
                  <span class="menu-title">Users</span>
               </a>
            </li>
            @endif

            @if (auth()->user()->role == 'Manager')
            <li class="menu-items {{ request()->is('manager/dashboard') ? 'nav-item' : '' }}">
               <a class="nav-link" href="/manager/dashboard">
                  <span class="menu-icon">
                     <i class="mdi mdi-view-dashboard"></i>
                  </span>
                  <span class="menu-title" style="color: #fff">Menu's</span>
               </a>
            </li>
            <li class="menu-items {{ request()->is('manager/dashboard/report') ? 'nav-item' : '' }}">
               <a class="nav-link" href="/manager/dashboard/report">
                  <span class="menu-icon">
                     <i class="mdi mdi-library-books"></i>
                  </span>
                  <span class="menu-title" style="color: #fff;">Report</span>
               </a>
            </li>
            @endif

            @if (auth()->user()->role == 'Kasir')
            <li class="nav-item menu-items">
               <a class="nav-link" href="/kasir/dashboard">
                  <span class="menu-icon">
                     <i class="mdi mdi-cash-100"></i>
                  </span>
                  <span class="menu-title">Transactions</span>
               </a>
            </li>
            @endif

         </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
         <!-- partial:partials/_navbar.html -->
         <nav class="navbar p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
               <a class="navbar-brand brand-logo-mini" href="index.html"><img
                     src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
               <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                  <span class="mdi mdi-menu"></span>
               </button>
               <ul class="navbar-nav w-100">
                  <li class="nav-item w-100">
                     @if (auth()->user()->role == 'Admin')
                        @include('partials.user-search')
                     @endif
                     @if (auth()->user()->role == 'Manager' && request()->is('manager/dashboard'))
                        @include('partials.menu-search')
                     @endif
                     @if (auth()->user()->role == 'Manager' && request()->is('manager/dashboard/report'))
                        @include('partials.report-search')
                     @endif
                     @if (auth()->user()->role == 'Kasir')
                        @include('partials.transaction-search')
                     @endif
                  </li>
               </ul>
               <ul class="navbar-nav navbar-nav-right">
                  <li class="nav-item dropdown">
                     <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                        <div class="navbar-profile">
                           @if (Auth::user()->profile_image == true)
                           <img class="img-xs rounded-circle" src="{{ asset(auth()->user()->profile_image) }}" alt="Profile Image">
                           @else
                           <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/blank-profile-picture.png') }}"
                              alt="Profile Image">
                           @endif
                           <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Str::limit(auth()->user()->name, 16, '...') }}</p>
                           <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                        </div>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                        aria-labelledby="profileDropdown">
                        <h6 class="p-3 mb-0">Profile</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item" href="{{ route('profile.index') }}">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-dark rounded-circle">
                                 <i class="mdi mdi-account-circle text-primary"></i>
                              </div>
                           </div>
                           <div class="preview-item-content">
                              <p class="preview-subject mb-1">Profile Settings</p>
                           </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item" href="{{ route('change.password.index') }}">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-dark rounded-circle">
                                 <i class="mdi mdi-onepassword text-info"></i>
                              </div>
                           </div>
                           <div class="preview-item-content">
                              <p class="preview-subject mb-1">Change Password</p>
                           </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/logout" class="dropdown-item preview-item">
                           <div class="preview-thumbnail">
                              <div class="preview-icon bg-dark rounded-circle">
                                 <i class="mdi mdi-logout text-danger"></i>
                              </div>
                           </div>
                           <div class="preview-item-content">
                              <p class="preview-subject mb-1">Log out</p>
                           </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <p class="p-3 mb-0 text-center">Advanced settings</p>
                     </div>
                  </li>
               </ul>
               <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                  data-toggle="offcanvas">
                  <span class="mdi mdi-format-line-spacing"></span>
               </button>
            </div>
         </nav>
         <!-- partial -->
         <div class="main-panel">
            <div class="content-wrapper">
               @yield('content')
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
               <div class="d-sm-flex justify-content-center justify-content-sm-between">
                  <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                     bootstrapdash.com 2020</span>
                  <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                        href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
                        templates</a> from Bootstrapdash.com</span>
               </div>
            </footer>
            <!-- partial -->
         </div>
         <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
   </div>
   <!-- container-scroller -->
   <!-- plugins:js -->
   <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
   <!-- endinject -->
   <!-- Plugin js for this page -->
   <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
   <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
   <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
   <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
   <script src="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
   <!-- End plugin js for this page -->
   <!-- inject:js -->
   <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
   <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
   <script src="{{ asset('assets/js/misc.js') }}"></script>
   <script src="{{ asset('assets/js/settings.js') }}"></script>
   <script src="{{ asset('assets/js/todolist.js') }}"></script>
   <!-- endinject -->
   <!-- Custom js for this page -->
   <script src="{{ asset('assets/js/dashboard.js') }}"></script>
   @yield('cjs')
   <!-- End custom js for this page -->
</body>

</html>