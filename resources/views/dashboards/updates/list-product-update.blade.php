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
  {{-- loader --}}
      <link rel="stylesheet" href="{{ asset('interior/fakeloader/src/fakeloader.css') }}">
  </head>
    <body>
    @include('dashboards.blocks.fakeload')
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
                      <small class="text-muted float-start">Mã sản phẩm: <span style="color: rgb(231, 171, 6)">{{$product['id_product']}}</span></small>
                      <small class="text-muted float-end">Interior <span style="color: rgb(231, 171, 6)">CS</span></small>
                    </div>
                    {{-- <hr class="my-0 mb-3"> --}}
                    <div class="card-body mt-3 mb-3">
                      <form action="{{ route('udpate_product', ['id'=>$product['id']]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Tên sản phẩm</label> {{--Lấy tên sản phẩm sẽ hiển thị ra tất cả dữ liệu--}}
                          <div class="col-sm-10">
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" value="{{$product['name_product']}}" name="name_product">
                                <h5 class=" fw-lighter text-decoration-underline ps-2" style="font-style: oblique; color: #8284FF"
                                  data-bs-toggle="tooltip"
                                  data-bs-offset="0,4"
                                  data-bs-placement="top"
                                  data-bs-html="true"
                                  title="<span>LSP: {{$product['type_product']}}</h5></span><br><span>CL: {{$product['material']}}</h5></span><br><span>NSX: {{$product['supplier']}}</h5></span>"
                                >
                                    {{$product['name_product']}}
                                </h5>
                                <input type="hidden" class="form-control" value="{{$product['type_product']}}" name="type_product">
                                  <input type="hidden" class="form-control" value="{{$product['material']}}" name="material">
                                  <input type="hidden" class="form-control" value="{{$product['supplier']}}" name="supplier">    
                              </div>
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Loại sản phẩm</label>
                          <div class="col-sm-10">
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" value="{{$product['type_product']}}" name="type_product">
                                <h5 class=" fw-lighter text-decoration-underline ps-2" style="font-style: oblique; color: #8284FF">
                                    {{$product['type_product']}}</h5>
                              </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 form-label">Chất liệu</label>
                          <div class="col-sm-10">
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" value="{{$product['material']}}" name="material">
                                <h5 class=" fw-lighter text-decoration-underline ps-2" style="font-style: oblique; color: #8284FF">
                                    {{$product['material']}}</h5>
                              </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 form-label">Nhà sản xuất</label>
                          <div class="col-sm-10">
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" value="{{$product['supplier']}}" name="supplier">
                                <h5 class=" fw-lighter text-decoration-underline ps-2" style="font-style: oblique; color: #8284FF">
                                    {{$product['supplier']}}</h5>
                            </div>
                          </div>
                        </div> --}}
                        <div class="row mb-3">
                          <label class="col-sm-2 form-label">Hình ảnh</label>
                          <div class="col-sm-10 d-flex">
                            <div class="input-group input-group-merge me-2">
                              <span class="input-group-text"><i class='bx bx-image'></i></span>
                              <input type="file" class="form-control phone-mask"  name="images"/>
                            </div>
                            <input type="hidden" value="{{$product['images']}}" name="images_c"/>
                            <div class="input-group input-group-merge me-2">
                              <span class="input-group-text"><i class='bx bx-image'></i></span>
                              <input type="file" class="form-control phone-mask"  name="images2"/>
                            </div>
                            <input type="hidden" value="{{$product['images2']}}"  name="images2_c"/>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class='bx bx-screenshot'></i></span>
                              <select name="size" class="form-select">
                                <option selected value="{{$product['size']}}">{{$product['size']}}</option>
                                <option value="Position400">Position 1-9 (xy ~ 400px)</option>
                                <option value="Position1296">Position 0 (1296 x 524px)</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          @php
                              $explode = explode(', ', $product['color']);
                              $count = count($explode);
                          @endphp
                          <label class="col-sm-2 form-label">Màu sắc</label>
                          <div class="col-sm-5 d-flex">
                            @if ($count == 1)
                              <input type="color" name="color" value="{{ $explode[0] }}" class="form-control">
                            @elseif($count == 2)
                              <input type="color" name="color" value="{{ $explode[0] }}" class="form-control me-2">
                              <input type="color" name="color2" value="{{ $explode[1] }}" class="form-control me-2">
                            @else
                              <input type="color" name="color" value="{{ $explode[0] }}" class="form-control me-2">
                              <input type="color" name="color2" value="{{ $explode[1] }}" class="form-control me-2">
                              <input type="color" name="color3" value="{{ $explode[2] }}" class="form-control">
                            @endif
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 form-label">Giá tiền</label>
                          <div class="col d-flex">
                            <div class="input-group input-group-merge me-2">
                              <span class="input-group-text"><i class='bx bx-money'></i></span>
                              {{-- <input type="text" class="form-control" placeholder="Nhập giá tiền sản phẩm" name="price" id="currency-field"  data-type="currency"/> --}}
                              <input type="text" class="form-control" value="{{$product['price']}}" name="price"/>
                            </div>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class='bx bxs-discount'></i></span>
                              {{-- <input type="text" class="form-control" placeholder="Nhập giá tiền sản phẩm" name="price" id="currency-field"  data-type="currency"/> --}}
                              <input type="text" class="form-control"  name="sales1"/>
                            </div>
                            <input type="hidden" class="form-control" value="{{$product['sales']}}" name="sales2"/>
                          </div>
                      </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label">Số lượng</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <span class="input-group-text"><i class='bx bx-archive'></i></span>
                              <input type="text" class="form-control" name="amount" value="{{$product['amount']}}"/>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 form-label">Mô tả</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-comment"></i></span>
                                <textarea class="form-control" row="1"name="descriptions">{{$product['descriptions']}}</textarea>
                              </div>
                            </div>
                        </div>
                        @php
                            use Carbon\Carbon;
                            $timeNow = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                        @endphp
                        <input type="hidden" name="date" value="{{$product['date']}}">
                        <div class="row mb-3 ">
                          <label class="col-sm-2 col-form-label"></label>
                          <div class="col-sm-10">
                            <input type="checkbox" name="check_expense" value="1"/> Cập nhật số lượng vào chi phí
                          </div>
                        </div>
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">Cập nhật</button>
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
    @include('dashboards.blocks.foo')
  </body>
</html>
