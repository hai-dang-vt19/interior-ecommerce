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
          @include('dashboards.blocks.menu-list-product');
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product / </span>Danh sách sản phẩm</h4>
              <!-- Responsive Table -->
              <div class="card">
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">STT</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">MSP</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Tên sản phẩm</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Loại sản phẩm</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Số lượng</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Màu sắc</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Giá tiền</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Chất liệu</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Nhà sản xuất</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Hình ảnh</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Kích cỡ</th>
                        {{-- <th style="color: rgb(231, 171, 6);font-size: 14px">Mô tả</th> --}}
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Trạng thái</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Giá sale</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Ngày tạo</th>
                        <th style="color: rgb(231, 171, 6);font-size: 14px">Chức năng</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($product as $key => $pro)
                      <tr>
                        <td scope="row">{{$key+1}}</td>
                        <td>{{$pro->id_product}}</td>
                        <td>{{$pro->name_product}}</td>
                        <td>{{$pro->type_product}}</td>
                        <td>{{$pro->amount}}</td>
                        <td>{{$pro->color}} {{$pro->color2}} {{$pro->color3}}</td>
                        <td>{{number_format($pro->price)}} &#8363;</td>
                        <td>{{$pro->material}}</td>
                        <td>{{$pro->supplier}}</td>
                        <td>
                          <div class="d-flex">
                            <img src="{{ asset('dashboard\upload_img\product/'.$pro->images) }}" alt=""  style="max-width: 55px;max-height: 47px">
                            @if ($pro->images2 != null)
                              <img class="ms-1" src="{{ asset('dashboard\upload_img\product/'.$pro->images2) }}" alt=""  style="max-width: 55px;max-height: 47px">
                            @endif  
                          </div>
                        </td>
                        <td>{{$pro->size}}</td>
                        {{-- <td>{{$pro->descriptions}}</td> --}}
                        <td>{{$pro->status}}</td>
                        <td>{{number_format($pro->sales)}} &#8363;</td>
                        <td>{{$pro->date}}</td>
                        <td>
                          <a href="{{ route('edit_product', ['id'=>$pro->id]) }}" class="btn btn-primary"><i class='bx bxs-edit'></i></a>
                          <a href="{{ route('destroy_product', ['id'=>$pro->id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa không?')"><i class='bx bx-trash-alt'></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <small class="text-muted float-end">Interior <span style="color: rgb(231, 171, 6)">CS</span></small>    
              <div class="d-flex mt-3">
                {{ $product->links() }}
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
  </body>
</html>
