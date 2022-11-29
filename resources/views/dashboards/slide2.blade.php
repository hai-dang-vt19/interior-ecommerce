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
          @include('dashboards.blocks.menu-slide')
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
                  <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..."
                  />
                </div>
              </div>
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
                                @foreach ($allProduct as $allp)
                                <li><a class="dropdown-item" href="{{ route('slide2', ['id'=>$allp->id]) }}">{{$allp->name_product}}</a></li>   
                                @endforeach
                            </ul>
                        </div>
                      <small class="text-muted float-end">Interior <span style="color: rgb(231, 171, 6)">CS</span></small>
                    </div>
                    {{-- <hr class="my-0 mb-3"> --}}
                    <div class="card-body mt-3 mb-3">
                      <form action="{{ route('add_slide') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Mã sản phẩm</label>
                            <div class="col-sm-10">
                                <input type="text" disabled class="form-control" value="{{$product['id_product']}}">
                                <input type="hidden" value="{{$product['id_product']}}" name="id_product">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Tên sản phẩm</label>
                            <div class="col-sm-10">
                                <input type="text" disabled class="form-control" value="{{$product['name_product']}}">
                                <input type="hidden" value="{{$product['name_product']}}" name="name_product">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Loại sản phẩm</label>
                            <div class="col-sm-10">
                                <input type="text" disabled class="form-control" value="{{$product['type_product']}}">
                                <input type="hidden" value="{{$product['type_product']}}" name="type_product">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Giá tiền</label>
                            <div class="col-sm-10">
                                <input type="text" disabled class="form-control" value="{{number_format($product['price'])}}">
                                <input type="hidden" value="{{$product['price']}}" name="price">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Ảnh</label>
                            <div class="col-sm-10">
                                <input type="text" disabled class="form-control" value="{{$product['images']}}">
                                <input type="hidden" value="{{$product['images']}}" name="images">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Vị trí</label>
                            <div class="col-sm-10">
                                <select name="position" class="select form-select">
                                    <option value="1">Slide 1</option>
                                    <option value="2">Slide 2</option>
                                    <option value="3">Slide 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Ghi chú</label>
                            <div class="col-sm-10">
                                <textarea disabled class="form-control" rows="1">{{$product['descriptions']}}</textarea>
                                <input type="hidden" name="descriptions" value="{{$product['descriptions']}}">
                            </div>
                        </div>
                        
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">Thêm slide</button>
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
                            <th style="color: rgb(231, 171, 6);font-size: 14px">STT</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">MSP</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Tên sản phẩm</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Loại sản phẩm</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Giá tiền</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Hình ảnh</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Vị trí</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Ghi chú</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($slide as $key => $slides)
                          <tr>
                            <td scope="row">{{$key+1}}</td>
                            <td>{{$slides->id_product}}</td>
                            <td>{{$slides->name_product}}</td>
                            <td>{{$slides->type_product}}</td>
                            <td>{{number_format($slides->price)}} &#8363;</td>
                            <td>{{$slides->images}}</td>
                            <td>{{$slides->position}}</td>
                            <td>{{$slides->descriptions}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
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
      @if (session()->has('slide_sc'))
        <script>
          swal({
                title: "{{session()->get('slide_sc')}}",
                icon: "success",
                button: "OK",
                timer: 2000,
              });
        </script>
      @endif
  </body>
</html>
