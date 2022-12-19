<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    @include('interiors.blocks.header')

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

        <div class="cart-table-area" style="background-color: rgb(255, 255, 255); padding-top: 40px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <h2 class="mt-30 d-flex" style="font-family: 'Times New Roman', Times, serif">Giỏ hàng của bạn <p class="font-weight-light">({{count($data_cart)}})</p></h2>
                        @if ($data_cart == '[]')
                            <div class="cart_null"><i class='bx bxl-dropbox bx-tada bx-lg'></i></div>
                        @else
                            @foreach ($data_cart as $cart)
                            <div class="row mb-70 border-top border-warning" style="background-color: rgb(254, 254, 254)">
                                <div class="d-flex">
                                    <div style="padding-top: 10px">
                                        <div class="d-flex ">
                                            <div class="single_product_thumb ml-30 d-flex"  style="max-width: 245px; max-height: 272px">
                                                <div>
                                                    {{-- <div class="wrapper">
                                                        <div class="switch_box box_4">
                                                            <div class="input_wrapper">
                                                            <input type="checkbox" class="switch_4" value="1">
                                                            <svg class="is_checked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 426.67 426.67">
                                                                <path d="M153.504 366.84c-8.657 0-17.323-3.303-23.927-9.912L9.914 237.265c-13.218-13.218-13.218-34.645 0-47.863 13.218-13.218 34.645-13.218 47.863 0l95.727 95.727 215.39-215.387c13.218-13.214 34.65-13.218 47.86 0 13.22 13.218 13.22 34.65 0 47.863L177.435 356.928c-6.61 6.605-15.27 9.91-23.932 9.91z"/>
                                                            </svg>
                                                            <svg class="is_unchecked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 212.982 212.982">
                                                            </svg>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    <img class="d-block w-100 shadow" src="{{ asset('dashboard\upload_img\product/'.$cart->image_product) }}">
                                                </div>
                                            </div>
                                            <div class="ml-50 mt-30">
                                                <div class="line"></div>
                                                <h6 class="mb-20" style="font-family: 'Dancing Script', cursive; font-size: 23px">{{$cart->name_product}} - {{$cart->id_product}}</h6>
                                                <p class="product-price" style="font-family: Lucida Grande"> Giá sản phẩm: {{number_format($cart->price_product)}} &#8363;</p>
                                                <p style="font-family: 'Times;"> Số lượng mua: {{$cart->amount_product}}</p>
                                                <p style="font-family: 'Dancing Script', cursive; font-size: 20px; color: #FBB710"> Tổng tiền: {{number_format($cart->total)}} &#8363;</p>
                                                <div class="d-flex">
                                                    <div class="wrap mr-3">
                                                        <form action="{{ route('vnpay_payment_don_atm') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" value="{{$cart->total}}" name="total_vnpay">
                                                            <button type="submit" class="button" name="redirect">VNPAY <i class='bx bx-credit-card-front'></i></button>
                                                        </form>
                                                    </div>
                                                    <div class="wrap mr-3">
                                                        <form action="{{ route('vnpay_payment_don_qr') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" value="{{$cart->total}}" name="total_vnpay">
                                                            <button type="submit" class="button" name="redirect">VNPAY <i class='bx bx-qr-scan' ></i></button>
                                                        </form>
                                                    </div>
                                                    <div class="wrap mr-3">
                                                        <form action="" method="POST">
                                                            @csrf
                                                            <input type="hidden" value="{{$cart->total}}" name="total_vnpay">
                                                            <button class="button">COD</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="{{ route('destroy_cart_product', ['id'=>$cart->id, 'id_pr'=>$cart->id_product, 'amount_pr'=>$cart->amount_product]) }}">
                                            <i class='bx bx-x bx-sm x_pro_cart'></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    @if ($data_cart == '[]')
                    @else
                        <div class="col-12 col-lg-4">
                            <div class="cart-summary">
                                <h5>Cart Total</h5>
                                <ul class="summary-table">
                                    <li><span>Tổng tiền sản phẩm:</span> <span>{{number_format($sum)}} &#8363;</span></li>
                                    <li>
                                        <span>Phí lắp ráp:</span> <span>{{number_format($ct)}} &#8363;</span>
                                    </li>
                                    <li><span>Tổng tiên:</span> <span>{{number_format($sum_product_city)}} &#8363;</span></li>
                                    <div class="bd_cont_principal">
                                        <div class="cont_principal">
                                            <div class="cont_menu">
                                              <div class="cont_titulo_menu" onclick="menu()">
                                            <div class="cont_titulo">
                                                <h6>Phương thức thanh toán</h6>
                                                </div>
                                                <div class="cont_icon_menu">
                                               <img src="http://danysantos.hol.es/img/planet.png" alt="" />
                                            <div class="cont_circle_1"></div>
                                            <div class="cont_circle_2"></div>
                                            <div class="cont_circle_3"></div>
                                            <div class="cont_circle_4"></div>
                                                </div>
                                              </div>
                                            <div class="cont_icon_trg disable">
                                            <svg width="46px" height="38px" viewBox="0 0 46 38" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  >
                                                <defs>
                                                    <filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox" id="filter-1">
                                                        <feOffset dx="0" dy="-2" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
                                                        <feGaussianBlur stdDeviation="1.5" in="shadowOffsetOuter1" result="shadowBlurOuter1"></feGaussianBlur>
                                                        <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.0813575634 0" in="shadowBlurOuter1" type="matrix" result="shadowMatrixOuter1"></feColorMatrix>
                                                        <feMerge>
                                                            <feMergeNode in="shadowMatrixOuter1"></feMergeNode>
                                                            <feMergeNode in="SourceGraphic"></feMergeNode>
                                                        </feMerge>
                                                    </filter>
                                                </defs>
                                            </svg></div>
                                            <div class="cont_drobpdown_menu disable" >
                                                <ul>
                                                    <li>
                                                        <itm>
                                                            <form action="{{ route('vnpay_payment') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{$sum_product_city}}" name="total_vnpay">
                                                                <button type="submit" class="btn_total_vnpay" name="redirect">
                                                                    {{-- VNPAY ATM --}}
                                                                    <img src="{{ asset('interior\img\core-img\ATM.PNG') }}"alt="">
                                                                </button>
                                                            </form>
                                                        </itm>
                                                    </li>
                                                    <hr/>
                                                    <li>
                                                        <itm>
                                                            <form action="{{ route('vnpay_payment_qr') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{$sum_product_city}}" name="total_vnpay">
                                                                <button type="submit" class="btn_total_vnpay" name="redirect">
                                                                    {{-- VNPAY QR --}}
                                                                    <img src="{{ asset('interior\img\core-img\QRCODE.PNG') }}"alt="">
                                                                </button>
                                                            </form>
                                                        </itm>
                                                    </li>
                                                    <hr/>
                                                    <li>
                                                        <itm>
                                                            <form action="{{ route('vnpay_payment_qr') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{$sum_product_city}}" name="total_vnpay">
                                                                <button type="submit" class="btn_total_vnpay" name="redirect">
                                                                    {{-- VNPAY QR --}}
                                                                    <div class="img_cod">
                                                                        <div>
                                                                            <img class="img2" src="{{ asset('interior\img\codd2.png') }}"alt="">
                                                                        </div>
                                                                        <div>
                                                                            <img class="img1" src="{{ asset('interior\img\codd1.png') }}"alt="">
                                                                        </div>
                                                                    </div>
                                                                </button>
                                                            </form>
                                                        </itm>
                                                    </li>
                                                </ul>
                                              </div> 
                                              </div> 
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                                let c = 0;
                                                function menu(){
                                                if(c % 2 == 0) {
                                                document.querySelector('.cont_drobpdown_menu').className = "cont_drobpdown_menu active";    
                                                document.querySelector('.cont_icon_trg').className = "cont_icon_trg active";    
                                                c++; 
                                                }else{
                                                document.querySelector('.cont_drobpdown_menu').className = "cont_drobpdown_menu disable";        
                                                document.querySelector('.cont_icon_trg').className = "cont_icon_trg disable";        
                                                c++;
                                                }
                                                }
                                        </script>
                                    </div>
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

                                {{-- <div class="container mb-2">
                                    <div class="justify-content-center">
                                        <form action="{{ route('vnpay_payment') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{$sum_product_city}}" name="total_vnpay">
                                            <button type="submit" class="btn_total_vnpay" name="redirect">
                                                VNPAY ATM
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="container mb-2">
                                    <div class="justify-content-center">
                                        <form action="{{ route('vnpay_payment_qr') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{$sum_product_city}}" name="total_vnpay">
                                            <button type="submit" class="btn_total_vnpay" name="redirect">
                                                VNPAY QR
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
                                            </button>
                                        </form>
                                    </div>
                                </div> --}}
                            {{-- <img src="{{ asset('interior\img\core-img\logo-vnpay.55e9c8c.svg') }}" alt="">
                            <img src="{{ asset('interior\img\core-img\logo_momo.png') }}" alt=""> --}}
                        </div>
                    @endif
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session()->has('cart_null'))
      <script>
        swal({
              title: "{{session()->get('cart_null')}}",
            //   text: "",
              icon: "warning",
              button: "OK",
              timer: 2000,
            });
      </script>
    @endif
</body>

</html>