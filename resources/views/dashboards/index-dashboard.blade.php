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
          // ['2014', 1000, 400, 200],
          // ['2015', 1170, 460, 250],
          // ['2016', 660, 1120, 300],
          // ['2017', 1030, 540, 350]
          <?php echo $charts_0;?>
          <?php echo $charts_1;?>
          <?php echo $charts_2;?>
        ]);

        var options = {
          chart: {
            title: 'Doanh thu các năm gần nhất',
            subtitle: '', // tưi điền nếu muốn
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

  </head>

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
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
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
                          {{-- @php
                            $strlen_te = strlen($total_expense); 
                              if($strlen_te == 5){//chục nghìn
                                  $subtr_ex = Str::substr($total_expense, 0, 2);
                                  $total_expenses = number_format($subtr_ex).' nghìn';
                              }elseif($strlen_te == 6){//trăm nghìn
                                  $subtr_ex = Str::substr($total_expense, 0, 3);
                                  $total_expenses = number_format($subtr_ex).' nghìn';
                              }elseif($strlen_te == 7){//triệu
                                  $subtr_ex = Str::substr($total_expense, 0, 1);
                                  $total_expenses = number_format($subtr_ex).' triệu';
                              }elseif($strlen_te == 8){//chục triệu
                                  $subtr_ex = Str::substr($total_expense, 0, 2);
                                  $total_expenses = number_format($subtr_ex).' triệu'; 
                              }elseif($strlen_te == 9){//trăm triệu
                                  $subtr_ex = Str::substr($total_expense, 0, 3);
                                  $total_expenses = number_format($subtr_ex).' triệu';
                              }else{//tỷ
                                  $subtr_ex = Str::substr($total_expense, 0, 1);
                                  $total_expenses= number_format($subtr_ex).' tỷ';
                              }
                          @endphp --}}
                          @if ($total_expense > 0)
                            <h3 class="card-title text-nowrap mb-1"> {{number_format( $total_expense )}}</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i></small>
                          @elseif($total_expense < 0)
                            <h3 class="card-title text-nowrap mb-1"> {{number_format( $total_expense )}}</h3>
                            <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i></small>
                          @else
                            <h3 class="card-title text-nowrap mb-1"> {{number_format( $total_expense )}}</h3>
                            <small class="text-decoration fw-semibold"><i class='bx bxs-analyse bx-spin'></i></small>
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
                              if($strlen_sbc == 5){//chục nghìn
                                  $sum_bill_cod_ = number_format($sum_bill_cod);
                              }elseif($strlen_sbc == 1){
                                  $sum_bill_cod_ = number_format($sum_bill_cod);
                              }elseif($strlen_sbc == 6){//trăm nghìn
                                  $sum_bill_cod_ = number_format($sum_bill_cod);
                              }elseif($strlen_sbc == 7){//triệu
                                  $sum_bill_cod_ = number_format($sum_bill_cod);
                              }elseif($strlen_sbc == 8){//chục triệu
                                  $subtr_c = Str::substr($sum_bill_cod, 0, 2);
                                  $sum_bill_cod_ = number_format($subtr_c).' triệu'; 
                              }elseif($strlen_sbc == 9){//trăm triệu
                                  $subtr_c = Str::substr($sum_bill_cod, 0, 3);
                                  $sum_bill_cod_ = number_format($subtr_c).' triệu';
                              }else{//tỷ
                                  $subtr_c = Str::substr($sum_bill_cod, 0, 1);
                                  $sum_bill_cod_= number_format($subtr_c).' tỷ';
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
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-8">
                        
                        <div id="barchart_material" class="px-2 mt-3 mb-5" style="width: 800px; height: 310px;"></div>{{-- Biểu đồ --}}
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
                              if($strlen_sbs == 5){//chục nghìn
                                $sum_bill_store_ = number_format($sum_bill_store);
                              }elseif($strlen_sbs == 1){
                                  $sum_bill_store_ = number_format($sum_bill_store);
                              }elseif($strlen_sbs == 6){//trăm nghìn
                                  $sum_bill_store_ = number_format($sum_bill_store);
                              }elseif($strlen_sbs == 7){//triệu
                                  $sum_bill_store_ = number_format($sum_bill_store);
                              }elseif($strlen_sbs == 8){//chục triệu
                                  $subtr_s = Str::substr($sum_bill_store, 0, 2);
                                  $sum_bill_store_ = number_format($subtr_s).' triệu'; 
                              }elseif($strlen_sbs == 9){//trăm triệu
                                  $subtr_s = Str::substr($sum_bill_store, 0, 3);
                                  $sum_bill_store_ = number_format($subtr_s).' triệu';
                              }else{//tỷ
                                  $subtr_s = Str::substr($sum_bill_store, 0, 1);
                                  $sum_bill_store_= number_format($subtr_s).' tỷ';
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
                          {{-- @php
                            $strlen_sba = strlen($sum_bill_atm); 
                              if($strlen_sba == 5){//chục nghìn
                                  $sum_bill_atm_ = number_format($sum_bill_atm);
                              }elseif($strlen_sba == 1){
                                  $sum_bill_atm_ = number_format($sum_bill_atm);
                              }elseif($strlen_sba == 6){//trăm nghìn
                                  $sum_bill_atm_ = number_format($sum_bill_atm);
                              }elseif($strlen_sba == 7){//triệu
                                  $sum_bill_atm_ = number_format($sum_bill_atm);
                              }elseif($strlen_sba == 8){//chục triệu
                                  $subtr_a = Str::substr($sum_bill_atm, 0, 2);
                                  $sum_bill_atm_ = number_format($subtr_a).' triệu'; 
                              }elseif($strlen_sba == 9){//trăm triệu
                                  $subtr_a = Str::substr($sum_bill_atm, 0, 3);
                                  $sum_bill_atm_ = number_format($subtr_a).' triệu';
                              }else{//tỷ
                                  $subtr_a = Str::substr($sum_bill_atm, 0, 1);
                                  $sum_bill_atm_= number_format($subtr_a).' tỷ';
                              }
                          @endphp --}}
                          @if ($rate_sba > 0)
                            <h3 class="card-title text-nowrap mb-1"> {{ number_format($sum_bill_atm) }}</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +{{ number_format($rate_sba) }} &#8363;</small>
                          @elseif($rate_sba < 0)
                            <h3 class="card-title text-nowrap mb-1"> {{ number_format($sum_bill_atm) }}</h3>
                            <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> {{ number_format($rate_sba) }} &#8363;</small>
                          @else
                            <h3 class="card-title text-nowrap mb-1"> {{ number_format($sum_bill_atm) }}</h3>
                            <small class="text-decoration fw-semibold"><i class='bx bxs-analyse bx-spin' ></i> {{ number_format($rate_sba) }} &#8363;</small>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-12 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                              <div class="card-title">
                                <h5 class="text-nowrap mb-2">Tổng tiền {{ $get_year }}</h5>
                                <span class="badge bg-label-warning rounded-pill">Year {{ $get_year }}</span>
                              </div>
                              <div class="mt-sm-auto">
                                <small class="text-success text-nowrap fw-semibold"
                                  ><i class="bx bx-chevron-up"></i> 68.2%</small
                                >
                                <h3 class="mb-0"> {{ number_format($sum_bill_y) }} &#8363;</h3>
                              </div>
                            </div>
                            <div id="curve_chart" style="width: 200px; height: 112px"></div>
                            {{-- <div id="profileReportChart"></div> --}}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <!-- Order Statistics -->
                <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Thống kê đơn hàng</h5>
                        <small class="text-muted">Tổng doanh số 42.82k</small>
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="orederStatistics"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                          <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                          <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                          <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                          <h2 class="mb-2">8,258</h2>
                          <span>Tổng số đơn hàng</span>
                        </div>
                        <div id="orderStatisticsChart"></div>
                      </div>
                      <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"
                              ><i class="bx bx-mobile-alt"></i
                            ></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Electronic</h6>
                              <small class="text-muted">Mobile, Earbuds, TV</small>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold">82.5k</small>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Fashion</h6>
                              <small class="text-muted">T-shirt, Jeans, Shoes</small>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold">23.8k</small>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Decor</h6>
                              <small class="text-muted">Fine Art, Dining</small>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold">849k</small>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex">
                          <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-secondary"
                              ><i class="bx bx-football"></i
                            ></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <h6 class="mb-0">Sports</h6>
                              <small class="text-muted">Football, Cricket Kit</small>
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold">99</small>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!--/ Order Statistics -->

                <!-- Expense Overview -->
                <div class="col-md-6 col-lg-4 order-1 mb-4">
                  <div class="card h-100">
                    <div class="card-header">
                      <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                          <button
                            type="button"
                            class="nav-link active"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-tabs-line-card-income"
                            aria-controls="navs-tabs-line-card-income"
                            aria-selected="true"
                          >
                            Thu thập
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab">Chi phí</button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab">Lợi nhuận</button>
                        </li>
                      </ul>
                    </div>
                    <div class="card-body px-0">
                      <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                          <div class="d-flex p-4 pt-3">
                            <div class="avatar flex-shrink-0 me-3">
                              <img src="{{ asset('dashboard/assets/img/icons/unicons/wallet.png') }}" alt="User" />
                              
                            </div>
                            <div>
                              <small class="text-muted d-block">Tổng số dư</small>
                              <div class="d-flex align-items-center">
                                <h6 class="mb-0 me-1"> 459.10</h6>
                                <small class="text-success fw-semibold">
                                  <i class="bx bx-chevron-up"></i>
                                  42.9%
                                </small>
                              </div>
                            </div>
                          </div>
                          <div id="incomeChart"></div>
                          <div class="d-flex justify-content-center pt-4 gap-2">
                            <div class="flex-shrink-0">
                              <div id="expensesOfWeek"></div>
                            </div>
                            <div>
                              <p class="mb-n1 mt-1">Chi phí của tuần</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Expense Overview -->

                <!-- Transactions -->
                <div class="col-md-6 col-lg-4 order-2 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Giao dịch</h5>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="transactionID"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                          <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <img src="{{ asset('dashboard/assets/img/icons/unicons/paypal.png') }}" alt="User" class="rounded" />
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <small class="text-muted d-block mb-1">Paypal</small>
                              <h6 class="mb-0">Send money</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <h6 class="mb-0">+82.6</h6>
                              <span class="text-muted">USD</span>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <img src="{{ asset('dashboard/assets/img/icons/unicons/wallet.png') }}" alt="User" class="rounded" />
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <small class="text-muted d-block mb-1">Wallet</small>
                              <h6 class="mb-0">Mac'D</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <h6 class="mb-0">+270.69</h6>
                              <span class="text-muted">USD</span>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <img src="{{ asset('dashboard/assets/img/icons/unicons/chart.png') }}" alt="User" class="rounded" />
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <small class="text-muted d-block mb-1">Transfer</small>
                              <h6 class="mb-0">Refund</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <h6 class="mb-0">+637.91</h6>
                              <span class="text-muted">USD</span>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <img src="{{ asset('dashboard/assets/img/icons/unicons/cc-success.png') }}" alt="User" class="rounded" />
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <small class="text-muted d-block mb-1">Credit Card</small>
                              <h6 class="mb-0">Ordered Food</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <h6 class="mb-0">-838.71</h6>
                              <span class="text-muted">USD</span>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <img src="{{ asset('dashboard/assets/img/icons/unicons/wallet.png') }}" alt="User" class="rounded" />
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <small class="text-muted d-block mb-1">Wallet</small>
                              <h6 class="mb-0">Starbucks</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <h6 class="mb-0">+203.33</h6>
                              <span class="text-muted">USD</span>
                            </div>
                          </div>
                        </li>
                        <li class="d-flex">
                          <div class="avatar flex-shrink-0 me-3">
                            <img src="{{ asset('dashboard/assets/img/icons/unicons/cc-warning.png') }}" alt="User" class="rounded" />
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              <small class="text-muted d-block mb-1">Mastercard</small>
                              <h6 class="mb-0">Ordered Food</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                              <h6 class="mb-0">-92.45</h6>
                              <span class="text-muted">USD</span>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!--/ Transactions -->
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
  </body>
</html>
