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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Slide/</span> Chọn sản phẩm hiển thị
                <div class="btn-group ms-2">
                  <button
                    type="button"
                    class="btn btn-primary btn-sm dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    Position 0
                  </button>
                  <div class="dropdown-menu dropdown-menu-center w-px-500">
                    <form class="p-4" action="{{ route('add_position_0') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="..."
                          name="title"
                        />
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea name="des" rows="3" class="form-control"></textarea>
                      </div>
                      <div class="mb-3">
                        <input class="form-control" type="file" name="images"/>
                      </div>
                      <button type="submit" class="btn btn-success btn-sm">Xác nhận</button>
                    </form>
                  </div>
                </div>
              </h4>
              <!-- Basic Layout & Basic with Icons -->
              <div class="row">
                <!-- Basic with Icons -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">{{--Lấy tên sản phẩm sẽ hiển thị ra tất cả dữ liệu--}}
                          <div class="col-sm-10 d-flex ms-5">
                            @php
                                for($slp = 1; $slp <=9; $slp++){
                                  echo '<div class="btn-group">';
                                  echo '<button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle me-4" data-bs-toggle="dropdown" aria-expanded="false">Position '.$slp.'</button>';
                                  echo '<ul class="dropdown-menu">';
                                  foreach($sl_position400 as $products){
                                    echo '<li><a class="dropdown-item d-flex" href="'.route('slide2', ['id'=>$products->id, 'size'=>$products->size, 'position'=>$slp]) .'"><p>'.$products->id_product.'&nbsp;</p></a></li>';
                                  }
                                  echo '</ul></div>';
                                }
                            @endphp
                            {{-- <div class="btn-group">
                              <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle me-4" data-bs-toggle="dropdown" aria-expanded="false">Position 1</button>
                              <ul class="dropdown-menu">
                                @foreach ($p1 as $products)
                                  <li><a class="dropdown-item d-flex" href="{{ route('slide2', ['id'=>$products->id, 'size'=>$products->size, 'position'=>1]) }}"><p>{{$products->id_product}}&nbsp;</p><span class="fst-italic fw-lighter">&nbsp;_{{$products->size}}</span></a></li>   
                                @endforeach
                              </ul>
                            </div> --}}
                            
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="table-responsive text-nowrap">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">MSP</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Tên sản phẩm</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Loại sản phẩm</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Giá tiền</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Hình ảnh</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Vị trí</th>
                            {{-- <th style="color: rgb(231, 171, 6);font-size: 14px">Ghi chú</th> --}}
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($slide as $slides)
                          <tr>
                            <td>{{$slides->id_product}}</td>
                            <td>{{$slides->name_product}}</td>
                            <td>{{$slides->type_product}}</td>
                            <td>{{number_format($slides->price)}} &#8363;</td>
                            <td>
                              <img src="{{ asset('dashboard\upload_img\product/'.$slides->images) }}" alt="" style="max-width: 55px;max-height: 47px">
                            </td>
                            <td>{{$slides->position}}</td>
                            {{-- <td>{{$slides->descriptions}}</td> --}}
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
