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
  {{-- loader --}}
      <link rel="stylesheet" href="{{ asset('interior/fakeloader/src/fakeloader.css') }}">
  </head>

  <body>
    @include('dashboards.blocks.fakeload')
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          @include('dashboards.blocks.menu-z-status');
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
              @include('dashboards.blocks.a-search-user')
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Status / </span>Quản lý trạng thái</h4>
              <div class="row">
                <div class="nav-align-top mb-4">
                  <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                      <a href="{{ route('status_dashboard') }}" class="nav-link active">Trạng thái</a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('type_status_dashboard') }}" class="nav-link">Loại trạng thái</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div>
                      <!-- Basic with Icons -->
                      <div class="col-xxl">
                        <div>
                          <div class="card-body">
                            <form action="{{ route('add_status') }}" method="POST">
                              @csrf
                              <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tên trạng thái</label>
                                <div class="col-sm-3">
                                  <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bxl-codepen'></i></span>
                                    <input type="text" class="form-control" name="name_status"/>
                                  </div>
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Loại trạng thái</label>
                                <div class="col-sm-3">
                                  <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class='bx bx-cube-alt'></i></span>
                                    <select class="form-select" name="type_status">
                                      @foreach ($type as $types)
                                          <option value="{{$types->nametype}}">{{$types->nametype}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="col-sm-1">
                                  <button type="submit" class="btn btn-success">Thêm</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- Responsive Table -->
                      <div>
                        <div class="table-responsive text-nowrap">
                          <form action="" method="">
                            @csrf
                            <table class="table table-hover table-dark">
                              <thead>
                                <tr>
                                  <th style="color: rgb(255, 201, 53);font-size: 14px">STT</th>
                                  <th style="color: rgb(255, 201, 53);font-size: 14px">Mã trạng thái</th>
                                  <th style="color: rgb(255, 201, 53);font-size: 14px">Tên trạng thái</th>
                                  <th style="color: rgb(255, 201, 53);font-size: 14px">Loại trạng thái</th>
                                  <th style="color: rgb(255, 201, 53);font-size: 14px">Chức năng</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($status as $key => $statuses)
                                <tr>
                                  <th>{{$key + 1}}</th>
                                  <td style="color: gold">{{$statuses->id}}</td>
                                  <td>{{$statuses->name_status}}</td>
                                  <td>{{$statuses->type_status}}</td>
                                  <td>
                                    <a href="{{ route('edit_status_dashboard', ['id'=>$statuses->id]) }}" class="btn btn-primary btn-sm"><i class='bx bxs-edit'></i></a>
                                    <a onclick="return confirm('Bạn có chắc chắn xóa không?')"  href="{{ route('destroy_status', ['id'=>$statuses->id]) }}" class="btn btn-danger btn-sm"><i class='bx bx-trash-alt'></i></a>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </form>
                        </div>
                      </div>
                      {{-- <small class="text-muted float-end">Interior <span style="color: rgb(231, 171, 6)">CS</span></small> --}}
                      <!--/ Responsive Table -->
                    </div>
                  </div>
                </div>
              </div>
              <small class="text-muted float-end">Interior <span style="color: rgb(231, 171, 6)">CS</span></small>
              <div class="d-flex">
                {{ $status->links() }}
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session()->has('status_sc'))
      <script>
        swal({
              title: "{{session()->get('status_sc')}}",
              text: "Tạo thành công",
              icon: "success",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
    @if (session()->has('update_status_sc'))
    <script>
      swal({
            title: "{{session()->get('update_status_sc')}}",
            text: "Cập nhật thành công",
            icon: "success",
            button: "OK",
            timer: 20000,
          });
    </script>
    @endif
    @if (session()->has('status_ds'))
    <script>
      swal({
            title: "{{session()->get('status_ds')}}",
            text: "Xóa thành công",
            icon: "success",
            button: "OK",
            timer: 20000,
          });
    </script>
    @endif
    @include('dashboards.blocks.foo')
  </body>
</html>
