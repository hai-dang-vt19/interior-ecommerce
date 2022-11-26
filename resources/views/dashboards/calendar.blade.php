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
          @include('dashboards.blocks.menu-profile-user');
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
              <h4 class="fw-bold py-3 mb-4">Lịch làm việc</h4>
              <!-- Bottom Offcanvas -->
              <div class="col-lg-3 col-md-6 mb-3 d-flex">
                <div class="mt-3">
                  <button class="btn btn-sm btn-outline-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
                    Đăng ký lịch
                  </button>
                  <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                    <div class="offcanvas-header">
                      <h5 id="offcanvasBottomLabel" class="offcanvas-title">Nhân viên chọn ca làm việc</h5>
                      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                      <form action="{{ route('add_calender') }}" method="post">
                        @csrf
                        <div class="mb-3 d-flex justify-content-center">
                          <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
                          <select name="t2" class="btn rounded-pill btn-outline-warning ms-2">
                            <option selected disabled>Thứ 2</option>
                            <option value="c1">C1</option>
                            <option value="c2">C2</option>
                            <option value="Fulltime">Fulltime</option>
                            <option value="">Nghỉ</option>
                          </select>
                          <select name="t3" class="btn rounded-pill btn-outline-warning ms-2">
                            <option selected disabled>Thứ 3</option>
                            <option value="c1">C1</option>
                            <option value="c2">C2</option>
                            <option value="Fulltime">Fulltime</option>
                            <option value="">Nghỉ</option>
                          </select>
                          <select name="t4" class="btn rounded-pill btn-outline-warning ms-2">
                            <option selected disabled>Thứ 4</option>
                            <option value="c1">C1</option>
                            <option value="c2">C2</option>
                            <option value="Fulltime">Fulltime</option>
                            <option value="">Nghỉ</option>
                          </select>
                          <select name="t5" class="btn rounded-pill btn-outline-warning ms-2">
                            <option selected disabled>Thứ 5</option>
                            <option value="c1">C1</option>
                            <option value="c2">C2</option>
                            <option value="Fulltime">Fulltime</option>
                            <option value="">Nghỉ</option>
                          </select>
                          <select name="t6" class="btn rounded-pill btn-outline-warning ms-2">
                            <option selected disabled>Thứ 6</option>
                            <option value="c1">C1</option>
                            <option value="c2">C2</option>
                            <option value="Fulltime">Fulltime</option>
                            <option value="">Nghỉ</option>
                          </select>
                          <select name="t7" class="btn rounded-pill btn-outline-warning ms-2">
                            <option selected disabled>Thứ 7</option>
                            <option value="c1">C1</option>
                            <option value="c2">C2</option>
                            <option value="Fulltime">Fulltime</option>
                            <option value="">Nghỉ</option>
                          </select>
                          <select name="cn" class="btn rounded-pill btn-outline-warning ms-2">
                            <option selected disabled>Chủ nhật</option>
                            <option value="c1">C1</option>
                            <option value="c2">C2</option>
                            <option value="Fulltime">Fulltime</option>
                            <option value="">Nghỉ</option>
                          </select>
                        </div>
                        <div class="float-end">
                          <button type="submit" class="btn btn-success me-2 ms-2">Đăng ký</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="mt-3 ms-3">
                  <a href="{{ route('reset_calendar') }}" onclick="return confirm('Bạn có chắc chắn làm mới lịch không?')" class="btn btn-sm btn-warning">Làm mới</a>
                </div>
              </div>
              <div class="card mb-3">
                <div class="d-flex justify-content-end m-1">
                  <div class="me-5">
                    <span class="badge rounded-pill bg-warning" title="C1">7&nbsp;-&nbsp;15h</span>
                  </div>
                  <div class="me-5">
                    <span class="badge rounded-pill bg-dark" title="C1">15&nbsp;-&nbsp;22h</span>
                  </div>
                  <div class="me-5">
                    <span class="badge rounded-pill bg-secondary" title="C1">7&nbsp;-&nbsp;22h</span>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover table-bordered">
                          <thead>
                            <tr>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Lịch</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Thứ 2</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Thứ 3</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Thứ 4</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Thứ 5</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Thứ 6</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Thứ 7</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Chủ nhật</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($calendar as $cal)
                            <tr>
                              <td>{{$cal->user}}</td>
                              <td>
                                @if ($cal->t2 == 'c1')
                                  <span class="badge rounded-pill bg-warning">{{$cal->t2}}</span>
                                @elseif($cal->t2 =='c2')
                                  <span class="badge rounded-pill bg-dark">{{$cal->t2}}</span>
                                @else
                                  <span class="badge rounded-pill bg-secondary">{{$cal->t2}}</span>
                                @endif
                              </td>
                              <td>
                                @if ($cal->t3 == 'c1')
                                <span class="badge rounded-pill bg-warning">{{$cal->t3}}</span>
                                @elseif($cal->t3 =='c2')
                                  <span class="badge rounded-pill bg-dark">{{$cal->t3}}</span>
                                @else
                                  <span class="badge rounded-pill bg-secondary">{{$cal->t3}}</span>
                                @endif  
                              </td>
                              <td>
                                @if ($cal->t4 == 'c1')
                                <span class="badge rounded-pill bg-warning">{{$cal->t4}}</span>
                                @elseif($cal->t4 =='c2')
                                  <span class="badge rounded-pill bg-dark">{{$cal->t4}}</span>
                                @else
                                  <span class="badge rounded-pill bg-secondary">{{$cal->t4}}</span>
                                @endif  
                              </td>
                              <td>
                                @if ($cal->t5 == 'c1')
                                <span class="badge rounded-pill bg-warning">{{$cal->t5}}</span>
                                @elseif($cal->t5 =='c2')
                                  <span class="badge rounded-pill bg-dark">{{$cal->t5}}</span>
                                @else
                                  <span class="badge rounded-pill bg-secondary">{{$cal->t5}}</span>
                                @endif  
                              </td>
                              <td>
                                @if ($cal->t6 == 'c1')
                                  <span class="badge rounded-pill bg-warning">{{$cal->t6}}</span>
                                @elseif($cal->t6 =='c2')
                                  <span class="badge rounded-pill bg-dark">{{$cal->t6}}</span>
                                @else
                                  <span class="badge rounded-pill bg-secondary">{{$cal->t6}}</span>
                                @endif  
                              </td>
                              <td>
                                @if ($cal->t7 == 'c1')
                                  <span class="badge rounded-pill bg-warning">{{$cal->t7}}</span>
                                @elseif($cal->t7 =='c2')
                                  <span class="badge rounded-pill bg-dark">{{$cal->t7}}</span>
                                @else
                                  <span class="badge rounded-pill bg-secondary">{{$cal->t7}}</span>
                                @endif  
                              </td>
                              <td>
                                @if ($cal->cn == 'c1')
                                  <span class="badge rounded-pill bg-warning">{{$cal->cn}}</span>
                                @elseif($cal->cn =='c2')
                                  <span class="badge rounded-pill bg-dark">{{$cal->cn}}</span>
                                @else
                                  <span class="badge rounded-pill bg-secondary">{{$cal->cn}}</span>
                                @endif  
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
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
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session()->has('calendar_sc'))
    <script>
      swal({
            title: "{{session()->get('calendar_sc')}}",
            text: "Đăng ký thành công",
            icon: "success",
            button: "OK",
            timer: 20000,
          });
    </script>
    @endif
    @if (session()->has('calendar_er'))
    <script>
      swal({
            title: "{{session()->get('calendar_er')}}",
            icon: "warning",
            button: "OK",
            timer: 20000,
          });
    </script>
    @endif
    @if (session()->has('calendar_rs'))
    <script>
      swal({
            title: "{{session()->get('calendar_rs')}}",
            icon: "success",
            button: "OK",
            timer: 20000,
          });
    </script>
    @endif
  </body>
</html>
