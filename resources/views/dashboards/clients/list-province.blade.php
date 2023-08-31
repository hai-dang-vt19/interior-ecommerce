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
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/multi-select.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <!-- Page CSS -->
    <!-- Helpers -->
    <script src="{{ asset('dashboard/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('dashboard/assets/js/config.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/multi-select.js') }}"></script>
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
          @include('dashboards.blocks.menu-list-province');
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
            <div class="container flex-grow-1 container-p-y">
              {{-- <a href="{{ route('test_api_map') }}">Test</a> --}}
              <div class="row">
                <div class="col-xl">
                  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">City / </span>Danh sách Thành phố
                    @can('admin')
                    <button
                    type="button"
                    class="btn btn-primary btn-sm ms-2"
                    data-bs-toggle="modal"
                    data-bs-target="#basicModal"
                    title="Thêm mới"
                    >
                      <i class='bx bx-plus-medical bx-burst-hover bx-xs'></i>
                    </button>
    
                    <!-- Modal -->
                    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Thêm thành phố</h5>
                            <button
                              type="button"
                              class="btn-close"
                              data-bs-dismiss="modal"
                              aria-label="Close"
                            ></button>
                          </div>
                          <form action="{{ route('add_city') }}" method="POST">
                            <div class="modal-body">
                                @csrf
                                <div class="mb-3">
                                  <label class="col-form-label">Chọn Tỉnh</label>
                                  <div class="col">
                                    <select name="city_province" class="form-control" id="choices-multiple-remove-button">
                                      <option selected disabled></option>
                                      @foreach ($select_province as $slt_pro)
                                          <option value="{{$slt_pro->name_province}}">{{$slt_pro->name_province}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-3">
                                  {{-- <label class="form-label"></label> --}}
                                  <div class="input-group input-group-merge">
                                    <span class="input-group-text col-3">
                                      Thành phố:
                                    </span>
                                    <input type="text" class="form-control" name="name_city" placeholder="Việt Trì"/>
                                  </div>
                                </div>
                                <div>
                                  {{-- <label class="form-label"></label> --}}
                                  <div class="input-group input-group-merge">
                                    <span class="input-group-text col-3">
                                      Khoảng cách
                                    </span>
                                    <input type="text" class="form-control" name="klm" placeholder="km"/>
                                  </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Hủy
                              </button>
                              <button type="submit" class="btn btn-success">Xác nhận</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    @endcan
                  </h4>
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive text-nowrap mt-4">
                        <table class="table table-hover  ">
                          <thead>
                            <tr>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Mã thành phố</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Tên thành phố</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Tên tỉnh</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Giá tiền</th>
                              @can('admin')
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Chức năng</th>
                              @endcan
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($city as $cty)
                              <tr>
                                <td>{{$cty->id}}</td>
                                <td>{{$cty->name_city}}</td>
                                <td>{{$cty->city_province}}</td>
                                <td>{{number_format($cty->price)}}</td>
                                @can('admin')
                                <td>
                                  <a href="{{ route('edit_city_dashboard', ['id'=>$cty->id]) }}" class="btn btn-primary btn-sm"><i class='bx bxs-edit'></i></a>
                                  <a onclick="return confirm('Bạn có chắc chắn xóa không?')"  href="{{ route('destroy_city', ['id'=>$cty->id]) }}" class="btn btn-danger btn-sm"><i class='bx bx-trash-alt'></i></a>
                                </td>
                                @endcan
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <small class="text-muted float-end">Interior <span style="color: rgb(231, 171, 6)">CS</span></small>
                  <div class="d-flex mt-3">
                    {{$city->links()}}
                  </div>
                </div>
                <div class="col-xl">
                  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Province / </span>Danh sách Tỉnh lẻ
                    @can('admin')
                    <button
                    type="button"
                    class="btn btn-primary btn-sm ms-2"
                    data-bs-toggle="modal"
                    data-bs-target="#basicModal2"
                    title="Thêm mới"
                    >
                      <i class='bx bx-plus-medical bx-burst-hover bx-xs'></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="basicModal2" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Thêm tỉnh</h5>
                            <button
                              type="button"
                              class="btn-close"
                              data-bs-dismiss="modal"
                              aria-label="Close"
                            ></button>
                          </div>
                          <form action="{{ route('add_province') }}" method="POST">
                            <div class="modal-body">
                                @csrf
                                <div>
                                  {{-- <label class="form-label"></label> --}}
                                  <div class="input-group input-group-merge">
                                    <span class="input-group-text col-2">
                                      Tên tỉnh:
                                    </span>
                                    <input type="text" class="form-control" name="name_province" placeholder="Phú Thọ"/>
                                  </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Hủy
                              </button>
                              <button type="submit" class="btn btn-success">Xác nhận</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    @endcan
                  </h4>
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive text-nowrap mt-4">
                        <table class="table table-hover  ">
                          <thead>
                            <tr>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Mã tỉnh</th>
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Tên tỉnh</th>
                              @can('admin')
                              <th style="color: rgb(231, 171, 6);font-size: 14px">Chức năng</th>
                              @endcan
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($province as $pro)
                            <tr>
                              <td>{{$pro->id}}</td>
                              <td>{{$pro->name_province}}</td>
                              @can('admin')
                              <td>
                                <a href="{{ route('edit_province_dashboard', ['id'=>$pro->id]) }}" class="btn btn-primary btn-sm"><i class='bx bxs-edit'></i></a>
                                <a onclick="return confirm('Bạn có chắc chắn xóa không?')"  href="{{ route('destroy_province', ['id'=>$pro->id]) }}" class="btn btn-danger btn-sm"><i class='bx bx-trash-alt'></i></a>
                              </td>
                              @endcan
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <small class="text-muted float-end">Interior <span style="color: rgb(231, 171, 6)">CS</span></small>
                  <div class="d-flex mt-3">
                    {{$province->links()}}
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
    @if (session()->has('province_sc'))
      <script>
        swal({
              title: "{{session()->get('province_sc')}}",
              text: "Tạo thành công",
              icon: "success",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
    @if (session()->has('update_province_sc'))
      <script>
        swal({
              title: "{{session()->get('update_province_sc')}}",
              text: "Cập nhật thành công",
              icon: "success",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
    @if (session()->has('province_ds'))
      <script>
        swal({
              title: "{{session()->get('province_ds')}}",
              icon: "success",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
    @if (session()->has('city_sc'))
      <script>
        swal({
              title: "{{session()->get('city_sc')}}",
              text: "Tạo thành công",
              icon: "success",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
    @if (session()->has('update_city_sc'))
      <script>
        swal({
              title: "{{session()->get('update_city_sc')}}",
              text: "Cập nhật thành công",
              icon: "success",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
    @if (session()->has('city_ds'))
      <script>
        swal({
              title: "{{session()->get('city_ds')}}",
              icon: "success",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
    <script>
      $(document).ready(function(){
          var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
            maxItemCount:5,
            searchResultLimit:5,
            renderChoiceLimit:5
          }); 
      });
    </script>
    @include('dashboards.blocks.foo')
  </body>
</html>
