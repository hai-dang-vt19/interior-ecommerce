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
          @include('dashboards.blocks.menu-z-bill');
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Order / </span>Danh sách đơn hàng <a href="{{ route('export_excel_bill') }}" class="btn btn-primary btn-xs">Export Excel</a></h4>
              <div class="mb-4 d-flex">
                <div class="btn-group">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class='bx bx-message-square-add'></i> Chọn sản phẩm
                  </button>
                  <ul class="dropdown-menu">
                    @foreach ($product as $pro)
                      <li><a class="dropdown-item" href="{{ route('create_bill_dashboard', ['data'=>$pro->id_product]) }}">{{$pro->id_product}}</a></li>    
                    @endforeach
                  </ul>
                </div>
                <form action="{{ route('create_bill_dashboard') }}" method="GET">
                  <div class="d-flex ms-5">
                      <input type="text" class="form-control me-1" value="ICS" name="data" placeholder="Nhập mã">
                      <Button class="btn btn-outline-secondary">Check</Button>
                  </div>
                </form>
              </div>
              <!-- Responsive Table -->
              <div class="card">
                <div class="nav-align-top">
                  <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                      <a href="{{ route('bill_dashboad') }}" class="nav-link">
                        @if ($count_xl == 0)
                            <i class='tf-icons bx bx-loader-circle bx-flip-horizontal' ></i> 
                        @else
                            <i class='tf-icons bx bx-loader-circle bx-spin bx-flip-horizontal' ></i> 
                        @endif
                        Xử lý
                        <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">{{$count_xl}}</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('bill_vanchuyen_dashboad') }}" class="nav-link">
                        <i class="tf-icons bx bxs-ship"></i> Vận chuyển
                        <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">{{$count_vc}}</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('bill_hangden_dashboad') }}" class="nav-link active">
                        @if ($count_hd == 0) 
                            <i class='tf-icons bx bx-bell' ></i> 
                        @else
                            <i class='tf-icons bx bx-bell bx-tada' ></i> 
                        @endif
                        Hàng đến
                        <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">{{$count_hd}}</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('bill_thanhcong_dashboad') }}" class="nav-link">
                        <i class='tf-icons bx bxs-badge-check'></i> Thành công
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    {{--Hàng đến--}}
                    <div>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th style="color: rgb(231, 171, 6);font-size: 14px">STT</th>
                                  <th style="color: rgb(231, 171, 6);font-size: 14px">ID Bill</th>
                                  <th style="color: rgb(231, 171, 6);font-size: 14px">ID sản phẩm</th>
                                  <th style="color: rgb(231, 171, 6);font-size: 14px">Email</th>
                                  <th style="color: rgb(231, 171, 6);font-size: 14px">Số điện thoại</th>
                                  <th style="color: rgb(231, 171, 6);font-size: 14px">Phương thức</th>
                                  <th style="color: rgb(231, 171, 6);font-size: 14px">Trạng thái</th>
                                  <th style="color: rgb(231, 171, 6);font-size: 14px">Tên sản phẩm</th>
                                  <th style="color: rgb(231, 171, 6);font-size: 14px">Tổng tiền</th>
                                  <th style="color: rgb(231, 171, 6);font-size: 14px">Địa chỉ</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($bill_hangden as $key_hd => $bill_hd)
                                <tr>
                                  <td scope="row">{{$key_hd+1}}</td>
                                  <td><a href="{{ route('detail_bill', ['id'=>$bill_hd->id_bill, 'product'=>$bill_hd->id_product]) }}">{{$bill_hd->id_bill}}</a></td>
                                  <td>{{$bill_hd->id_product}}</td>
                                  <td>{{$bill_hd->email}}</td>
                                  <td>{{$bill_hd->phone}}</td>
                                  <td>{{$bill_hd->method}}</td>
                                  <td>
                                    @if ($bill_hd->method == "STORE")
                                      <a href="{{ route('up_bill_xacnhan_store', ['id'=>$bill_hd->id_bill]) }}" class="badge bg-primary">Xác nhận</a>
                                    @else
                                      <a href="#" class="badge bg-success">Khách hàng xác nhận</a>
                                    @endif
                                  </td>
                                  <td>{{$bill_hd->name_product}}</td>
                                  <td>{{number_format($bill_hd->total)}} &#8363;</td>
                                  <td>{{$bill_hd->address}}</td>
                                  {{-- <td>
                                    <a href="{{ route('edit_product', ['id'=>$bill_hd->id]) }}" class="btn btn-primary"><i class='bx bxs-edit'></i></a>
                                    <a href="{{ route('destroy_product', ['id'=>$bill_hd->id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa không?')"><i class='bx bx-trash-alt'></i></a>
                                  </td> --}}
                                  <td>
                                    <a href="{{ route('destroy_donhang_dashboard', ['id'=>$bill_hd->id_bill]) }}" class="btn-xs btn-danger">Hủy đơn</a>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex mt-3">
                {{ $bill_hangden->links() }}
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
      @if (session()->has('product_update_sc'))
        <script>
          swal({
                title: "{{session()->get('product_update_sc')}}",
                icon: "success",
                button: "OK",
                timer: 2000,
              });
        </script>
      @endif
      @if (session()->has('product_ds'))
        <script>
          swal({
                title: "Mã SP: {{session()->get('product_ds')}}",
                icon: "success",
                button: "OK",
                timer: 2000,
              });
        </script>
      @endif
      @if (session()->has('up_vc'))
        <script>
          swal({
                title: "{{session()->get('up_vc')}}",
                icon: "success",
                button: "OK",
                timer: 500,
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
      @if (session()->has('huy_bill'))
      <script>
        swal({
              title: "{{session()->get('huy_bill')}}",
              icon: "success",
              button: "OK",
              timer: 1000,
            });
      </script>
      @endif
  </body>
</html>
