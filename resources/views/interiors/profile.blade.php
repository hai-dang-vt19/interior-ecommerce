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
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li><a href="{{ route('product') }}">Product</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <li><a href="{{ route('cart') }}">Cart</a></li>
                    <li><a href="{{ route('review') }}">Review</a></li>
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
                    <div class="row ml-100 mt-100">
                        <div class="container">
                            <div class="row ml-30 ">
                                <div class="d-flex">
                                    <div class="mr-50">
                                        <p class="fpCSI">Khách hàng: <span>{{ Auth::user()->name }}</span></p>
                                        <p class="fpCSI">Email: <span>{{ Auth::user()->email }}</span></p>
                                    </div>
                                    <div class="">
                                        <p class="fpCSI">Giới tính: <span>{{ Auth::user()->sex_user }}</span></p>
                                        <p class="fpCSI">SĐT: <span>{{ Auth::user()->phone }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-30">
                                <p class="fpCSI">Địa chỉ: <span>{{ Auth::user()->district.', '.Auth::user()->city.', '.Auth::user()->province}}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row container">
                        {{-- <h1>Hóa đơn</h1> --}}
                        <table class="table table-bordered table-responsive-sm table-hover">
                            <thead>
                              <tr>
                                <th scope="col">MSP</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá sản phẩm</th>
                                <th scope="col">Phương thức</th>
                                <th scope="col">Ngân hàng</th>
                                <th scope="col">Địa chỉ nhận</th>
                                <th scope="col">Tổng tiền</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $item)
                                <tr>
                                    <td>{{$item->id_product}}</td>
                                    <td>{{$item->name_product}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td>{{number_format($item->price)}}&#8363;</td>
                                    <td>{{$item->method}}</td>
                                    <td>{{$item->bank}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{number_format($item->total)}}&#8363;</td>
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
            </div>
        </div>
        <!-- Product Details Area End -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Newsletter Area Start ##### -->
    <section class="newsletter-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <!-- Newsletter Text -->
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="newsletter-text mb-100">
                        <h2>Subscribe for a <span>25% Discount</span></h2>
                        <p>Nulla ac convallis lorem, eget euismod nisl. Donec in libero sit amet mi vulputate consectetur. Donec auctor interdum purus, ac finibus massa bibendum nec.</p>
                    </div>
                </div>
                <!-- Newsletter Form -->
                <div class="col-12 col-lg-6 col-xl-5">
                    <div class="newsletter-form mb-100">
                        <form action="#" method="post">
                            <input type="email" name="email" class="nl-email" placeholder="Your E-mail">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Newsletter Area End ##### -->
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