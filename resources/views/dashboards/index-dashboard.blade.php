<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
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
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/fonts/boxicons.css') }}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/demo.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <!-- Page CSS -->
    <!-- Helpers -->
    <script src="{{ asset('dashboard/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('dashboard/assets/js/config.js') }}"></script>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Năm', 'ATM', 'STORE', 'COD'],
          <?php echo $charts_0;?>
          <?php echo $charts_1;?>
          <?php echo $charts_2;?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '', // tưi điền nếu muốn
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <script type="text/javascript">
      
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Pizza');
        data.addColumn('number', 'Populartiy');
        data.addRows([
          <?php echo $char_ck0;?>
          <?php echo $char_ck1;?>
          <?php echo $char_ck2;?>
        ]);

        var options = {
          title: 'Tổng tiền 3 năm gần nhất',
          sliceVisibilityThreshold: .2,
          'width':370,
          'height':280
          // 'backgroundColor': 'blue'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
// chart_div_top_product
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          @include('dashboards.blocks.menu-dashboard');
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
              <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Xin chào {{Auth::user()->name}}! 🎉</h5>
                          <p class="mb-5">
                            Hôm nay đã thu được <span class="fw-bold">{{ number_format($sum_bill) }} &#8363;</span>. Hãy kiểm tra những gì bạn làm được.
                          </p>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img src="{{ asset('dashboard/assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 order-1">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              {{-- <img src="{{ asset('dashboard/assets/img/icons/unicons/chart-success.png') }}" alt="Credit Card" class="rounded"
                              /> --}}
                              <i class='bx bx-bar-chart bx-md text-success' ></i>
                            </div>
                            <div class="dropdown">
                              <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
                            </div>
                          </div>
                          <span>Lợi nhuận</span>
                          @php
                            $strlen_te = strlen($total_expense); 
                              
                              if($total_expense > 0){
                                if($strlen_te == 8){//chục triệu
                                  $subtr_ex = Str::substr($total_expense, 0, 2);
                                  $total_expenses = number_format($subtr_ex).' M'; 
                                }elseif($strlen_te == 9){//trăm triệu
                                    $subtr_ex = Str::substr($total_expense, 0, 3);
                                    $total_expenses = number_format($subtr_ex).' M';
                                }elseif($strlen_te == 10){//tỷ
                                    $subtr_ex = Str::substr($total_expense, 0, 1);
                                    $total_expenses = number_format($subtr_ex).' B';
                                }else{
                                    $total_expenses= number_format($total_expense);
                                }
                              }else {
                                if($strlen_te == 9){//chục triệu
                                  $subtr_ex = Str::substr($total_expense, 0, 3);
                                  $total_expenses = number_format($subtr_ex).' M'; 
                                }elseif($strlen_te == 10){//trăm triệu
                                    $subtr_ex = Str::substr($total_expense, 0, 4);
                                    $total_expenses = number_format($subtr_ex).' M';
                                }elseif($strlen_te == 11){//tỷ
                                    $subtr_ex = Str::substr($total_expense, 0, 2);
                                    $total_expenses = number_format($subtr_ex).' B';
                                }else{
                                    $total_expenses= number_format($total_expense);
                                }
                              }
                          @endphp
                          @if ($total_expense > 0)
                            <h3 class="card-title text-nowrap mb-1"> {{$total_expenses}}</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>{{number_format($total_expense)}} &#8363;</small>
                          @elseif($total_expense < 0)
                            <h3 class="card-title text-nowrap mb-1"> {{$total_expenses}}</h3>
                            <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i>{{number_format($total_expense)}} &#8363;</small>
                          @else
                            <h3 class="card-title text-nowrap mb-1"> {{$total_expenses}}</h3>
                            <small class="text-decoration fw-semibold"><i class='bx bxs-analyse bx-spin'></i>{{number_format($total_expense)}} &#8363;</small>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              {{-- <img src="{{ asset('dashboard/assets/img/icons/unicons/wallet-info.png') }}" alt="Credit Card" class="rounded" --}}
                              {{-- /> --}}
                              <i class='bx bx-car bx-md text-warning'></i>
                            </div>
                            <div class="dropdown">
                              <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
                            </div>
                          </div>
                          <span>COD</span>
                          @php
                              $strlen_sbc = strlen($sum_bill_cod); 
                              if($strlen_sbc == 8){//chục triệu
                                  $subtr_c = Str::substr($sum_bill_cod, 0, 2);
                                  $sum_bill_cod_ = number_format($subtr_c).' M'; 
                              }elseif($strlen_sbc == 9){//trăm triệu
                                  $subtr_c = Str::substr($sum_bill_cod, 0, 3);
                                  $sum_bill_cod_ = number_format($subtr_c).' M';
                              }elseif($strlen_sbc == 10){//tỷ
                                  $subtr_c = Str::substr($sum_bill_cod, 0, 1);
                                  $sum_bill_cod_ = number_format($subtr_c).' B';
                              }else{
                                  $sum_bill_cod_= number_format($sum_bill_cod);
                              }
                          @endphp
                          @if ($rate_sbc > 0)
                            <h3 class="card-title text-nowrap mb-1"> {{ $sum_bill_cod_ }}</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +{{ number_format($rate_sbc) }} &#8363;</small>
                          @elseif($rate_sbc < 0)
                            <h3 class="card-title text-nowrap mb-1"> {{ $sum_bill_cod_ }}</h3>
                            <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> {{ number_format($rate_sbc) }} &#8363;</small>
                          @else
                            <h3 class="card-title text-nowrap mb-1"> {{ $sum_bill_cod_ }}</h3>
                            <small class="text-decoration fw-semibold"><i class='bx bxs-analyse bx-spin' ></i> {{ number_format($rate_sbc) }} &#8363;</small>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Total Revenue -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card" style="height: 492px">
                    <div class="row row-bordered g-0">
                      <div class="col-md-8">
                        <h4 class="container mt-4 mb-5">Doanh thu 3 năm gần nhất</h4>
                        <div id="barchart_material" class="px-2 mt-5 mb-3" style="width: 800px; height: 310px;"></div>{{-- Biểu đồ --}}
                        {{-- <div id="totalRevenueChart" class="px-2"></div> --}}
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                  <div class="row">
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              {{-- <img src="{{ asset('dashboard/assets/img/icons/unicons/paypal.png') }}" alt="Credit Card" class="rounded" /> --}}
                              {{-- <i class='bx bx-qr'></i> --}}
                              <i class='bx bx-store bx-md text-danger' ></i>
                            </div>
                            <div class="dropdown">
                              <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">STORE</span>
                          @php
                              $strlen_sbs = strlen($sum_bill_store); 
                              if($strlen_sbs == 8){//chục triệu
                                  $subtr_s = Str::substr($sum_bill_store, 0, 2);
                                  $sum_bill_store_ = number_format($subtr_s).' M'; 
                              }elseif($strlen_sbs == 9){//trăm triệu
                                  $subtr_s = Str::substr($sum_bill_store, 0, 3);
                                  $sum_bill_store_ = number_format($subtr_s).' M';
                              }elseif($strlen_sbs == 10){//tỷ
                                  $subtr_s = Str::substr($sum_bill_store, 0, 1);
                                  $sum_bill_store_ = number_format($subtr_s).' B';
                              }else{
                                  $sum_bill_store_= number_format($sum_bill_store);
                              }
                          @endphp
                          @if ($rate_sbs > 0)
                            <h3 class="card-title text-nowrap mb-1"> {{ $sum_bill_store_ }}</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +{{ number_format($rate_sbs) }} &#8363;</small>
                          @elseif($rate_sbs < 0)
                            <h3 class="card-title text-nowrap mb-1"> {{ $sum_bill_store_ }}</h3>
                            <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> {{ number_format($rate_sbs) }} &#8363;</small>
                          @else
                            <h3 class="card-title text-nowrap mb-1"> {{ $sum_bill_store_ }}</h3>
                            <small class="text-decoration fw-semibold"><i class='bx bxs-analyse bx-spin' ></i>  {{ number_format($rate_sbs) }} &#8363;</small>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              {{-- <img src="{{ asset('dashboard/assets/img/icons/unicons/cc-primary.png') }}" alt="Credit Card" class="rounded" /> --}}
                              <i class='bx bx-credit-card bx-md text-primary' ></i>
                            </div>
                            <div class="dropdown">
                              <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">ATM</span>
                          @php
                              $strlen_sba = strlen($sum_bill_atm); 
                              if($strlen_sba == 8){//chục triệu
                                  $subtr_a = Str::substr($sum_bill_atm, 0, 2);
                                  $sum_bill_atm_ = number_format($subtr_a).' M'; 
                              }elseif($strlen_sba == 9){//trăm triệu
                                  $subtr_a = Str::substr($sum_bill_atm, 0, 3);
                                  $sum_bill_atm_ = number_format($subtr_a).' M';
                              }elseif($strlen_sba == 10){//tỷ
                                  $subtr_a = Str::substr($sum_bill_atm, 0, 1);
                                  $sum_bill_atm_ = number_format($subtr_a).' B';
                              }else{
                                  $sum_bill_atm_= number_format($sum_bill_atm);
                              }
                          @endphp
                          @if ($rate_sba > 0)
                            <h3 class="card-title text-nowrap mb-1"> {{ $sum_bill_atm_ }}</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +{{ number_format($rate_sba) }} &#8363;</small>
                          @elseif($rate_sba < 0)
                            <h3 class="card-title text-nowrap mb-1"> {{ $sum_bill_atm_ }}</h3>
                            <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> {{ number_format($rate_sba) }} &#8363;</small>
                          @else
                            <h3 class="card-title text-nowrap mb-1"> {{ $sum_bill_atm_ }}</h3>
                            <small class="text-decoration fw-semibold"><i class='bx bxs-analyse bx-spin' ></i> {{ number_format($rate_sba) }} &#8363;</small>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-12 mb-4">
                      <div class="card">
                        <div>
                          <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                              <div id="chart_div" class="ms-1" style="width: 350px; height: 285px"></div> {{--Biểu đồ tròn--}}
                            </div>
                            {{-- <div id="profileReportChart"></div> --}}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                @php
                  use Carbon\Carbon;
                  $times = Carbon::now('Asia/Ho_Chi_Minh');
                @endphp
                <!-- Expense Overview -->
                <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2 mb-3">Khách hàng nhiều đơn nhất</h5>
                      </div>
                    </div>
                    @if ($get_user_ftop1 != "[]")
                      <div class="card-body mt-3">
                        <ul class="p-0 m-0">
                          @foreach ($get_user_ftop1 as $get_uft1)
                            <li class="d-flex mb-4 pb-1">
                              <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-danger"
                                  ><i class='bx bxs-crown bx-tada'></i></span>
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">{{$get_uft1->username}}</h6>
                                  <small class="text-muted">{{$get_uft1->user_id}}</small>
                                </div>
                                <div class="user-progress d-flex">
                                  <i class='bx bxs-star bx-xs text-danger'></i>
                                  <p>{{$get_uft1->amount_user}}</p>
                                </div>
                              </div>
                            </li>
                          @endforeach
                        </ul><hr>
                        <ul class="p-0 m-0">
                            @foreach ($get_list_user_ftop1 as $key => $get_list_uft1)
                              <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                  @if ($key+1 == 1)
                                    <span class="avatar-initial rounded bg-label-danger">2</span>
                                  @elseif ($key+1 == 2)
                                    <span class="avatar-initial rounded bg-label-danger">3</span>
                                  @elseif ($key+1 == 3)
                                    <span class="avatar-initial rounded bg-label-danger">4</span>
                                  @else
                                    <span class="avatar-initial rounded bg-label-danger">5</span>  
                                  @endif
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                    <h6 class="mb-0">{{$get_list_uft1->username}}</h6>
                                    <small class="text-muted">{{$get_list_uft1->user_id}}</small>
                                  </div>
                                  <div class="user-progress d-flex">
                                    <i class='bx bxs-star bx-xs text-danger'></i>
                                    <p>{{$get_list_uft1->amount_user}}</p>
                                  </div>
                                </div>
                              </li>
                            @endforeach
                        </ul>
                      </div>
                    @else
                      <div class="card-body mt-3">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                              <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-danger"
                                  ><i class='bx bxs-crown bx-tada'></i></span>
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">Tháng {{$times->month}} chưa có dữ liệu</h6>
                                  <small class="text-muted">_</small>
                                </div>
                                <div class="user-progress d-flex">
                                  <i class='bx bxs-star bx-xs text-danger'></i>
                                  <p>0</p>
                                </div>
                              </div>
                            </li>
                        </ul>
                      </div>
                    @endif
                  </div>
                </div>
                <!--/ Expense Overview -->
                <!-- Expense Overview -->
                <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2 mb-3">Khách hàng mua nhiều nhất</h5>
                      </div>
                    </div>
                    @if ($get_user_price_ftop1 != "[]")
                      <div class="card-body mt-3">
                        <ul class="p-0 m-0">
                          @foreach ($get_user_price_ftop1 as $get_p_uft1)
                            <li class="d-flex mb-4 pb-1">
                              <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-warning"
                                  ><i class='bx bxs-crown bx-tada'></i></span>
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">{{$get_p_uft1->username}}</h6>
                                  <small class="text-muted">{{$get_p_uft1->user_id}}</small>
                                </div>
                                <div class="user-progress d-flex">
                                  <small class="fw-semibold text-warning">{{number_format($get_p_uft1->total)}} &#8363;</small>
                                </div>
                              </div>
                            </li>
                          @endforeach
                        </ul><hr>
                        <ul class="p-0 m-0">
                          @foreach ($get_list_user_price_ftop1 as $key => $get_price_uft1)
                            <li class="d-flex mb-4 pb-1">
                              <div class="avatar flex-shrink-0 me-3">
                                  @if ($key+1 == 1)
                                    <span class="avatar-initial rounded bg-label-warning">2</span>
                                  @elseif ($key+1 == 2)
                                    <span class="avatar-initial rounded bg-label-warning">3</span>
                                  @elseif ($key+1 == 3)
                                    <span class="avatar-initial rounded bg-label-warning">4</span>
                                  @else
                                    <span class="avatar-initial rounded bg-label-warning">5</span>  
                                  @endif
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">{{$get_price_uft1->username}}</h6>
                                  <small class="text-muted">{{$get_price_uft1->user_id}}</small>
                                </div>
                                <div class="user-progress d-flex">
                                  <small class="fw-semibold text-warning">{{number_format($get_price_uft1->total)}} &#8363;</small>
                                </div>
                              </div>
                            </li>
                          @endforeach
                        </ul>
                      </div>
                    @else
                      <div class="card-body mt-3">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                              <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-warning"
                                  ><i class='bx bxs-crown bx-tada'></i></span>
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">Tháng {{$times->month}} chưa có dữ liệu</h6>
                                  <small class="text-muted">_</small>
                                </div>
                                <div class="user-progress d-flex">
                                  <small class="fw-semibold text-warning">0 &#8363;</small>
                                </div>
                              </div>
                            </li>
                        </ul>
                      </div>
                    @endif
                  </div>
                </div>
                <!--/ Expense Overview -->
                <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2 mb-3">Sản phẩm bán chạy nhất tháng {{$times->month}}</h5>
                      </div>
                    </div>
                    @if ($get_pr_famous != "[]")
                      <div class="card-body mt-3">
                        <ul class="p-0 m-0">
                          @foreach ($get_pr_famous as $key => $get_prf)
                            <li class="d-flex mb-4 pb-1">
                              <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-success">{{$key+1}}</span>
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">{{$get_prf->id_product}}</h6>
                                  <small>{{$get_prf->day_c}} - {{$get_prf->month_c}} - {{$get_prf->year_c}}</small>
                                </div>
                                <div class="user-progress d-flex">
                                  <i class='bx bxs-star bx-xs text-warning'></i>
                                  <p>{{$get_prf->amount_bill}}</p>
                                </div>
                              </div>
                            </li>
                            @if ($key+1 == 1)
                              <hr>
                            @endif
                          @endforeach
                        </ul>
                      </div>
                    @else
                      <div class="card-body mt-3">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                              <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-success">0</span>
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="mb-0">Tháng {{$times->month}} chưa có dữ liệu</h6>
                                  <small>{{$times->format('d-m-Y')}}</small>
                                </div>
                                <div class="user-progress d-flex">
                                  <i class='bx bxs-star bx-xs text-warning'></i>
                                  <p>0</p>
                                </div>
                              </div>
                            </li>
                        </ul>
                      </div>
                    @endif
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
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('dashboard/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script src="{{ asset('dashboard/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('dashboard/assets/js/main.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('dashboard/assets/js/dashboards-analytics.js') }}"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session()->has('success'))
      <script>
        swal({
              title: "{{session()->get('success')}}",
              icon: "success",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
    @if (session()->has('login-sc'))
      <script>
        swal({
              title: "{{session()->get('login-sc')}}",
              icon: "success",
              button: "OK",
              timer: 1000,
            });
      </script>
    @endif
    @if (session()->has('no_data_search'))
      <script>
        swal({
              title: "{{session()->get('no_data_search')}}",
              icon: "warning",
              button: "OK",
              timer: 1000,
            });
      </script>
    @endif
  </body>
</html>
