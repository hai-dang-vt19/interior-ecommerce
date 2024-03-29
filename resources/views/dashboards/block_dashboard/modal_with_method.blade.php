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
    <script src="{{ asset('dashboard/assets/js/config.js') }}"></script>
    @include('dashboards.blocks.head')
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
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / </span>Danh sách đơn hàng sử dụng dịch vụ {{ $methods }}</h4>
              <!-- Responsive Table -->
              <div class="card">
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">STT</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Mã đơn</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">MSP</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">SL</th> 
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Giá tiền</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Phí dịch vụ</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Trạng thái</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Ngày tạo</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Khách hàng</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Tổng tiền</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($bill as $key => $bl)
                      <tr 
                        data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="left"
                        data-bs-html="true"
                        title="<span>Nhấn mã đơn để xem <br>chi tiết</span>"
                      >
                        <td scope="row">{{$key+1}}</td>
                        <td>
                          <a href="{{ route('detail_bill', ['id'=>$bl->id_bill, 'product'=>$bl->id_product]) }}">{{$bl->id_bill}}</a>
                        </td>
                        <td>{{$bl->id_product}}</td>
                        <td>{{$bl->amount}}</td>
                        <td>{{number_format($bl->price)}} &#8363;</td>
                        <td>{{number_format($bl->price_service)}} &#8363;</td>
                        @if ($bl->status_product_bill == 1)
                          <td><a href="{{ route('detail_bill', ['id'=>$bl->id_bill, 'product'=>$bl->id_product]) }}" class="badge bg-dark">Chờ xử lý</a></td>
                        @elseif($bl->status_product_bill == 2)
                          <td><a href="{{ route('detail_bill', ['id'=>$bl->id_bill, 'product'=>$bl->id_product]) }}" class="badge bg-primary">Đang giao</a></td>
                        @elseif($bl->status_product_bill == 3)
                          <td><a href="{{ route('detail_bill', ['id'=>$bl->id_bill, 'product'=>$bl->id_product]) }}" class="badge bg-info">Chờ xác nhận</a></td>
                        @else
                          <td><a href="{{ route('detail_bill', ['id'=>$bl->id_bill, 'product'=>$bl->id_product]) }}" class="badge bg-warning">Thành công</a></td>
                        @endif
                        <td>{{$bl->date_create}}</td>
                        <td>{{$bl->phone}}</td>
                        <td>{{number_format($bl->total)}} &#8363;</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <small class="text-muted float-end">Interior <span style="color: rgb(231, 171, 6)">CS</span></small>    
              <div class="d-flex mt-3">
                {{ $bill->links() }}
              </div>
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
    @include('dashboards.blocks.foo')
  </body>
</html>
