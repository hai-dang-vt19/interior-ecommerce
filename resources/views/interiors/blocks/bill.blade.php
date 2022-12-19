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
            <div class="amado-btn-group mt-30 mb-100">
                <a href="#" class="btn amado-btn mb-15">TEST</a>
                <a href="#" class="btn amado-btn active">New this week</a>
            </div>
            <!-- Cart Menu -->
            <div class="cart-fav-search mb-100">
                <a href="{{ route('cart') }}">
                    @if (count($data_cart) == 0)
                        <i class='bx bx-cart-alt bx-sm mr-2'></i>
                    @else
                        <i class='bx bx-cart-alt bx-tada bx-sm mr-2'></i>
                    @endif
                    Giỏ hàng <span>({{count($data_cart)}})</span>
                </a>
                <a href="#"><i class='bx bx-heart-circle bx-sm mr-2'></i> Yêu thích</a>
                <a href="#" class="search-nav"><i class='bx bx-search-alt-2 bx-sm mr-2'></i> Tìm kiếm</a>
                <a href="{{ route('logout') }}"><i class='bx bx-log-out bx-sm mr-2'></i> Đăng xuất</a>
            </div>
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->

        <!-- Product Details Area Start -->
        <div class="single-product-area section-padding-0-100 clearfix">
            <div class="container-fluid">

                <div class="row">
                    <div>
                        <h1>Thanh toán thành công</h1>
                        <h1>Hóa đơn</h1>
                        <div>
                          <p>Mã hóa đơn: {{$vnp_TxnRef}}</p>
                          <p>Ngân hàng: {{$vnp_BankCode}}</p>
                          <p>Mã GD ngân hàng: {{$vnp_BankTranNo}}</p>
                          <p>Mã GD VNPAY: {{$vnp_TransactionNo}}</p>
                          <p>Loại thanh toán: {{$vnp_CardType}}</p>
                          <p>Giá tiền: {{$vnp_Amount}}</p>
                        </div>
                        <form action="" method="POST">
                          <input type="hidden" name="" value="{{$vnp_TxnRef}}">
                          <input type="hidden" name="" value="{{$vnp_BankCode}}">
                          <input type="hidden" name="" value="{{$vnp_BankTranNo}}">
                          <input type="hidden" name="" value="{{$vnp_CardType}}">
                          <input type="hidden" name="" value="{{$vnp_TransactionNo}}">
                          <input type="hidden" name="" value="{{$vnp_Amount}}">
                          
                          <button type="submit">Hoàn tất</button>
                        </form>
                      
                    </div>
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
    @if (session()->has('cart_sc'))
      <script>
        swal({
              title: "{{session()->get('cart_sc')}}",
              icon: "success",
              button: "OK",
              timer: 2000,
            });
      </script>
    @endif
</body>

</html>