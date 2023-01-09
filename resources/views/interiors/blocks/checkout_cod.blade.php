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
            <!-- Cart Menu -->
            @include('interiors.blocks.nav_btn')
            <!-- Social Button -->
             
        </header>
        <!-- Header Area End -->

        <!-- Product Details Area Start -->
        <div class="single-product-area section-padding-0-100 clearfix">
            <div class="container-fluid fontCSI">
                    <div class="row mt-100">
                        {{-- <h1>Hóa đơn</h1> --}}
                        <table class="table table-bordered table-responsive-sm table-hover">
                            <thead>
                                <tr>
                                    <th colspan="6" class="text-center bold">Đơn hàng</th>
                                    <div>
                                        <a href="{{ route('print_bill', ['id'=>1]) }}" class="d-flex"><h1>Thông tin</h1><i class='bx bx-printer'></i></a>
                                    </div>
                                </tr>
                              <tr>
                                <th scope="col">MSP</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Phụ phí</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá sản phẩm</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $item)
                                <tr>
                                  <td>{{$item->id_product}}</td>
                                  <td>{{$item->name_product}}</td>
                                  <td>{{number_format($phi)}}&#8363;</td>
                                  <td>{{$item->amount_product}}</td>
                                  @if ($item->sales == 0)
                                      <td>{{number_format($item->total)}}&#8363;
                                    </td>
                                  @else
                                      <td>{{number_format($item->total_sales)}}&#8363;</td>
                                  @endif
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                @php
                                    use Carbon\Carbon;
                                    $times = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                                    $id_bill = 'ICS0'.time().'COD';
                                @endphp
                                <tr>
                                    <td colspan="4">Ngày tạo: {{ $times }}</td>
                                    {{-- <td colspan="4">Ngày tạo: {{Carbon::parse($date_bill)->format('d-m-Y')}}</td> --}}
                                    <td colspan="2" class="text-center">Tổng tiền: {{number_format($total)}}&#8363;
                                        <form action="{{ route('checkout_cod_post') }}" method="POST">
                                            @csrf
                                            @foreach ($cart as $itm)
                                                <input type="hidden" value="{{ $id_bill }}" name="id_bill[]">
                                                <input type="hidden" value="{{ Auth::user()->name }}" name="username[]">
                                                <input type="hidden" value="{{ Auth::user()->email }}" name="email[]">
                                                <input type="hidden" value="{{ Auth::user()->phone }}" name="phone[]">
                                                <input type="hidden" value="{{ $times }}" name="date_create[]">
                                                <input type="hidden" value="COD" name="method[]">
                                                <input type="hidden" value="{{ Auth::user()->district.', '.Auth::user()->city.', '.Auth::user()->province }}" name="address[]">
                                                <input type="hidden" value="Xử lý" name="status_product_bill[]">

                                                <input type="hidden" value="{{ $itm->id_product }}" name="id_product[]">
                                                <input type="hidden" value="{{ $itm->name_product }}" name="name_product[]">
                                                <input type="hidden" value="{{ $phi }}">
                                                <input type="hidden" value="{{ $itm->amount_product }}" name="amount_product[]">
                                                @if ($itm->sales == 0)
                                                    <input type="hidden" value="{{ $itm->total }}" name="total[]">
                                                @else
                                                    <input type="hidden" value="{{ $itm->total_sales }}" name="total[]">
                                                @endif
                                            @endforeach
                                            <button type="submit">Xác nhận</button>
                                        </form>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="container">
                        <div class="row">
                          <div class="col">
                            <p class="fpCSI">Khách hàng: <span>{{ Auth::user()->name }}</span></p>
                            <p class="fpCSI">Email: <span>{{Auth::user()->email}}</span></p>
                            <p class="fpCSI">SĐT: <span>{{Auth::user()->phone}}</span></p>
                            <p class="fpCSI">Địa chỉ: <span>{{Auth::user()->district.', '.Auth::user()->city.', '.Auth::user()->province}}</span></p>
                            <p class="fpCSI">Loại thanh toán: <span>Ship COD</span></p>
                          </div>
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
</body>

</html>