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
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  </head>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          @include('dashboards.blocks.menu-z-bill')
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
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  @include('dashboards.blocks.dropdown-user')
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product/</span> Thêm mới sản phẩm</h4>
              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic with Icons -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between mb-3" style="border-bottom: 3px dashed #F5F5F9">
                        <div class="d-flex">
                            <a href="{{ route('destroy_bill_dashboard', ['id_bill'=>$id_bill_]) }}" class="btn btn-danger">Hủy</a>
                        </div>
                      <small class="text-muted float-end">Interior <span style="color: rgb(231, 171, 6)">CS</span></small>
                    </div>
                    {{-- <hr class="my-0 mb-3"> --}}
                    <div class="card-body mb-3">
                      <form action="{{ route('update_after_pay') }}" method="POST">
                        @csrf
                          <input type="hidden" value="{{ $id_bill_ }}" name="id_bill">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Họ tên</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="username">
                                </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-2 col-form-label">Số điện thoại</label>
                              <div class="col-sm-6">
                                  <input type="text" class="form-control" name="phone">
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-2 col-form-label">Email</label>
                              <div class="col-sm-6">
                                  <input type="text" class="form-control" name="email">
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-2 col-form-label">Địa chỉ</label>
                              <div class="col-sm-6">
                                  <input type="text" class="form-control" name="address">
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-2 col-form-label">Mã giảm giá</label>
                              <div class="col-sm-6">
                                  <select class="form-select" name="discount">
                                    <option value="0" selected></option>
                                    @foreach ($discounts as $discount)
                                      <option value="{{ $discount->price }}">{{ $discount->name_discount}}</option>
                                    @endforeach
                                  </select>
                              </div>
                            </div>
                            <div class="row ms-1">
                              <div>
                                <button type="submit" class="btn btn-warning">Xác nhận</button>
                              </div>
                            </div>
                      </form>
                    </div>
                  </div>
                  
                  <div class="card">
                    <div class="table-responsive text-nowrap">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Mã đơn</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Mã sản phẩm</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Tên sản phẩm</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Giá sản phẩm</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Số lượng</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Tổng tiền</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($get_data_for_bill as $crt)
                          <tr>
                            <td>{{ $crt->id_bill }}</td>
                            <td>{{ $crt->id_product }}</td>
                            <td>{{ $crt->name_product }}</td>
                            <td>{{number_format($crt->price)}} &#8363;</td>
                            <td>{{ $crt->amount }}</td>
                            <td>{{number_format($crt->total)}} &#8363;</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  {{-- <div class="float-end mt-1 me-5 btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle shadow " data-bs-toggle="dropdown" aria-expanded="false">
                      <i class='bx bx-dollar'></i> Thanh toán
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <div class="dropdown-item">
                          <form action="" method="POST">
                            @csrf
                            <input type="hidden" name="" value="">
                            <button style="border: none; background-color: #ffffff" name="redirect">Tiền mặt</button>
                          </form>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <form action="{{ route('vnpay_payment_atm_dashboard') }}" method="POST">
                            @csrf
                            <input type="hidden" name="total_vnpay" value="{{ $sum_cart }}">
                            <button style="border: none; background-color: #ffffff" name="redirect">VNPAY ATM</button>
                          </form>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <form action="{{ route('vnpay_payment_qr_dashboard') }}" method="POST">
                            @csrf
                            <input type="hidden" name="total_vnpay" value="{{ $sum_cart }}">
                            <button style="border: none; background-color: #ffffff" name="redirect">VNPAY QR</button>
                          </form>
                        </div>
                      </li>
                    </ul>
                  </div> --}}
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
    {{-- <script src="{{ asset('dashboard\js\formatCurrence.js') }}"></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session()->has('er_add_product'))
      <script>
        swal({
              title: "{{session()->get('er_add_product')}}",
              icon: "error",
              button: "OK",
              timer: 1000,
            });
      </script>
    @endif
  </body>
</html>
