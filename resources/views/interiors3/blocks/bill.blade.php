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
    @php
        use Carbon\Carbon;
        Carbon::setLocale('vi'); // hiển thị ngôn ngữ tiếng việt.
        $dt = Carbon::create($date_bill);
        $time = Carbon::now('Asia/Ho_Chi_Minh');
        $dt_create = $dt->diffForHumans($time); // khoảng cách thời gian

    @endphp
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
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li><a href="{{ route('product') }}">Product</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <li><a href="{{ route('cart') }}">Cart</a></li>
                    <li><a href="{{ route('review') }}">Review</a></li>
                </ul>
            </nav>
            <!-- Button Group -->
            
            @include('interiors.blocks.nav_btn')
            <!-- Social Button -->
             
        </header>
        <!-- Header Area End -->

        <!-- Product Details Area Start -->
        <div class="single-product-area section-padding-0-100 clearfix">
            <div class="container-fluid fontCSI">
                @if ($done == "GD thành công")
                    <div class="row mt-100">
                        {{-- <h1>Hóa đơn</h1> --}}
                        <table class="table table-bordered table-responsive-sm table-hover">
                            <thead>
                                <tr>
                                    <th colspan="6" class="text-center bold">{{$vnp_TxnRef}}</th>
                                    {{-- <button onclick="window.print();" class="noPrint">
                                        Print
                                    </button> --}}
                                    <div>
                                        <a href="{{ route('print_bill', ['id'=>$vnp_TxnRef]) }}" class="d-flex"><h1>Hóa đơn</h1><i class='bx bx-printer'></i></a>
                                    </div>
                                </tr>
                              <tr>
                                <th scope="col">MSP</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá tổng sản phẩm</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($get_data_for_bill as $item)
                                <tr>
                                  <td>{{$item->id_product}}</td>
                                  <td>{{$item->name_product}}</td>
                                  <td>{{number_format($item->price)}}&#8363;</td>
                                  <td>{{$item->amount}}</td>
                                  <td>{{number_format($item->amount*$item->price)}}&#8363;</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">Ngày tạo: {{Carbon::parse($date_bill)->format('d-m-Y')}}</td>
                                    <td colspan="2" class="text-center">Tổng tiền: {{number_format($item->total)}}&#8363;</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="container">
                        <div class="row">
                          <div class="col">
                            <p class="fpCSI">Khách hàng: <span>{{$name_bill}}</span></p>
                            <p class="fpCSI">Email: <span>{{$email_bill}}</span></p>
                            <p class="fpCSI">SĐT: <span>{{$phone_bill}}</span></p>
                            <p class="fpCSI">Địa chỉ: <span>{{$address_bill}}</span></p>
                          </div>
                          <div class="col">
                            <p class="fpCSI">Ngân hàng: <span>{{$vnp_BankCode_bill}}</span></p>
                            <p class="fpCSI">Mã GD ngân hàng: <span>{{$vnp_BankTranNo_bill}}</span></p>
                            <p class="fpCSI">Mã GD VNPAY: <span>{{$vnp_TransactionNo_bill}}</span></p>
                            <p class="fpCSI">Loại thanh toán: <span>{{$vnp_CardType_bill}}</span></p>
                          </div>
                          <div class="col">
                            <p class="text-center">Hà Nội, {{'ngày '.Carbon::parse($date_bill)->day.', tháng '.Carbon::parse($date_bill)->month.', năm '.Carbon::parse($date_bill)->year}}</p>
                            <p class="mt-100 text-center font_i2">{{Auth::user()->name}}</p>
                          </div>
                        </div>
                    </div>
                @endif
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