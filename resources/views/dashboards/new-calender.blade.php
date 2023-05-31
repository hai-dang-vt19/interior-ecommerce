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
    {{-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> --}}
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
            @php
                use Carbon\Carbon;
                $timeNow = Carbon::now('Asia/Ho_Chi_Minh');
                $day = $timeNow->day;
                $month = $timeNow->month;
                $year = $timeNow->year;

                                    if($month < 8){
                                        if($month != 2){
                                            if($month % 2 == 0){      //   tháng chẵn
                                                $l_dofm = '30';
                                            }else{                      //    tháng lẻ
                                                $l_dofm = '31';
                                            }
                                        }else{                          // tháng 2: nhuận - thường
                                            if($year % 4 == 0){
                                                $l_dofm = '29';
                                            }else{
                                                $l_dofm = '28';
                                            }
                                        }
                                    }else{
                                        if($month % 2 == 0){      //   tháng chẵn
                                            $l_dofm = '31';
                                        }else{                      //    tháng lẻ
                                            $l_dofm = '30';
                                        }
                                    }
            @endphp
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">Lịch làm việc Tháng {{ $timeNow->month }}/{{ $timeNow->year }}</h4>
              <!-- Bottom Offcanvas -->
              <div class="col-lg-3 col-md-6 mb-3 d-flex">
                <div class="mt-3">
                    <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel4">Nhân viên chọn ca làm việc
                              </h5>
                              <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                              ></button>
                            </div>
                            <form action="{{ route('post_calender') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="ms-5">
                                        @php
                                            for($pic_day = 1; $pic_day <= $l_dofm; $pic_day++){
                                                $cc[$pic_day] = $calender->where('c'.$pic_day,'!=',null)->count('c'.$pic_day);
                                                
                                                if($pic_day == 1){
                                                  if($day <= 7 ){
                                                    echo '<p class="text-success fw-bolder">Tuần 1</p><BR>';
                                                  }else {
                                                    echo '<p>Tuần 1</p><BR>';
                                                  }
                                                }
                                                if($pic_day == 8){ 
                                                  if($day >= 8 && $day <= 14 ){
                                                    echo '<p class="text-success fw-bolder">Tuần 2</p><BR>';
                                                  }else {
                                                    echo '<p>Tuần 2</p><BR>';
                                                  }
                                                }
                                                if($pic_day == 15){ 
                                                  if($day >= 15 && $day <= 21 ){
                                                    echo '<p class="text-success fw-bolder">Tuần 3</p><BR>';
                                                  }else {
                                                    echo '<p>Tuần 3</p><BR>';
                                                  }
                                                }
                                                if($pic_day == 22){ 
                                                  if($day >= 22 && $day <= 28 ){
                                                    echo '<p class="text-success fw-bolder">Tuần 4</p><BR>';
                                                  }else {
                                                    echo '<p>Tuần 4</p><BR>';
                                                  }
                                                }
                                                if($pic_day == 29){
                                                  if($day >= 29){
                                                    echo '<p class="text-success fw-bolder">Tuần lẻ</p><BR>';
                                                  }else {
                                                    echo '<p>Tuần lẻ</p><BR>';
                                                  }
                                                }
                                                
                                                if($cc[$pic_day] == 4){ // Điều kiện số lượng nv làm trong ngày
                                                  echo '<div class="btn btn-sm rounded-pill btn-outline-warning me-2"><i class="bx bxs-badge-check"></i></div>';
                                                }else{
                                                  echo '<select name="n'.$pic_day.'" class="btn rounded-pill btn-sm btn-outline-warning me-2">';
                                                  echo '<option selected disabled>Day '.$pic_day.'</option>';
                                                  echo '<option value="c1">Ca 1</option>';
                                                  echo '<option value="c2">Ca 2</option>';
                                                  echo '<option value="Fulltime">Fulltime</option>';
                                                  echo '<option value="">Nghỉ</option></select>';
                                                }
                                                if($pic_day % 7 == 0){
                                                    echo '<br><hr>';
                                                }
                                            }
                                        @endphp
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="d-flex mt-1 col-4 justify-content-end">
                                    <div class="form-check form-switch">
                                      <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" value="1" name="checked"/>
                                      <label class="form-check-label" for="flexSwitchCheckDefault">Đi làm ngày lễ</label>
                                    </div>
                                  </div> 
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Đóng
                                </button>
                                <button type="submit" class="btn btn-primary">Đăng ký</button>
                                </div>
                            </form>
                          </div>
                        </div>
                    </div>
                    <button
                          type="button"
                          class="btn btn-sm btn-outline-dark"
                          data-bs-toggle="modal"
                          data-bs-target="#largeModal"
                    >
                        Đăng ký lịch
                    </button>
                </div>
                @can('admin_manager')
                <div class="mt-3 ms-3">
                  <a href="{{ route('reset_calender') }}" onclick="return confirm('Bạn có chắc chắn làm mới lịch không?')" class="btn btn-sm btn-warning">Làm mới</a>
                </div>
                @endcan
              </div>
              <div class="card mb-3 d-flex">
                <div class="d-flex justify-content-center m-1">
                  <div class="me-5">
                    <span class="">Ngày: {{$timeNow->format('d-m-Y')}}</span>
                  </div>
                  <div class="me-5">
                    <span class="badge rounded-pill bg-warning" title="Fulltime">8&nbsp;-&nbsp;15h</span>
                  </div>
                  <div class="me-5">
                    <span class="badge rounded-pill bg-dark" title="C1">15&nbsp;-&nbsp;22h</span>
                  </div>
                  <div class="me-5">
                    <span class="badge rounded-pill bg-secondary" title="C2">8&nbsp;-&nbsp;22h</span>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover table-bordered">
                          <thead>
                            <tr>
                              <td class="text-center fw-bolder"><span>Tháng {{ $month }}/{{ $year }}</span></td>
                              {{-- <td class=""></td> --}}
                              @php
                                  for($t_tbl = 1; $t_tbl <= $l_dofm; $t_tbl++){
                                    if($t_tbl == 1){ echo '<td colspan="7" class="text-center fw-bolder table-success">Tuần 1</td>';}
                                    if($t_tbl == 8){ echo '<td colspan="7" class="text-center fw-bolder table-danger">Tuần 2</td>';}
                                    if($t_tbl == 15){ echo '<td colspan="7" class="text-center fw-bolder table-info">Tuần 3</td>';}
                                    if($t_tbl == 22){ echo '<td colspan="7" class="text-center fw-bolder table-warning">Tuần 4</td>';}
                                    if($t_tbl == 29){ 
                                      if($l_dofm == 30){
                                        echo '<td colspan="2" class="text-center fst-italic table-secondary fw-bolder">Tuần lẻ</td>';
                                        echo '<td></td>';
                                      }elseif($l_dofm = 31){
                                        echo '<td colspan="3" class="text-center fst-italic table-secondary fw-bolder">Tuần lẻ</td>';
                                        echo '<td></td>';
                                      }else{
                                        echo '<td class="text-center fst-italic table-secondary fw-bolder">Tuần lẻ</td>';
                                        echo '<td></td>';
                                      }
                                    }
                                  }
                              @endphp
                            </tr>
                            <tr>
                              <th class="text-primary text-center">Nhân viên</th>
                              @php
                                    for($day = 1; $day <= $l_dofm; $day++){
                                        if($day <= 7){
                                          echo '<th class="text-primary text-center text-decoration-underline table-success">'.$day.'</th>';
                                        }elseif($day > 7 && $day < 15){
                                          echo '<th class="text-primary text-center text-decoration-underline table-danger">'.$day.'</th>';
                                        }elseif($day > 14 && $day < 22){
                                          echo '<th class="text-primary text-center text-decoration-underline table-info">'.$day.'</th>';
                                        }elseif($day > 21 && $day < 29){
                                          echo '<th class="text-primary text-center text-decoration-underline table-warning">'.$day.'</th>';
                                        }else{
                                          echo '<th class="text-primary text-center text-decoration-underline table-secondary">'.$day.'</th>';
                                        }
                                    }
                              @endphp
                              <th class="text-primary text-center">Số giờ làm</th>
                            </tr>
                          </thead>
                          @if ($count == 0)
                            <tbody>
                              <tr class="text-center">
                                <td colspan="{{ $l_dofm+2 }}">Lịch trống</td>
                              </tr>
                            </tbody>
                          @else
                            <tbody>
                                  @php
                                    foreach ($calender as $cder) {
                                      echo '<tr>';
                                      echo '<td><span class="text-dark">'.$cder->user.'</span> _ '.$cder->id_user.'</td>';
                                      for($cale = 1; $cale <= $l_dofm; $cale++){
                                        echo '<td>';
                                          $cders = 'c'.$cale;
                                          if($cder->$cders == 'c1'){
                                            echo '<span class="badge rounded-pill bg-warning">'.$cder->$cders.'</span>';
                                          }elseif($cder->$cders == 'c2'){
                                            echo '<span class="badge rounded-pill bg-dark">'.$cder->$cders.'</span>';
                                          }elseif($cder->$cders == 'Fulltime'){
                                            echo '<span class="badge rounded-pill bg-secondary">'.$cder->$cders.'</span>';
                                          }else{
                                            echo '<span></span>';
                                          }
                                        echo '</td>';
                                      }
                                      echo '<td>'.$cder->timework.'</td>';
                                      echo '</tr>';
                                    }
                                  @endphp
                            </tbody>
                          @endif
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
    {{-- <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script> --}}
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session()->has('calender_sc'))
    <script>
      swal({
            title: "{{session()->get('calender_sc')}}",
            text: "Đăng ký thành công",
            icon: "success",
            button: "OK",
            timer: 20000,
          });
    </script>
    @endif
    @if (session()->has('calender_er'))
    <script>
      swal({
            title: "{{session()->get('calender_er')}}",
            icon: "warning",
            button: "OK",
            timer: 20000,
          });
    </script>
    @endif
    @if (session()->has('calender_rs'))
    <script>
      swal({
            title: "{{session()->get('calender_rs')}}",
            icon: "success",
            button: "OK",
            timer: 20000,
          });
    </script>
    @endif
    @if (session()->has('check_max_time'))
    <script>
      swal({
            title: "{{session()->get('check_max_time')}}",
            icon: "error",
            button: "OK",
            timer: 20000,
          });
    </script>
    @endif
  </body>
</html>
