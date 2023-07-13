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
    <script src="{{ asset('dashboard/assets/js/config.js') }}"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    {{-- loader --}}
      <link rel="stylesheet" href="{{ asset('interior/fakeloader/src/fakeloader.css') }}">
    
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/multi-select.css') }}" />
    <script src="{{ asset('dashboard/assets/js/multi-select.js') }}"></script>
  </head>
  <body>
    @include('dashboards.blocks.fakeload')
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
              <div class="mb-4">
                <form action="{{ route('create_bill_dashboard') }}" method="GET">
                  <div class="row">
                      {{-- <input type="text" class="form-control me-1" value="ICS" name="data" placeholder="Nhập mã"> --}}
                      <div class="col-md-4">
                        <select name="data" class="form-control me-1" id="choices-multiple-remove-button">
                          <option selected disabled></option>
                          @foreach ($product_slt as $pro)
                              <option value="{{$pro->id_product}}">{{$pro->id_product}} - {{$pro->name_product}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-3">
                        <Button class="btn btn-secondary">Check</Button>
                      </div>
                  </div>
                </form>
              </div>
              <div class="row">
                <!-- Basic with Icons -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-body mb-3">
                      <form action="{{ route('up_to_cart_dashboard') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach ($product as $item)
                          <div class="row container-xxl">
                            <div class="col-lg-8">
                              <dl class="row container">
                                <dt class="col-lg-3">Mã sản phẩm: </dt>
                                <dd class="col-lg-9">{{ $item->id_product }}</dd>
        
                                <dt class="col-lg-3">Tên sản phẩm: </dt>
                                <dd class="col-lg-9">
                                  {{ $item->name_product }} ( {{ $item->type_product }} )
                                </dd>
                                <dt class="col-lg-3">Số lượng: </dt>
                                <dd class="col-lg-9">
                                  <p>{{ $item->amount }}</p>
                                </dd>
        
                                <dt class="col-lg-3">Giá sản phẩm</dt>
                                <dd class="col-lg-9">{{ number_format($item->price) }} &#8363;</dd>
        
                                <dt class="col-lg-3 text-truncate">Giá sale: </dt>
                                <dd class="col-lg-9">
                                  <p>{{ number_format($item->sales) }} &#8363;</p>
                                </dd>
                                <dt class="col-lg-3 text-truncate">Số lượng mua </dt>
                                <dd class="col-lg-3">
                                  <input type="number" min="1" max="{{ $item->amount }}" value="1" class="form-control form-control-sm" name="amount_product">
                                </dd>
                              </dl>
                            </div>
                            <div class="col-lg-4 mb-1">
                              <img class="w-75 shadow rounded-pill" src="{{ asset('dashboard\upload_img\product/'.$item->images) }}" alt="">
                            </div>
                          </div>
                          <input type="hidden" class="form-control" value="{{ $item->id_product }}" name="id_product">
                          <input type="hidden" class="form-control" value="{{ $item->name_product }}" name="name_product">
                          @if (!empty($item->sales))
                            <input type="hidden" class="form-control" value="{{ $item->sales }}" name="price_product">                              
                          @else
                            <input type="hidden" class="form-control" value="{{ $item->price }}" name="price_product">
                          @endif
                          <input type="hidden" value="{{ $item->amount }}" name="amount_old">
                          <input type="hidden" value="{{ 'STORE-'.Auth::user()->user_id }}" name="id_cart_user">
                        @endforeach
                        @php
                            use Carbon\Carbon;
                            $timeNow = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                        @endphp
                        <input type="hidden" name="date_create" value="{{$timeNow}}">
                        <div class="container">
                          <button type="submit" class="btn btn-success">Thêm vào giỏ<i class='bx bxs-cart-add ms-2'></i></button>
                        </div>
                      </form>
                    </div>
                  </div>
                  
                  <div class="card">
                    <div class="table-responsive text-nowrap">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Mã giỏ</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Mã sản phẩm</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Tên sản phẩm</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Số lượng</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Giá sản phẩm</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px">Tổng tiền</th>
                            <th style="color: rgb(231, 171, 6);font-size: 14px"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($cart as $crt)
                          <tr>
                            <td>{{ $crt->id_cart_user }}</td>
                            <td>{{ $crt->id_product }}</td>
                            <td>{{ $crt->name_product }}</td>
                            <td>{{ $crt->amount_product }}</td>
                            <td>{{number_format($crt->price_product)}} &#8363;</td>
                            <td>{{number_format($crt->total_sales)}} &#8363;</td>
                            <td>
                              <a href="{{ route('drestroy_cart_dashboad', ['id'=>$crt->id, 'id_product'=>$crt->id_product, 'amount'=>$crt->amount_product]) }}" class="text-danger">
                                <i class='bx bx-x bx-sm'></i>
                              </a>
                            </td>
                          </tr>
                          @endforeach
                          <form action="{{ route('pay_store', ['total_cart'=>$sum_cart]) }}" method="POST">@csrf
                            <tr class="table-dark">
                              {{-- <td colspan="3">Tổng đơn:&ensp; <span class="text-primary">{{number_format($sum_cart)}} &#8363;</span></td> --}}
                              <td colspan="2">
                                <input type="text" class="form-control form-control-sm" placeholder="Nhập số điện thoại" name="phone" required>
                              </td>
                              <td></td>
                              <td colspan="3">
                                <span>Phương thức thanh toán</span>
                              </td>
                              <td></td>
                            </tr>
                            <tr class="table-dark">
                              {{-- <td colspan="2">
                                <input type="text" class="form-control form-control-sm">
                              </td> --}}
                              <td colspan="2">Tổng đơn:&ensp; <span class="text-primary">{{number_format($sum_cart)}} &#8363;</span></td>
                              <td>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="checkMethod" value="1" id="tienmat" checked/>
                                  <label class="form-check-label" for="tienmat"> Tiền mặt </label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="checkMethod" value="2" id="vnpayatm" />
                                  <label class="form-check-label" for="vnpayatm"> VNPAY ATM </label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="checkMethod" value="3" id="vnpayqr" />
                                  <label class="form-check-label" for="vnpayqr"> VNPAY QR </label>
                                </div>
                              </td>
                              <td colspan="2">
                                <button type="submit" class="btn btn-warning btn-sm w-75" name="redirect">
                                  Thanh toán
                                </button>
                              </td>
                            </tr>
                          </form>
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
                          <form action="{{ route('pay_store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="total_store" value="{{ $sum_cart }}">
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
    <script src="{{ asset('dashboard/assets/js/form-basic-inputs.js') }}"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    {{-- <script src="{{ asset('dashboard\js\formatCurrence.js') }}"></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      
      @if (session()->has('er'))
        <script>
          swal({
                title: "{{session()->get('er')}}",
                icon: "warning",
                button: "OK",
                timer: 2000,
              });
        </script>
      @endif
      @if (session()->has('fail'))
        <script>
          swal({
                title: "{{session()->get('fail')}}",
                icon: "warning",
                button: "OK",
                timer: 2000,
              });
        </script>
      @endif
      @if (session()->has('gd'))
        <script>
          swal({
                title: "{{session()->get('gd')}}",
                icon: "success",
                button: "OK",
                timer: 2000,
              });
        </script>
      @endif
      <script>
        $(document).ready(function(){
            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
              removeItemButton: true,
              maxItemCount:8,
              searchResultLimit:8,
              renderChoiceLimit:8
            }); 
        });
      </script>
      @include('dashboards.blocks.foo')
  </body>
</html>
