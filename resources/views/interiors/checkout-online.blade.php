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

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class=" mt-50 clearfix">
                            @php
                                use Carbon\Carbon;
                                $timeNow = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
                            @endphp
                            <div class="cart-title">
                                <h2>Thanh toán Online</h2>
                            </div>
                            <form action="#" method="post">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><i class='bx bx-user'></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{$user['name']}}">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><i class='bx bx-envelope' ></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{$user['email']}}">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><i class='bx bx-buildings' ></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{$user['district']}} - {{$user['city']}} - {{$user['province']}}">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class='bx bx-phone' ></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{$user['phone']}}">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><i class='bx bx-history' ></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="{{$timeNow}}">
                                </div>
                                <div class="input-group mb-3 mt-50 justify-content-center">
                                    <div class="d-flex">
                                        <div class="mr-3">
                                            <form action="{{ route('momo_payment', ['total_qr_momo'=>$sum_product_city]) }}" method="POST">
                                                @csrf
                                                <button type="submit" name="payUrl" class="btn_total_momo">
                                                    <i class='bx bxs-credit-card-front bx-fade-left bx-flip-horizontal mr-2' >
                                                    </i>Momo ATM
                                                </button>
                                            </form>
                                        </div>
                                        {{-- <div class="mr-3">
                                            <form action="{{ route('momo_payment') }}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{$sum_product_city}}" name="total_momo">
                                                <button type="submit" class="btn_total_momo"><i class='bx bx-qr-scan bx-flip-horizontal bx-tada mr-2' ></i> Momo QR</button>
                                            </form>
                                        </div> --}}
                                        <div class="mr-3">
                                            <form action="{{ route('vnpay_payment') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{$sum_product_city}}" name="total_vnpay">
                                                <button type="submit" class="btn_total_vnpay" name="redirect"><i class='bx bxs-credit-card-front bx-fade-left bx-flip-horizontal mr-2' ></i>VNPAY ATM</button>
                                            </form>
                                        </div>
                                        {{-- <div>
                                            <form action="{{ route('vnpay_payment') }}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{$sum_product_city}}" name="total_vnpay">
                                                <button type="submit" class="btn_total_vnpay"><i class='bx bx-qr-scan bx-flip-horizontal bx-tada mr-2' ></i> VNPAY QR</button>
                                            </form>
                                        </div> --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 mt-3">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>Tổng tiền sản phẩm:</span> <span>{{number_format($sum)}} &#8363;</span></li>
                                <li>
                                    <span>Phí lắp ráp:</span> <span>{{number_format($ct)}} &#8363;</span>
                                </li>
                                <li><span>Tổng tiên:</span> <span>{{number_format($sum_product_city)}} &#8363;</span></li>
                            </ul>
                            {{-- <div class="cart-btn mt-100">
                                <a href="#" class="btn amado-btn w-100">Checkout</a>
                            </div> --}}
                        </div>
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