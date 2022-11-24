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
    <title>Interior.CS</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/assets/img/favicon/logo-interior.png') }}" />
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
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          @include('dashboards.blocks.menu-z-history');
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
          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">Lịch sử</h4>
            <div class="accordion mt-3 mb-2" id="accordionExample">
              <div class="card accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                    <i class='bx bxs-component'></i> &nbsp;&nbsp; Chức năng
                  </button>
                </h2>
                <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body d-flex">
                    <a href="{{route('destroy_all_history')}}" class="btn btn-warning">Làm mới</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Responsive Table -->
            <div class="card">
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">STT</th>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">Người sử dụng</th>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">Nội dung</th>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">Phân loại</th>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">Thời gian tạo</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($his as $key => $hi)
                    <tr>
                        <td>{{$key +1}}</td>
                        <td>{{$hi->user_his}}</td>
                        <td>{{$hi->description_his}}</td>
                        <td>{{$hi->name_his}}</td>
                        <td>{{Carbon\Carbon::parse($hi->created_at)->format('d-m-Y H:i:s')}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="d-flex mt-3">
              {{$his->links()}}
            </div>
            <small class="text-muted float-end">Interior <span style="color: rgb(231, 171, 6)">CS</span></small>
            <!--/ Responsive Table -->
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session()->has('history_ds_all'))
      <script>
        swal({
              title: "{{session()->get('history_ds_all')}}",
              icon: "warning",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
  </body>
</html>