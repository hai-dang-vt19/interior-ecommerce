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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Chi tiết đơn hàng </h4>
              <!-- Responsive Table -->
              {{-- <div class="card"> --}}
                @foreach ($bill as $key => $bl)
                  <div class="col mb-4 ms-5">
                    <div class="mt-3">
                      <div class="row">
                        <div class="col-md-2 col-12 mb-3 mb-md-0 me-5">
                          <div class="list-group">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list" href="#list-home" >Đơn hàng</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-profile">Sản phẩm</a>
                          </div>
                        </div>
                        <div class="col-8 card">
                          <div class="tab-content p-0">
                            <div class="tab-pane fade show active" id="list-home">
                                <h5 class="mt-3 ms-4"><span>Mã đơn hàng:</span> <span class="ms-2 text-warning">{{$bl->id_bill}}</span></h5>
                                <dl class="row mt-2 ms-4"><hr class="mb-4">
                                    <dt class="col-sm-2">Số lượng</dt>
                                    <dd class="col-sm-4 text-primary">{{$bl->amount}}</dd>
            
                                    <dt class="col-sm-2">Khách hàng</dt>
                                    <dd class="col-sm-4 text-primary">{{$bl->username}}</dd>
                                    <br>
            
                                    @php
                                        $date = Carbon\Carbon::parse($bl->date_create)->format('d-m-Y');
                                    @endphp
                                    <dt class="col-sm-2 text-truncate">Ngày tạo</dt>
                                    <dd class="col-sm-4 text-primary"> {{$date}}</dd>
                                    
                                    <dt class="col-sm-2 text-truncate">Email</dt>
                                    <dd class="col-sm-4 text-primary"> {{$bl->email}}</dd>
                                    <br>

                                    <dt class="col-sm-2">Trạng thái</dt>
                                    @if ($bl->status_product_bill == '1')
                                      <dd class="col-sm-4"> <p class="badge bg-dark">Chờ xử lý</p></dd>
                                    @elseif ($bl->status_product_bill == '2')
                                      <dd class="col-sm-4"> <p class="badge bg-primary">Đang giao</p></dd>
                                    @elseif ($bl->status_product_bill == '3')
                                      <dd class="col-sm-4"> <p class="badge bg-success">Chờ xác nhận</p></dd>
                                    @else
                                      <dd class="col-sm-4"> <p class="badge bg-warning">Giao hàng thành công</p></dd>
                                    @endif

                                    <dt class="col-sm-2 text-truncate">Điện thoại</dt>
                                    <dd class="col-sm-4 text-primary"> {{$bl->phone}}</dd>
                                    <br><hr class="mb-4">
                                    <dt class="col-sm-2 text-truncate">Thanh toán</dt>
                                    <dd class="col-sm-4 text-primary"> {{$bl->method}}</dd>
                                  {{--  --}}
                                    @if (empty($bl->bank))
                                      <dt class="col-sm-2 text-truncate">Ngân hàng</dt>
                                      <dd class="col-sm-4"><i class='bx bx-block bx-xs'></i></dd>
                                    @else
                                      <dt class="col-sm-2 text-truncate">Ngân hàng</dt>
                                      <dd class="col-sm-4 text-primary"> {{$bl->bank}}</dd>
                                    @endif                                    
                                    @if (empty($bl->code_bank))
                                      <dt class="col-sm-2 text-truncate">Code Bank</dt>
                                      <dd class="col-sm-4 "><i class='bx bx-block bx-xs'></i></dd>
                                    @else
                                      <dt class="col-sm-2 text-truncate">Code Bank</dt>
                                      <dd class="col-sm-4 text-primary"> {{$bl->code_bank}}</dd>                                        
                                    @endif
                                    @if (empty($bl->code_vnpay))
                                    <dt class="col-sm-2 text-truncate">Code Vnpay</dt>
                                    <dd class="col-sm-4"> <i class='bx bx-block bx-xs'></i></dd>
                                    @else
                                    <dt class="col-sm-2 text-truncate">Code Vnpay</dt>
                                    <dd class="col-sm-4 text-primary"> {{$bl->code_vnpay}}</dd>
                                        
                                    @endif
                                  {{--  --}}
                                    <dt class="col-sm-2">Phí dịch vụ</dt>
                                    <dd class="col-sm-4 text-primary">{{number_format($bl->price_service)}} &#8363;
                                    
                                    
                                    <dt class="col-sm-2">Tổng tiền</dt>
                                    <dd class="col-sm-4 text-danger"><p>{{number_format($bl->total)}} &#8363;</p></dd>

                                    <dt class="col-sm-2">Đ/c nhận</dt>
                                    <dd class="col-sm-9 mb-4">{{$bl->address}}</dd>
                                </dl>
                            </div>
                            <div class="tab-pane fade" id="list-profile">
                              <h5 class="mt-3 ms-4"><span>Mã đơn hàng:</span> <span class="ms-2 text-warning">{{$bl->id_bill}}</span></h5><hr>
                              @foreach ($product as $pr)
                                <div class="d-flex ms-2">
                                  <div class="col-7 ms-3">
                                    <div class="d-flex">
                                      <p class="col-3">Mã sản phẩm</p><p class="text-primary ms-4">{{ $pr->id_product }}</p>
                                    </div>
                                    <div class="d-flex">
                                      <p class="col-3">Tên sản phẩm</p><p class="text-primary ms-4">{{ $pr->name_product }}</p>
                                    </div>
                                    <div class="d-flex">
                                      <p class="col-3">Loại sản phẩm</p><p class="text-primary ms-4">{{ $pr->type_product }}</p>
                                    </div>
                                    <div class="d-flex">
                                      <p class="col-3">Máu sắc</p><p class="text-primary ms-4">{{ $pr->color }}</p>
                                    </div>
                                    <div class="d-flex">
                                      <p class="col-3">Giá tiền</p><p class="text-primary ms-4">{{number_format( $pr->price) }} &#8363;</p>
                                    </div>
                                    <div class="d-flex">
                                      <p class="col-3">Giá sale</p><p class="text-primary ms-4">{{ $pr->sales }}</p>
                                    </div>
                                    <div class="d-flex">
                                      <p class="col-3">Chất liệu</p><p class="text-primary ms-4">{{ $pr->material }}</p>
                                    </div>
                                    <div class="d-flex">
                                      <p class="col-3">Nhà cung cấp</p><p class="text-primary ms-4">{{ $pr->supplier }}</p>
                                    </div>
                                  </div>
                                  <div class="card mb-4">
                                    <img class="card-img-top" src="{{ asset('dashboard\upload_img\product/'.$pr->images) }}" alt="Card image cap" />
                                    <div class="card-body">
                                      <p class="card-text text-center">
                                        <strong>
                                          Tổng tiền: <span class="text-danger">{{ number_format($bl->total) }}&#8363;</span>
                                        </strong>
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            @endforeach    
              <!--/ Responsive Table -->
            {{-- </div> --}}
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
  </body>
</html>
