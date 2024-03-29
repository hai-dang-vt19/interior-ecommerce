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
          @include('dashboards.blocks.menu-z-discount');
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Discount / </span>Danh sách mã giảm giá
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
                        <h5 class="modal-title" id="exampleModalLabel1">Thêm mã giảm giá</h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <form action="{{ route('add_discount') }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="row mb-3">
                              {{-- <label class="col-sm-2 col-form-label"></label> --}}
                              <div>
                                <div class="input-group input-group-merge">
                                  <span class="input-group-text col-2">Mã giảm: </span>
                                  <input type="text" class="form-control" name="name_discount" placeholder="CSI_20"/>
                                </div>
                              </div>
                            </div>
                            <div class="row mb-3">
                              {{-- <label class="col-sm-2 col-form-label"></label> --}}
                              <div>
                                <div class="input-group input-group-merge">
                                  <span class="input-group-text col-2">Discount: </span>
                                  <input type="text" class="form-control" name="price" placeholder="%"/>
                                </div>
                              </div>
                            </div>
                            <div class="row mb-3">
                              {{-- <label class="col-sm-2 col-form-label"></label> --}}
                              <div>
                                <div class="input-group input-group-merge">
                                  <span class="input-group-text col-3">Trạng thái</span>
                                  <select class="select2 form-select" name="status_discount">
                                    {{-- <option selected disabled> </option> --}}
                                    @foreach ($status as $stt)
                                      <option value="{{$stt->name_status}}">{{$stt->name_status}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                            {{-- <div class="row mb-3 fs-6 px-3">
                              
                              <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" value="1" id="checkSendMail" name="checkSendMail"/>
                                <label class="form-check-label" for="checkSendMail"
                                  >Gửi cho khách</label
                                >
                              </div>

                            </div> --}}
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
              <!-- Responsive Table -->
              <div class="card">
                <div class="card-body">
                  <div>
                    <div class="table-responsive text-nowrap">
                      <table class="table table-hover table-dark">
                        <thead>
                          <tr>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">STT</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">ID</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Mã</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Discount</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Trạng thái</th>
                            @can('admin')
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Chức năng</th>
                            @endcan
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($discount as $key => $disc)
                          <tr>
                            <th>{{$key +1}}</th>
                            <td style="color: gold">{{$disc->id}}</td>
                            <td>{{$disc->name_discount}}</td>
                            <td>{{$disc->price}}%</td>
                            <td>{{$disc->status_discount}}</td>
                            @can('admin')
                            <td>
                              <a href="{{ route('edit_discount_dashboard', ['id'=>$disc->id]) }}" class="btn btn-primary btn-sm"><i class='bx bxs-edit'></i></a>
                              <a onclick="return confirm('Bạn có chắc chắn xóa không?')"  href="{{ route('destroy_discount', ['id'=>$disc->id]) }}" class="btn btn-danger btn-sm"><i class='bx bx-trash-alt'></i></a>
                            </td>
                            @endcan
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <small class="text-muted float-end">Interior <span style="color: rgb(231, 171, 6)">CS</span></small>
                  <div class="d-flex mt-3">
                    {{$discount->links()}}
                  </div>
                </div>
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
    @if (session()->has('discount_sc'))
      <script>
        swal({
              title: "{{session()->get('discount_sc')}}",
              text: "Tạo thành công",
              icon: "success",
              button: "OK",
              timer: 20000,
            });
      </script>
    @endif
    @if (session()->has('update_discount_sc'))
    <script>
      swal({
            title: "{{session()->get('update_discount_sc')}}",
            text: "Cập nhật thành công",
            icon: "success",
            button: "OK",
            timer: 20000,
          });
    </script>
    @endif
    @if (session()->has('discount_ds'))
    <script>
      swal({
            title: "{{session()->get('discount_ds')}}",
            text: "Xóa thành công",
            icon: "success",
            button: "OK",
            timer: 20000,
          });
    </script>
    @endif
    @include('dashboards.blocks.foo')
  </body>
</html>
