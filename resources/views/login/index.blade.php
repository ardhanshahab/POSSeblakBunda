<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Login Page</title>
   <!-- plugins:css -->
   <link rel="stylesheet" href="{{ asset('../../assets/vendors/mdi/css/materialdesignicons.min.css') }}">
   <link rel="stylesheet" href="{{ asset('../../assets/vendors/css/vendor.bundle.base.css') }}">
   <!-- endinject -->
   <!-- Plugin css for this page -->
   <!-- End plugin css for this page -->
   <!-- inject:css -->
   <!-- endinject -->
   <!-- Layout styles -->
   <link rel="stylesheet" href="{{ asset('../../assets/css/style.css') }}">
   <!-- End layout styles -->
   <link rel="shortcut icon" href="{{ asset('../../assets/images/favicon.png') }}" />
</head>

<body>
   <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
         <div class="row w-100 m-0">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
               <div class="card col-lg-4 mx-auto">
                  <div class="card-body px-5 py-5">
                     @if (session('danger'))
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session ('danger') }}
                     </div>
                     @endif
                     <h3 class="card-title text-left mb-3">Login</h3>
                     <form action="/login" method="post">
                        @csrf
                        <div class="form-group">
                           <label for="username">Username </label>
                           <input type="text" class="form-control p_input @error('username') is-invalid @enderror" id="username" name="username" autocomplete="off">
                           @error('username')
                           <span style="color: rgb(255, 71, 71);">{{ $message }}</span>
                           @enderror
                        </div>
                        <div class="form-group">
                           <label for="password">Password </label>
                           <input type="password" class="form-control p_input @error('password') is-invalid @enderror" id="password" name="password">
                           @error('password')
                           <span style="color: rgb(255, 71, 71);">{{ $message }}</span>
                           @enderror
                        </div>
                        <div class="form-group">
                           <input type="checkbox" id="toggle-password"> <span style="font-size: 14px;">Show Password</span>
                        </div>
                        <div class="text-center mt-5">
                           <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <!-- content-wrapper ends -->
         </div>
         <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
   </div>
   <!-- container-scroller -->
   <!-- plugins:js -->
   <script src="{{ asset('../../assets/vendors/js/vendor.bundle.base.js') }}"></script>
   <!-- endinject -->
   <!-- Plugin js for this page -->
   <!-- End plugin js for this page -->
   <!-- inject:js -->
   <script src="{{ asset('../../assets/js/off-canvas.js') }}"></script>
   <script src="{{ asset('../../assets/js/hoverable-collapse.js') }}"></script>
   <script src="{{ asset('../../assets/js/misc.js') }}"></script>
   <script src="{{ asset('../../assets/js/settings.js') }}"></script>
   <script src="{{ asset('../../assets/js/todolist.js') }}"></script>

   {{-- custom function --}}
   <script>
      const password = document.getElementById('password');
      const togglePassword = document.getElementById('toggle-password');

      togglePassword.addEventListener("click", toggleClicked);

      function toggleClicked() {
         if (this.checked) {
         password.type = "text";
         } else {
         password.type = "password";
         }
      }
   </script>
   <!-- endinject -->
</body>

</html>