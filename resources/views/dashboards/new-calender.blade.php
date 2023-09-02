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
    @include('dashboards.blocks.head')
  </head>

    <body>
      @include('dashboards.blocks.fakeload')
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
                use App\Models\Hosts;
                $timeNow = Carbon::now('Asia/Ho_Chi_Minh');
                Carbon::setLocale('vi');
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
                $hosts = Hosts::where('active','y')->get();
                $query = @unserialize(file_get_contents('http://ip-api.com/php/?fields=status,as'));
                // dd($query['as']);
                foreach ($hosts as $hts) {
                    $host = $hts->host;
                    if($query && $query['status'] == 'success')
                    {
                        $url = $host.'qrcode/'.$query['as'];
                    }
                }
                $url = 12;
            @endphp
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">Lịch làm việc Tháng {{ $timeNow->month }}/{{ $timeNow->year }}</h4>
              <!-- Bottom Offcanvas -->
              {{-- Modal đăng ký lịch --}}
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
              <div class="row mb-2">
                <div class="col-sm-1 mb-1">
                  <button
                    type="button"
                    class="btn btn-sm btn-outline-dark"
                    data-bs-toggle="modal"
                    data-bs-target="#largeModal"
                  >
                      Đăng ký
                  </button>
                </div>
                @can('admin_manager')
                <div class="col-sm-1 mb-1">
                  <a href="{{ route('reset_calender') }}" onclick="return confirm('Bạn có chắc chắn làm mới lịch không?')" class="btn btn-sm btn-warning w-100">Làm mới</a>
                </div>

                <div class="col-sm-1 mb-1">
                  <button class="btn btn-sm btn-dark w-100"  data-bs-toggle="modal" data-bs-target="#m_qr_calender">
                      Scan <i class='bx bx-qr-scan'></i>
                  </button>
                </div>
                @endcan
                <div class="col-sm-2 mb-1">
                  <button
                      type="button"
                      class="btn btn-sm btn-dark w-100"
                      data-bs-toggle="modal"
                      data-bs-target="#largeModalTimekeeping"
                  >
                    Ds chấm công
                  </button>
                </div>
                @can('admin_manager')
                <!-- Modal -->
                <div class="modal fade" id="m_qr_calender" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                            <div class="modal-content mt-3">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Login end Scan QRCODE</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-1 mb-3">
                                    <div class="text-center">
                                        {{ QrCode::size(300)->eyeColor(0, 0, 101, 255, 101, 150, 29)->style('round')->gradient(255,171,0,200,101,150,'inverse_diagonal')->generate($url); }}
                                    </div>                 
                                </div>
                            </div>
                    </div>
                </div>
                @endcan
                {{-- Modal TImekeeping --}}
                <div class="modal fade" id="largeModalTimekeeping" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="table-responsive text-nowrap">
                        <table class="table table-hover table-dark table-xs">
                          <thead>
                            <tr>
                              <th class="text-center">STT</th>
                              <th>Họ tên</th>
                              @can('admin_manager')
                                <th>IP - Address</th>
                                <th>Nhà mạng</th>
                              @endcan
                              <th>Check-in</th>
                              <th>Check-out</th>
                              @can('admin_manager')
                                <th><a href="{{ route('reset_timekeeping') }}" class="btn btn-sm btn-warning" title="RESET"><i class='bx bx-refresh'></i></a></th>
                              @endcan
                            </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                            @foreach ($timekeeping as $key => $item_tmk)
                                <tr>
                                  <td class="text-center">{{ $key+1 }}</td>
                                  <td>
                                    {{ $item_tmk->user }} <br> {{ $item_tmk->id_user }}
                                  </td>
                                  @can('admin_manager')
                                    <td><span class="text-success">{{ $item_tmk->ip }}</span> <br> {{ $item_tmk->address }}</td>
                                    <td>{{ $item_tmk->telecom_operator }}</td>                                      
                                  @endcan
                                  <td>
                                    @php
                                      $fm = Carbon::parse($item_tmk->check_in)->toDateTimeString();
                                    @endphp
                                    <span>
                                      {{ Carbon::parse($item_tmk->check_in)->format('H\\hi') }} <br> <span class="text-warning" style="font-size: 0.8vw">Đã được {{ $timeNow->diffForHumans($fm) }} khi check-in</span>
                                    </span>
                                  </td>
                                  <td>
                                    @if (!empty($item_tmk->check_out))
                                      @php
                                        $fm = Carbon::parse($item_tmk->check_out)->toDateTimeString();
                                      @endphp
                                      <span>
                                        {{ Carbon::parse($item_tmk->check_out)->format('H\\hi') }} <br> <span class="text-warning" style="font-size: 0.8vw">Đã được {{ $timeNow->diffForHumans($fm) }} khi check-out</span>
                                      </span>
                                    @else
                                      ---
                                    @endif
                                  </td>
                                  @can('admin_manager')
                                  <td>
                                    @empty($item_tmk->late)
                                      @if (!empty($item_tmk->check_out))
                                        <a href="{{ route('submit_timekeeping', ['id_user'=>$item_tmk->id_user, 'totalTime'=>$item_tmk->timework]) }}"
                                          class="btn btn-success btn-xs btn-icon rounded-pill w-100 text-center"  
                                          title="Click để cập nhật giờ làm khi check-in muộn đã xin phép"
                                        >
                                          <i class='bx bx-check'></i>
                                        </a>
                                      @endif
                                    @endempty
                                  </td>
                                  @endcan
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card mb-3 d-flex">
                <div class="row p-2">
                  <div class="col-sm-9">
                    <span class="">Ngày: {{$timeNow->format('d-m-Y')}}</span>
                  </div>
                  <div class="col-sm-1">
                    <span class="badge rounded-pill bg-warning" title="Fulltime">8&nbsp;-&nbsp;15h</span>
                  </div>
                  <div class="col-sm-1">
                    <span class="badge rounded-pill bg-dark" title="C1">15&nbsp;-&nbsp;22h</span>
                  </div>
                  <div class="col-sm-1">
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
              <small class="text-muted float-end">Interior <span style="color: rgb(231, 171, 6)">CS</span></small>
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
            timer: 2000,
          });
    </script>
    @endif
    @if (session()->has('check_max_time'))
    <script>
      swal({
            title: "{{session()->get('check_max_time')}}",
            icon: "error",
            button: "OK",
            timer: 2000,
          });
    </script>
    @endif
    @include('dashboards.blocks.foo')
  </body>
</html>
