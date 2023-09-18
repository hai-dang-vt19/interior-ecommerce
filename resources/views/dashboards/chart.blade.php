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
    {{-- <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" /> --}}
    
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <!-- Page CSS -->
    <!-- Helpers -->
    <script src="{{ asset('dashboard/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/config.js') }}"></script>
    {{-- flat picker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
    
    @include('dashboards.blocks.head')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          
          <?php
            if (isset($charts) && isset($charts)) {
              echo $des;
              echo $charts;
            }else{
              echo "['', 'ATM', 'STORE', 'COD']'";
            }
          ?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '', // tưi điền nếu muốn
          },
          height: 100,
          bars: 'horizontal'
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Method', 'Data'],
          <?php
            if (isset($charts2)) {
              echo $charts2;
            }else{
              echo "['Null', 0]'";
            }
          ?>
        ]);

        var options = {
          title: '',
          pieHole: 0.1,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
<body>
    @include('dashboards.blocks.fakeload')
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
            @php
              use App\Models\typeproduct;
              $typeProduct = typeproduct::all();
            @endphp
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card mb-3">
                    <form class="p-4" action="{{ route('index_ExpenseYear') }}" method="GET" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-2">
                              <label for="status_mo">Trạng thái</label>
                              <select class="form-select" id="status_mo" name="status_y">
                                <option value="4">Đơn thành công</option>
                                <option value="0">Đơn hủy</option>
                              </select>
                            </div>
                            <div class="col-sm-3 mb-1">
                              <label>Thời gian</label>
                              <input type="text" class="form-control" id="datepiker" name="y1" required>
                            </div>
                            <div class="col-sm-3 mb-1">
                              <label>Loại sản phẩm</label>
                              <select name="type_product" class="form-select">
                                <option selected value="all">--All--</option>
                                @foreach ($typeProduct as $itm_type)
                                  <option value="{{$itm_type->name_type}}">{{$itm_type->name_type}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-sm-3 mb-1">
                              <label>Số điện thoại</label>
                              <input type="text" class="form-control" name="phone">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2">
                              <div class="form-check">
                                <input name="radioMethod_year" class="form-check-input" type="radio" value="ATM" id="radi_atm"/>
                                <label class="form-check-label" for="radi_atm"> ATM </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <input name="radioMethod_year" class="form-check-input" type="radio" value="STORE" id="radi_sto"/>
                                <label class="form-check-label" for="radi_sto"> STORE </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <input name="radioMethod_year" class="form-check-input" type="radio" value="COD" id="radi_cod"/>
                                <label class="form-check-label" for="radi_cod"> COD </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="form-check">
                                <input name="radioMethod_year" class="form-check-input" type="radio" value="0" id="radi_all" checked/>
                                <label class="form-check-label" for="radi_all"> ALL </label>
                              </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-check form-checkbox mb-2">
                                  <input class="form-check-input" type="checkbox" id="ck_y" name="ck_y"/>
                                  <label class="form-check-label" for="ck_y">Lấy theo năm</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary btn-sm">Xác nhận</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card overflow-hidden mb-3">
                  <div class="card-body p-3" id="horizontal-example">
                    <div id="barchart_material" class="w-100 h-100"></div>
                  </div>
                </div>
                <div class="card overflow-hidden">
                  <div class="card-body p-3" id="horizontal-example">
                    <div id="donutchart" class="w-100 h-100"></div>
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
    <script src="{{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('dashboard/assets/js/main.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('dashboard/assets/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/extended-ui-perfect-scrollbar.js') }}"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{--flatpicker--}}
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script>
    <script>
        flatpickr("#datepiker", {
          mode: "range",
          dateFormat:'d-m-Y',
          // defaultDate: 'today',
          allowInput: 'true' //cho phep go
          // locale: "vn"
        });
    </script>
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
    @include('dashboards.blocks.foo')
</body>
</html>
