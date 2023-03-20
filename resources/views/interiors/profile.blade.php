<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    @include('interiors.blocks.header')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    {{-- @php
        use Carbon\Carbon;
        Carbon::setLocale('vi'); // hiển thị ngôn ngữ tiếng việt.
        $dt = Carbon::create($date_bill);
        $time = Carbon::now('Asia/Ho_Chi_Minh');
        $dt_create = $dt->diffForHumans($time); // khoảng cách thời gian
    @endphp --}}
    <!-- Search Wrapper Area Start -->
    @include('interiors.blocks.search')
    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">
        @include('interiors.blocks.mobile-nav')
        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            @include('interiors.blocks.logo')
            <nav class="amado-nav">
                <ul>
                    <li><a href="{{route('index')}}">Trang chủ</a></li>
                    <li><a href="{{ route('product') }}">Sản phẩm</a></li>
                    <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                    <li><a href="{{ route('cart') }}">Giỏ hàng</a></li>
                    <li><a href="{{ route('review') }}">Đánh giá</a></li>
                </ul>
            </nav>
            <!-- Button Group -->
            <!-- Cart Menu -->
            @include('interiors.blocks.nav_btn')
            <!-- Social Button -->
        </header>
        <!-- Header Area End -->

        <!-- Product Details Area Start -->
        <div class="single-product-area section-padding-0-100 clearfix">
            <div class="container-fluid fontCSI">
                    <div class="ml-100 mt-100 d-flex">
                        <div class="container">
                            <div class="ml-0 ">
                                <div class="d-flex">
                                    <div class="mr-0 d-flex">
                                        <p class="fpCSI mr-5"><i class='bx bxs-user-rectangle text-dark'></i> <span class="text-secondary">{{ Auth::user()->name }}</span></p>
                                        <p class="fpCSI mr-5"><i class='bx bxl-gmail text-dark' ></i> <span class="text-secondary">{{ Auth::user()->email }}</span></p>
                                        <p class="fpCSI mr-5"><i class='bx bxs-spa text-dark' ></i> <span class="text-secondary">{{ Auth::user()->sex_user }}</span></p>
                                        <p class="fpCSI mr-5"><i class='bx bxs-phone text-dark' ></i> <span class="text-secondary">{{ Auth::user()->phone }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-0">
                                <p class="fpCSI text-dark">Địa chỉ: <span class="text-secondary">{{ Auth::user()->district.', '.Auth::user()->city.', '.Auth::user()->province}}</span></p>
                            </div>
                        </div>
                        <div class="text-center mr-5 d-flex">
                            <a href="{{ route('update_profile') }}" class="mr-2">
                                <button class="btn btn-outline-info btn-sm">Cập nhật thông tin</button>
                            </a>
                        </div>
                    </div>
                    <div class="row container mt-4">
                        {{-- <h1>Hóa đơn</h1> --}}
                        <table class="table table-bordered table-responsive-sm table-hover">
                            <thead>
                              <td colspan="8" class="text-center"><h3 style="font-family: 'Dancing Script';" class="text-warning">Danh sách đơn hàng</h3></td>
                              <tr>
                                <th>Mã đơn</th>
                                <th>Mã SP</th>
                                <th>Số lượng</th>
                                <th>Giá sản phẩm</th>
                                <th>Phương thức</th>
                                <th>Địa chỉ nhận</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $item)
                                <tr>
                                    <td>{{$item->id_bill}}</td>
                                    <td>{{$item->id_product}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td>{{number_format($item->price)}}&#8363;</td>
                                    <td>{{$item->method}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{number_format($item->total)}}&#8363;</td>
                                    @if ($item->status_product_bill == "1")
                                        <td>
                                            <div class="d-flex">
                                                <a class="stt_b1 mr-1" href="#">
                                                    Đang lấy hàng
                                                </a>
                                                <a class="stt_b5" href="{{ route('destroy_donhang_dashboard', ['id'=>$item->id_bill]) }}">
                                                    Hủy đơn
                                                </a>
                                            </div>
                                        </td>
                                    @elseif($item->status_product_bill == "2")
                                        <td>
                                            <div class="d-flex">
                                                <a class="stt_b2 mr-1" href="#">
                                                    Đang giao hàng
                                                </a>
                                                <a class="stt_b5" href="{{ route('destroy_donhang_dashboard', ['id'=>$item->id_bill]) }}">
                                                    Hủy đơn
                                                </a>
                                            </div>
                                        </td>
                                    @elseif($item->status_product_bill == "3")
                                        <td>
                                            <a class="stt_b3" href="{{ route('ship_done', ['id'=>$item->id_bill]) }}">
                                                Xác nhận lấy hàng
                                            </a>
                                        </td>
                                    @else
                                        <td>
                                            <a class="stt_b4" href="#">
                                                Thành công
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <td colspan="4">Ngày tạo: {{Carbon::parse($date_bill)->format('d-m-Y')}}</td>
                                    <td colspan="2" class="text-center">Tổng tiền: {{number_format($item->total)}}&#8363;</td>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- Pagination -->
                            <nav aria-label="navigation">
                                <div class="pagination justify-content-center mt-10">
                                    {{$bills->links()}}
                                </div>
                            </nav>
                        </div>
                    </div>
            </div>
        </div>
        <!-- Product Details Area End -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->
    @include('interiors.blocks.footer')

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="{{ asset('interior/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('interior/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('interior/js/bootstrap.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('interior/js/plugins.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('interior/js/active.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
    @if (session()->has('update_sc'))
      <script>
        swal({
              title: "{{session()->get('update_sc')}}",
              icon: "success",
              button: "OK",
              timer: 2000,
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