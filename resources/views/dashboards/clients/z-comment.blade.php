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
          @include('dashboards.blocks.menu-z-comment');
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
          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Comment / </span>Danh sách nhận xét</h4>
            <!-- Responsive Table -->
            
            <div class="card">
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">STT</th>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">Thông tin khách</th>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">Điểm</th>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">Nội dung</th>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">Mã sản phẩm</th>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">Hình ảnh</th>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">Ngày tạo</th>
                      <th style="color: rgb(231, 171, 6);font-size: 14px">Chức năng</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($comment as $key => $item)
                      {{-- Modal send phản hổi khách hàng --}}
                      <form action="" method="POST">
                        <div class="modal fade" id="modal{{$item->id}}" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalScrollableTitle">Liên hệ khách hàng</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                <div class="row g-2">
                                  <div class="col mb-0">
                                    <label for="emailBackdrop" class="form-label">Khách hàng</label>
                                    <input
                                      type="text"
                                      id="emailBackdrop"
                                      class="form-control"
                                      value="{{ $item->name }}"
                                      name="userName"
                                    />
                                  </div>
                                  <div class="col mb-0">
                                    <label for="dobBackdrop" class="form-label">Email</label>
                                    <input
                                      type="text"
                                      id="dobBackdrop"
                                      class="form-control"
                                      value="{{ $item->email }}"
                                      name="userEmail"
                                    />
                                  </div>
                                </div>
                                <hr>
                                <div class="row">
                                  <div class="col mb-3">
                                    <textarea class="form-control" style="text-align: justify;" name="description" id="nameBackdrop" cols="30" rows="10" placeholder="Nhập nội dung tại đây">Thực lòng xin lỗi ông vì đã để ông phải dành thời gian vì sản phẩm của chúng tôi. Điều này sẽ được khắc phục, và tôi hoàn toàn hiểu được điều đó gây thất vọng cho ông như thế nào. Chúng tôi sẽ cố gắng đảm bảo cho mỗi khách hàng đều hài lòng về sản phẩm của chúng tôi. Chúng tôi xin lỗi về những bất tiện đã gây ra ông, hãy cho chúng tôi biết nếu ông còn những câu hỏi hoặc sự quan tâm nào với sản phẩm của chúng tôi.</textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary">Send mail</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                      {{-- Modal --}}
                      <tr>
                        <th scope="row">{{ $key+1 }}</th>
                        <td>
                          <i class='bx bxs-user'></i>:&nbsp;&nbsp;{{ $item->name }} <br> 
                          <i class='bx bxs-envelope' ></i>:&nbsp;&nbsp;{{ $item->email }} <br> 
                          <i class='bx bxs-phone' ></i>:&nbsp;&nbsp;{{ $item->phone }}
                        </td>
                        <td class="text-center">
                          @if ($item->status_comment < '3')
                              <p class="rounded-pill bg-danger px-1 mt-2" style="color: #fff;">{{$item->status_comment}}</p>
                            @else
                              <p class="rounded-pill bg-success px-1 mt-2" style="color: #fff;">{{$item->status_comment}}</p>
                          @endif
                        </td>
                        <td>{{ $item->descriptions }}</td>
                        <td>{{ $item->id_product }}</td>
                        <td>
                          <img src="{{ asset('dashboard\upload_img\product/'.$item->img) }}" alt=""  style="max-width: 55px;max-height: 47px">
                        </td>
                        <td>{{ $item->date_create }}</td>
                        <td>
                          <button class="btn btn-info btn-sm rounded-3" data-bs-toggle="modal" data-bs-target="#modal{{$item->id}}" title="Liên hệ qua mail"><i class='bx bx-mail-send' ></i></button>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <small class="text-muted float-end">Interior <span style="color: rgb(231, 171, 6)">CS</span></small>
            <div class="d-flex mt-2">
              {{ $comment->links() }}
            </div>
            <!--/ Responsive Table -->
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
