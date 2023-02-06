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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User / </span>Danh sách người dùng</h4>
              <div class="accordion mt-3 mb-2" id="accordionExample">
                <div class="card accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                      <i class='bx bxs-component'></i> &nbsp;&nbsp; Chức năng xem thông tin
                    </button>
                  </h2>
                  <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body d-flex">
                      <a href="{{ route('list_user_dashboard') }}" class="nav-link me-1">All</a>
                      <a href="{{ route('user_interior') }}" class="nav-link me-1">Danh sách nhân viên</a>
                      <a href="{{ route('user_name_roles_us') }}" class="nav-link me-1">Danh sách khách hàng</a>
                      <a href="{{ route('user_city') }}" class="nav-link me-1">DS-KH theo Thành Phố</a>
                      <a href="{{ route('user_province') }}" class="nav-link me-1">DS-KH theo Tỉnh</a>
                      <a href="{{ route('user_hoatdong') }}" class="nav-link me-1">DS-KH Hoạt động</a>
                      <a href="{{ route('user_ngat') }}" class="nav-link me-1">DS-KH ngắt kết nối</a>
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
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Mã người dùng</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Email</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Tên người dùng</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Quyền hạn</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Giới tính</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Ngày sinh</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Địa chỉ</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Trạng thái</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Số điện thoại</th>
                        {{-- <th style="color: rgb(231, 171, 6);font-size: 14px">Trạng thái</th> --}}
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Chức năng</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($user as $key => $us)
                      <tr>
                        <td scope="row">{{$key +1}}</td>
                        <td style="color: #696CFF;">{{$us->user_id}}</td>
                        <td>{{$us->email}}</td>
                        <td>{{$us->name}}</td>
                        <td>
                          @if ($us->name_roles == 'admin')
                            <span class="badge rounded-pill bg-warning me-1" style="width: 93px; font-size: 12px">{{$us->name_roles}}</span>
                          @elseif($us->name_roles == 'manager')
                            <span class="badge rounded-pill bg-dark me-1" style="width: 93px; font-size: 11px">{{$us->name_roles}}</span>
                          @elseif($us->name_roles == 'staff')
                            <span class="badge rounded-pill bg-label-dark me-1" style="width: 93px; font-size: 11px">{{$us->name_roles}}</span>
                          @else
                            <span class="badge rounded-pill bg-info me-1" style="width: 93px; font-size: 11px">{{$us->name_roles}}</span>
                          @endif
                        </td>
                        <td>{{$us->sex_user}}</td>
                        <td>{{Carbon\Carbon::parse($us->date_user)->format('d-m-Y')}}</td>
                        <td>{{$us->district}}, {{$us->city}}, {{$us->province}}</td>
                        <td>
                          @if ($us->name_status == 'Hoạt động')
                            <span class="badge rounded bg-success me-1" style="width: 93px; font-size: 12px">{{$us->name_status}}</span>
                          @else
                            <span class="badge rounded bg-danger me-1" style="width: 93px; font-size: 12px">{{$us->name_status}}</span>
                          @endif
                          @if (Auth::user()->name_roles == 'admin')
                            <a href="{{ route('reset_pw', ['id'=>$us->id]) }}"><i class="bx bx-key"></i></a>
                          @endif
                        </td>
                        <td>{{$us->phone}}</td>
                        {{-- <td>Table cell</td> --}}
                        <td>
                          <a href="{{ route('edit_list_user', ['id'=>$us->id]) }}" class="btn btn-primary"><i class='bx bxs-edit'></i></a>
                          <a onclick="return confirm('Bạn có chắc chắn xóa không?')"  href="{{ route('destroy_user', ['id'=>$us->id]) }}" class="btn btn-danger"><i class='bx bx-trash-alt'></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="d-flex mt-3">
                {{$user->links()}}
              </div>
              <small class="text-muted float-end">Interior <span style="color: rgb(231, 171, 6)">CS</span></small>
              <!--/ Responsive Table -->
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
    @if (session()->has('user_ds'))
    <script>
      swal({
            title: "{{session()->get('user_ds')}}",
            icon: "success",
            button: "OK",
            timer: 20000,
          });
    </script>
    @endif
    @if (session()->has('reset_pw'))
    <script>
      swal({
            title: "{{session()->get('reset_pw')}}",
            icon: "success",
            button: "OK",
            timer: 20000,
          });
    </script>
    @endif
  </body>
</html>
