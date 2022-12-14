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
                    <li class="active"><a href="{{ route('cart') }}">Cart</a></li>
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
                <a href="cart.html" class="cart-nav"><img src="{{ asset('interior/img/core-img/cart.png') }}" alt=""> Cart <span>(0)</span></a>
                <a href="#" class="fav-nav"><img src="{{ asset('interior/img/core-img/favorites.png') }}" alt=""> Favourite</a>
                <a href="#" class="search-nav"><img src="{{ asset('interior/img/core-img/search.png') }}" alt=""> Search</a>
                <a href="{{ route('logout') }}">Đăng xuất</a>
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

        <div class="cart-table-area" style="background-color: rgb(255, 255, 255); padding-top: 40px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <h2 class="mt-30 d-flex" style="font-family: 'Times New Roman', Times, serif">Giỏ hàng của bạn <p class="font-weight-light">({{count($data_cart)}})</p></h2>
                        @foreach ($data_cart as $cart)
                        <div class="row mb-70 border-top border-warning" style="background-color: rgb(254, 254, 254)">
                            <div style="padding-top: 10px">
                                <div class="d-flex ">
                                    <div class="single_product_thumb ml-30"  style="max-width: 245px; max-height: 272px">
                                        <img class="d-block w-100 shadow" src="{{ asset('dashboard\upload_img\product/'.$cart->image_product) }}">
                                    </div>
                                    <div class="ml-50 mt-30">
                                        <div class="line"></div>
                                        <h6 class="mb-20" style="font-family: 'Dancing Script', cursive; font-size: 23px">{{$cart->name_product}} - {{$cart->id_product}}</h6>
                                        <p class="product-price" style="font-family: Lucida Grande"> Giá sản phẩm: {{number_format($cart->price_product)}} &#8363;</p>
                                        <p style="font-family: 'Times;"> Số lượng mua: {{$cart->amount_product}}</p>
                                        <p style="font-family: 'Dancing Script', cursive; font-size: 20px; color: #FBB710"> Tổng tiền: {{number_format($cart->total)}} &#8363;</p>
                                        <div class="d-flex">
                                            <div class="wrap mr-3">
                                                {{-- <button class="button">VNPAY</button> --}}
                                                <button class="button">VNPAY</button>
                                            </div>
                                            <div class="wrap mr-3">
                                                <button class="button">Momo</button>
                                            </div>
                                            <div class="wrap mr-3">
                                                <button class="button">COD</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>Tổng tiền sản phẩm:</span> <span>{{number_format($sum)}} &#8363;</span></li>
                                <li>
                                    <span>Phí lắp ráp:</span> <span>{{number_format($ct)}} &#8363;</span>
                                </li>
                                <li><span>Tổng tiên:</span> <span>{{number_format($sum_product_city)}} &#8363;</span></li>
                            </ul>
                            {{-- <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" value="on">
                                        <label class="custom-control-label" for="customRadioInline2">Thanh toán online</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" value="of">
                                        <label class="custom-control-label" for="customRadioInline1">Thanh toán khi nhận hàng</label>
                                    </div>
                                    <input type="hidden" value="{{$sum}}" name="tongsanpham">
                                    <input type="hidden" value="{{$ct}}" name="philaprap">
                                    <input type="hidden" value="{{$sum_product_city}}" name="tongtien">
                                </div>
                                <div class="cart-btn mt-100">
                                    <button class="btn amado-btn w-100" type="submit">Checkout</button>
                                </div>
                            </form> --}}
                            <div class="container mb-2">
                                <div class="justify-content-center">
                                    <form action="{{ route('vnpay_payment') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{$sum_product_city}}" name="total_vnpay">
                                        <button type="submit" class="btn_total_vnpay" name="redirect">
                                            <i class='bx bx-credit-card bx-tada mr-2' ></i>
                                            Ví VNPAY
                                            <i class='bx bx-qr-scan bx-tada bx-flip-horizontal ml-2' ></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="container mb-2">
                                <div class="justify-content-center">
                                    <form action="{{ route('momo_payment', ['total_qr_momo'=>$sum_product_city]) }}" method="POST">
                                        @csrf
                                        <button type="submit" name="payUrl" class="btn_total_vnpay">
                                            <i class='bx bx-credit-card bx-tada mr-2' ></i>
                                            Ví Momo
                                            <i class='bx bx-qr-scan bx-tada bx-flip-horizontal ml-2' ></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="container mb-2">
                                <div class="justify-content-center">
                                    <form action="" method="POST">
                                        @csrf
                                        <button type="submit" name="payUrl" class="btn_total_vnpay">
                                            COD
                                            <i class='bx bx-package bx-fade-right' ></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- <img src="{{ asset('interior\img\core-img\logo-vnpay.55e9c8c.svg') }}" alt="">
                        <img src="{{ asset('interior\img\core-img\logo_momo.png') }}" alt=""> --}}
                    </div>
                </div>
            </div>
        </div>
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

</body>

</html>