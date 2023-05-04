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
          @include('dashboards.blocks.menu-new-product')
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
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                              Chọn sản phẩm
                            </button>
                            <ul class="dropdown-menu">
                              @foreach ($wareAll as $wall)
                                <li><a class="dropdown-item" href="{{ route('product_dashboard2', ['id'=>$wall->id]) }}">{{$wall->name_product}}</a></li>   
                              @endforeach
                            </ul>
                        </div>
                      <small class="text-muted float-end">Interior <span style="color: rgb(231, 171, 6)">CS</span></small>
                    </div>
                    {{-- <hr class="my-0 mb-3"> --}}
                    <div class="card-body mt-3 mb-3">
                      <form action="{{ route('add_product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Tên sản phẩm</label> {{--Lấy tên sản phẩm sẽ hiển thị ra tất cả dữ liệu--}}
                          <div class="col-sm-10">
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" value="{{$ware['name_product']}}" name="name_product">
                                <h5 class=" fw-lighter text-decoration-underline ps-2" style="font-style: oblique; color: #8284FF">
                                    {{$ware['name_product']}}</h5>
                              </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Loại sản phẩm</label>
                          <div class="col-sm-10">
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" value="{{$ware['name']}}" name="type_product">
                                <h5 class=" fw-lighter text-decoration-underline ps-2" style="font-style: oblique; color: #8284FF">
                                    {{$ware['name']}}</h5>
                              </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 form-label">Chất liệu</label>
                          <div class="col-sm-10">
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" value="{{$ware['material']}}" name="material">
                                <h5 class=" fw-lighter text-decoration-underline ps-2" style="font-style: oblique; color: #8284FF">
                                    {{$ware['material']}}</h5>
                              </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 form-label">Nhà sản xuất</label>
                          <div class="col-sm-10">
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" value="{{$ware['supplier']}}" name="supplier">
                                <h5 class=" fw-lighter text-decoration-underline ps-2" style="font-style: oblique; color: #8284FF">
                                    {{$ware['supplier']}}</h5>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 form-label">Hình ảnh</label>
                          <div class="col-sm-10 d-flex">
                            <div class="input-group input-group-merge me-2">
                              <span class="input-group-text"><i class='bx bx-image'></i></span>
                              <input type="file" class="form-control"  name="images"/>
                            </div>
                            <div class="input-group input-group-merge me-2">
                              <span class="input-group-text"><i class='bx bx-image'></i></span>
                              <input type="file" class="form-control"  name="images2"/>
                            </div>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class='bx bx-screenshot'></i></span>
                              <select name="size" class="form-select">
                                <option selected></option>
                                <option value="533x533">533 x 533</option>
                                <option value="533x757">533 x 757</option>
                                <option value="533x475">533 x 475</option>
                                <option value="533x641">533 x 641</option>
                                <option value="489x435">489 x 435</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 form-label">Màu sắc</label>
                          <div class="col-sm-5 d-flex">
                            <input type="color" name="color" value="#FFFFFF" class="form-control me-5">
                            <input type="checkbox" name="check_color" value="1" class="ms-3 me-2">
                            <input type="color" name="color2" value="#FFFFFF" class="form-control me-2">
                            <input type="color" name="color3" value="#FFFFFF" class="form-control">
                          </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 form-label">Giá tiền</label>
                            <div class="col-sm-10 d-flex">
                              <div class="input-group input-group-merge me-2">
                                <span class="input-group-text"><i class='bx bx-money'></i></span>
                                {{-- <input type="text" class="form-control" placeholder="Nhập giá tiền sản phẩm" name="price" id="currency-field"  data-type="currency"/> --}}
                                <input type="text" class="form-control" placeholder="Nhập giá tiền sản phẩm" name="price"/>
                              </div>
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class='bx bxs-discount'></i></span>
                                {{-- <input type="text" class="form-control" placeholder="Nhập giá tiền sản phẩm" name="price" id="currency-field"  data-type="currency"/> --}}
                                <input type="text" class="form-control" placeholder="Nhập % sale" name="sales"/>
                              </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Số lượng</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class='bx bx-archive'></i></span>
                              <input type="text" class="form-control" name="amount" placeholder="Nhập số lượng"/>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 form-label">Mô tả</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-comment"></i></span>
                                <textarea class="form-control" row="1"name="descriptions"></textarea>
                              </div>
                            </div>
                        </div>
                        @php
                            use Carbon\Carbon;
                            $timeNow = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                        @endphp
                        <input type="hidden" name="date" value="{{$timeNow}}">
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">Thêm sản phẩm</button>
                          </div>
                        </div>
                      </form>
                    </div>
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
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    {{-- <script src="{{ asset('dashboard\js\formatCurrence.js') }}"></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      @if (session()->has('product_sc'))
        <script>
          swal({
                title: "Mã SP: {{session()->get('product_sc')}}",
                text: "Thêm sản phẩm thành công",
                icon: "success",
                button: "OK",
                timer: 2000,
              });
        </script>
      @endif
      @if (session()->has('er_add_product'))
        <script>
          swal({
                title: "{{session()->get('er_add_product')}}",
                icon: "warning",
                button: "OK",
                timer: 1000,
              });
        </script>
      @endif
  </body>
</html>
