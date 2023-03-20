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
          @include('dashboards.blocks.menu-list-province');
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
            <div class="container flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-xl">
                  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">City / </span>Danh sách Thành phố</h4>
                  <div class="card mb-4">
                    <div class="card-body">
                      @can('admin')
                      <form action="{{ route('add_city') }}" method="POST">
                        @csrf
                        <div class="d-flex">
                          <div class="mb-3 me-1">
                            <label class="form-label">Thành phố</label>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text">
                                <i class="bx bx-user"></i>
                              </span>
                              <input type="text" class="form-control" name="name_city"/>
                            </div>
                          </div>
                          <div class="mb-3 me-1">
                            <label class="form-label">Tỉnh</label>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text">
                                <i class="bx bx-user"></i>
                              </span>
                              <select name="city_province" class="select form-select">
                                <option selected disabled> </option>
                                @foreach ($select_province as $slt_pro)
                                    <option value="{{$slt_pro->name_province}}">{{$slt_pro->name_province}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Giá tiền</label>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text">
                                <i class="bx bx-user"></i>
                              </span>
                              <input type="text" class="form-control" name="price"/>
                            </div>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-success">Thêm</button>
                      </form>
                      @endcan
                      <div class="table-responsive text-nowrap mt-4">
                        <table class="table table-hover table-dark">
                          <thead>
                            <tr>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">STT</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Mã thành phố</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Tên thành phố</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Tên tỉnh</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Giá tiền</th>
                              @can('admin')
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Chức năng</th>
                              @endcan
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($city as $key => $cty)
                              <tr>
                                <td scope="row">{{$key +1}}</td>
                                <td>{{$cty->id}}</td>
                                <td>{{$cty->name_city}}</td>
                                <td>{{$cty->city_province}}</td>
                                <td>{{$cty->price}}</td>
                                @can('admin')
                                <td>
                                  <a href="{{ route('edit_city_dashboard', ['id'=>$cty->id]) }}" class="btn btn-primary btn-sm"><i class='bx bxs-edit'></i></a>
                                  <a onclick="return confirm('Bạn có chắc chắn xóa không?')"  href="{{ route('destroy_city', ['id'=>$cty->id]) }}" class="btn btn-danger btn-sm"><i class='bx bx-trash-alt'></i></a>
                                </td>
                                @endcan
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <div class="d-flex mt-3">
                          {{$city->links()}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl">
                  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Province / </span>Danh sách Tỉnh lẻ</h4>
                  <div class="card mb-4">
                    <div class="card-body">
                      @can('admin')
                      <form action="{{ route('add_province') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label class="form-label">Tỉnh lẻ</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text">
                              <i class="bx bx-user"></i>
                            </span>
                            <input type="text" class="form-control" name="name_province"/>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-success">Thêm</button>
                      </form>
                      @endcan
                      <div class="table-responsive text-nowrap mt-4">
                        <table class="table table-hover table-dark">
                          <thead>
                            <tr>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">STT</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Mã tỉnh</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Tên tỉnh</th>
                              @can('admin')
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Chức năng</th>
                              @endcan
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($province as $key => $pro)
                            <tr>
                              <th scope="row">{{$key +1}}</th>
                              <td>{{$pro->id}}</td>
                              <td>{{$pro->name_province}}</td>
                              @can('admin')
                              <td>
                                <a href="{{ route('edit_province_dashboard', ['id'=>$pro->id]) }}" class="btn btn-primary btn-sm"><i class='bx bxs-edit'></i></a>
                                <a onclick="return confirm('Bạn có chắc chắn xóa không?')"  href="{{ route('destroy_province', ['id'=>$pro->id]) }}" class="btn btn-danger btn-sm"><i class='bx bx-trash-alt'></i></a>
                              </td>
                              @endcan
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <div class="d-flex mt-3">
                          {{$province->links()}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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
    @if (session()->has('province_sc'))
      <script>
        swal({
              title: "{{session()->get('province_sc')}}",
              text: "Tạo thành công",
              icon: "success",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
    @if (session()->has('update_province_sc'))
      <script>
        swal({
              title: "{{session()->get('update_province_sc')}}",
              text: "Cập nhật thành công",
              icon: "success",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
    @if (session()->has('province_ds'))
      <script>
        swal({
              title: "{{session()->get('province_ds')}}",
              icon: "success",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
    @if (session()->has('city_sc'))
      <script>
        swal({
              title: "{{session()->get('city_sc')}}",
              text: "Tạo thành công",
              icon: "success",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
    @if (session()->has('update_city_sc'))
      <script>
        swal({
              title: "{{session()->get('update_city_sc')}}",
              text: "Cập nhật thành công",
              icon: "success",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
    @if (session()->has('city_ds'))
      <script>
        swal({
              title: "{{session()->get('city_ds')}}",
              icon: "success",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
  </body>
</html>
