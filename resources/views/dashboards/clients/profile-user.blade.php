<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>Tables - Basic Tables | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/assets/img/favicon/favicon.ico') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/fonts/boxicons.css') }}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/demo.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <!-- Page CSS -->
    <!-- Helpers -->
    <script src="{{ asset('dashboard/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('dashboard/assets/js/config.js') }}"></script>
    {{-- flat picker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          @include('dashboards.blocks.menu-list-user');
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..."/>
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                @include('dashboards.blocks.dropdown-user')
                <!--/ User -->
              </ul>
            </div>
          </nav>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">Account</h4>
              <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                <div class="card-body">
                  <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="{{ asset('dashboard/assets/img/avatars/1.png') }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar"
                    />
                    <div class="button-wrapper">
                      <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg"/>
                      </label>
                      <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                      </button>
                      <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                    </div>
                  </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                  <form action="{{ route('update_profile_user', ['id'=>Auth::user()->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="mb-3 col-md-6">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="text" name="email" value="{{Auth::user()->email}}"/>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label">Tên người dùng</label>
                        <input class="form-control" type="text" name="name" value="{{Auth::user()->name}}"/>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label">Ngày sinh</label>
                        <input class="form-control" type="text" name="date_user" id="datepiker" value="{{Auth::user()->date_user}}"/>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label">Giới tính</label>
                        <select class="select form-select" name="sex_user">
                            <option style="color: rgb(164, 164, 164)" selected value="{{Auth::user()->sex_user}}">{{Auth::user()->sex_user}}</option>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label">Phường / xã</label>
                        <input class="form-control" type="text" name="district" value="{{Auth::user()->district}}"/>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label">Phân quyền</label>
                        <select class="select form-select" name="name_roles">
                            <option style="color: rgb(164, 164, 164)" selected value="{{Auth::user()->name_roles}}">{{Auth::user()->name_roles}}</option>
                            @foreach ($rol as $ro)
                                <option value="{{$ro->name_roles}}">{{$ro->name_roles}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label">Thành phố</label>
                        <select class="select form-select" name="city">
                            <option style="color: rgb(164, 164, 164)" selected value="{{Auth::user()->city}}">{{Auth::user()->city}}</option>
                            @foreach ($cty as $ct)
                                <option value="{{$ct->name_city}}">{{$ct->name_city}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label">Số điện thoại</label>
                        <input class="form-control" type="text" name="phone" value="{{Auth::user()->phone}}"/>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label">Tỉnh</label>
                        <select class="select form-select" name="province">
                            <option style="color: rgb(164, 164, 164)" selected value="{{Auth::user()->province}}">{{Auth::user()->province}}</option>
                            @foreach ($pro as $pr)
                                <option value="{{$pr->name_province}}">{{$pr->name_province}}</option>
                            @endforeach
                        </select>
                      </div>
                    <div class="mt-2">
                      <button type="submit" class="btn btn-primary me-2">Cập nhật</button>
                    </div>
                  </form>
                </div>
                <!-- /Account -->
              </div>
            </div>
            <!-- / Content -->
            <!-- Footer -->
            @include('dashboards.blocks.footer')
            <!-- / Footer -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <!-- Core JS -->
    <!-- build:js dashboard/assets/vendor/js/core.js -->
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
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session()->has('update_user_sc'))
    <script>
      swal({
            title: "{{session()->get('update_user_sc')}}",
            text: "Cập nhật thành công",
            icon: "success",
            button: "OK",
            timer: 20000,
          });
    </script>
    @endif
    <script>
        flatpickr("#datepiker", {
          // dateFormat:'d-m-Y',
          defaultDate:'today',
          allowInput: 'true' //cho phep go
          // locale: "vn"
        });
      </script>
  </body>
</html>
