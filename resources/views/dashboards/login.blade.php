<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>Interior.CS</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/assets/img/favicon/logo-interior.png') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('dashboard/') }}/assets/vendor/fonts/boxicons.css" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/demo.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('dashboard/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('dashboard/assets/js/config.js') }}"></script>
    {{-- loader --}}
    <link rel="stylesheet" href="{{ asset('interior/fakeloader/src/fakeloader.css') }}">
  </head>

  <body>
    <div id="fakeloader-overlay" class="visible incoming">
      <div class="loader-wrapper-outer">
          <div class="loader-wrapper-inner">
              <div class="loader">
                  <div class="spinner-border spinner-border-lg text-warning" role="status">
                      <span class="visually-hidden">Loading...</span>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <!-- Content -->
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="d-flex justify-content-center mb-3">
                <div>
                  <img class="mt-4 ms-2 mb-3" src="{{ asset('interior\img\core-img\logo.png') }}" width="150px" height="61px" alt="Interior CS">
                </div>
              </div>
              <!-- /Logo -->
              {{-- <p class="mb-4">Please sign-in to your account and start the adventure</p> --}}
              <form class="mb-3" action="{{route('login_interior')}}" method="POST">
                @csrf
                <div class="mb-3">
                  <label class="form-label">Email @error('email') <span class="text-danger">*</span> @enderror</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" 
                    name="email" 
                    placeholder="@error('email') {{ $message  }} @enderror" value="{{ old('email') }}" required
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label">Password @error('password') <span class="text-danger">*</span> @enderror</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                      name="password" 
                      placeholder="@error('password') {{ $message  }} @enderror" required
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="form-check mt-3 mb-3">
                  <input class="form-check-input" type="checkbox" id="defaultCheck1" value="1" name="remember_token"/>
                  <label class="form-check-label" for="defaultCheck1"> Duy trì đăng nhập </label>
                </div>
                <div class="mb-3">
                  <button class="btn btn-warning d-grid w-100" type="submit">Đăng nhâp</button>
                </div>
              </form>

              <p class="text-center">
                <span>Bạn chưa có tài khoản?</span>
                <a href="{{route('register')}}">
                  <span>Đăng ký tại đây</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>
    <!-- / Content -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('dashboard/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <!-- Main JS -->
    <script src="{{ asset('dashboard/assets/js/main.js') }}"></script>
    <!-- Page JS -->
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session()->has('register-sc'))
      <script>
        swal({
              title: "{{session()->get('register-sc')}}",
              icon: "success",
              button: "OK",
              timer: 2000,
            });
      </script>
    @endif
    @if (session()->has('login-er'))
      <script>
        swal({
              title: "{{session()->get('login-er')}}",
              icon: "error",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
    @if (session()->has('not_user'))
      <script>
        swal({
              title: "{{session()->get('not_user')}}",
              icon: "success",
              button: "OK",
              timer: 3000,
            });
      </script>
    @endif
    {{-- fake  load--}}
    <script src="{{ asset('interior/fakeloader/jquery-3.3.1.min.js') }}" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
    <script src="{{ asset('interior/fakeloader/dist/fakeloader.min.js') }}"></script>
    <script>

            $(document).ready(
                function() {
                    window.FakeLoader.init( { auto_hide: true } );
                }
            );

    </script>
  </body>
</html>
