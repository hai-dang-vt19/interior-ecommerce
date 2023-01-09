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
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>
                    <li><a href="{{ route('product') }}">Sản phẩm</a></li>
                    <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                    <li class="active"><a href="{{ route('cart') }}">Giỏ hàng</a></li>
                    <li><a href="{{ route('review') }}">Đánh giá</a></li>
                </ul>
            </nav>
            <!-- Button Group -->
 
            <!-- Cart Menu -->
            @include('interiors.blocks.nav_btn')
            <!-- Social Button -->
             
        </header>
        <!-- Header Area End -->

        <div class="cart-table-area" style="background-color: rgb(255, 255, 255); padding-top: 40px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="d-flex">
                            <h2 class="mt-30 d-flex" style="font-family: 'Times New Roman', Times, serif">
                                Giỏ hàng của bạn 
                                <p class="font-weight-light">({{count($data_cart)}})</p>
                                <div class="update_address_">
                                    <a href="{{ route('update_profile_opCart', ['id'=>Auth::user()->city]) }}" class="update_address">Cập nhật điểm giao hàng</a>
                                </div>
                            </h2>
                        </div>
                        @if ($data_cart == '[]')
                            <div class="cart_null"><i class='bx bxl-dropbox bx-tada bx-lg'></i></div>
                        @else
                            @foreach ($data_cart as $cart)
                            <div class="row mb-70 border-top border-warning" style="background-color: rgb(254, 254, 254)">
                                <div class="d-flex">
                                    <div style="padding-top: 10px">
                                        <div class="d-flex ">
                                            <div class="single_product_thumb ml-30 d-flex" >
                                                <div>
                                                    <a href="{{ route('review_product_detail', ['id'=>$cart->id_product]) }}">
                                                    <img class="d-block shadow " src="{{ asset('dashboard\upload_img\product/'.$cart->image_product) }}">
                                                    </a>
                                                </div>
                                                @if ($cart->sales != 0)
                                                <div class="saless d-flex ">
                                                    <i class='bx bxs-discount bx-sm bx-tada'></i>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="ml-50 mt-30">
                                                <div class="line"></div>
                                                <a href="{{ route('review_product_detail', ['id'=>$cart->id_product]) }}">
                                                    <h6 class="mb-20" style="font-family: 'Dancing Script', cursive; font-size: 23px">
                                                        {{$cart->name_product}} - {{$cart->id_product}}
                                                    </h6>
                                                </a>
                                                @if ($cart->sales == 0)
                                                    <p class="product-price" style="font-family: Lucida Grande"> Giá sản phẩm: {{number_format($cart->price_product)}} &#8363;</p>
                                                    <p style="font-family: 'Times;"> Số lượng mua: {{$cart->amount_product}} <span>&emsp;&emsp;Phụ phí: {{number_format($ct)}}&#8363;</span></p>
                                                    <p style="font-family: 'Dancing Script', cursive; font-size: 20px; color: #FBB710"> Tổng tiền: {{number_format($cart->total)}} &#8363;</p>
                                                    <div class="d-flex">
                                                        <div class="wrap mr-3">
                                                            <form action="{{ route('vnpay_payment_don_atm') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{$cart->total+$ct}}" name="total_vnpay">
                                                                <button type="submit" class="button" name="redirect">VNPAY <i class='bx bx-credit-card-front'></i></button>
                                                            </form>
                                                        </div>
                                                        <div class="wrap mr-3">
                                                            <form action="{{ route('vnpay_payment_don_qr') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{$cart->total+$ct}}" name="total_vnpay">
                                                                <button type="submit" class="button" name="redirect">VNPAY <i class='bx bx-qr-scan' ></i></button>
                                                            </form>
                                                        </div>
                                                        <div class="wrap mr-3">
                                                            <form action="{{ route('checkout_cod_get_don', ['id'=>$cart->id_product]) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{$cart->total+$ct}}" name="total_cod">
                                                                <button type="submit" class="button">COD</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @else
                                                    <p class="product-price" style="font-family: Lucida Grande">
                                                        Giá sản phẩm: <span class="sales_">{{number_format($cart->price_product)}} &#8363;</span>
                                                       {{number_format($cart->sales)}} &#8363;
                                                    </p>
                                                    <p style="font-family: 'Times;"> Số lượng mua: {{$cart->amount_product}} <span>&emsp;&emsp; Phụ phí: {{number_format($ct)}}&#8363;</span></p>
                                                    <p style="font-family: 'Dancing Script', cursive; font-size: 20px; color: #FBB710"> 
                                                        Tổng tiền: {{number_format($cart->total_sales)}} &#8363;
                                                    </p>
                                                    <div class="d-flex">
                                                        <div class="wrap mr-3">
                                                            <form action="{{ route('vnpay_payment_don_atm') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{$cart->total_sales+$ct}}" name="total_vnpay">
                                                                <input type="hidden" value="{{$cart->id_product}}" name="total_vnpay_idpr">
                                                                <button type="submit" class="button" name="redirect">VNPAY <i class='bx bx-credit-card-front'></i></button>
                                                            </form>
                                                        </div>
                                                        <div class="wrap mr-3">
                                                            <form action="{{ route('vnpay_payment_don_qr') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{$cart->total_sales+$ct}}" name="total_vnpay">
                                                                <button type="submit" class="button" name="redirect">VNPAY <i class='bx bx-qr-scan' ></i></button>
                                                            </form>
                                                        </div>
                                                        <div class="wrap mr-3">
                                                            <form action="{{ route('checkout_cod_get_don', ['id'=>$cart->id_product]) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{$cart->total_sales+$ct}}" name="total_cod">
                                                                <button type="submit" class="button">COD</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif
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
                                                            <a href="{{ route('checkout_cod', ['tt_cod'=>$sum_product_city]) }}" class="btn_total_vnpay">
                                                                <div class="img_cod">
                                                                    <div>
                                                                        <img class="img2" src="{{ asset('interior\img\codd2.png') }}"alt="">
                                                                    </div>
                                                                    <div>
                                                                        <img class="img1" src="{{ asset('interior\img\codd1.png') }}"alt="">
                                                                    </div>
                                                                </div>
                                                            </a>
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
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Newsletter Area Start ##### -->
      
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
    @if (session()->has('gd'))
      <script>
        swal({
              title: "{{session()->get('gd')}}",
            //   text: "",
              icon: "warning",
              button: "OK",
              timer: 2000,
            });
      </script>
    @endif
    @if (session()->has('check_cod_don'))
      <script>
        swal({
              title: "{{session()->get('check_cod_don')}}",
              icon: "success",
              button: "OK",
              timer: 2000,
            });
      </script>
    @endif
</body>

</html>