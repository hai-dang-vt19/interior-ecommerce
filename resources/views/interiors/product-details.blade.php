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
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mt-50" style="font-family: Times">
                                <li class="breadcrumb-item"><a href="#" style="font-weight: bold;font-size: 14px">Chung Si Interior</a></li>
                                <li class="breadcrumb-item"><a href="#" style="font-weight: bold;font-size: 14px">{{$pro_detail['type_product']}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$pro_detail['name_product']}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="single_product_thumb">
                            @php
                                $sl1= 'dashboard/upload_img/product/'.$pro_detail['images'];
                                $sl2= 'dashboard/upload_img/product/'.$pro_detail['images2'];
                            @endphp
                            @if ($pro_detail['images2'] != null)
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                @if ($pro_detail['price'] != 0)   
                                    <div style="position: absolute; color: #FBB710;margin-left: 10px; margin-top: 10px">
                                        <i class='bx bxs-discount bx-tada bx-md'></i>
                                    </div>
                                @endif
                                <ol class="carousel-indicators">
                                    <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url({{$sl1}})">
                                        <img src="{{ asset($sl1) }}" alt=""> 
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="1" style="background-image: url({{$sl2}})">
                                        <img src="{{ asset($sl1) }}" alt="">
                                    </li>
                                </ol>
                                <div class="carousel-inner">
                                    
                                    <div class="carousel-item active">
                                        <a class="gallery_img" href="{{ asset($sl1) }}">
                                            <img class="d-block w-100" src="{{ asset($sl1) }}" alt="First slide">
                                        </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a class="gallery_img" href="{{ asset($sl2) }}">
                                            <img class="d-block w-100" src="{{ asset($sl2) }}" alt="Second slide">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @if ($pro_detail['sales'] != 0)   
                                    <div style="position: absolute; color: #FBB710;margin-left: 10px; margin-top: 10px">
                                        <i class='bx bxs-discount bx-tada bx-md'></i>
                                    </div>
                                    @endif
                                    <div class="carousel-item active">
                                        <a class="gallery_img img_detail" href="{{ asset($sl1) }}">
                                            <img class="d-block" src="{{ asset('dashboard\upload_img\product/'.$pro_detail['images']) }}" alt="First slide" width="620px">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                @if ($pro_detail['sales'] != 0)   
                                    <p class="product-price" style="font-family: Lucida Grande">{{number_format($pro_detail['sales'])}} &#8363; 
                                        <span style="color: rgb(219, 219, 219); text-decoration-line: line-through;margin-left:10px;">{{number_format($pro_detail['price'])}} &#8363;</span>
                                    </p>  
                                @else
                                    <p class="product-price" style="font-family: Lucida Grande">{{number_format($pro_detail['price'])}} &#8363;</p>
                                @endif
                                <h6 class="mb-20" style="font-family: 'Dancing Script', cursive; font-size: 25px">{{$pro_detail['name_product']}} - {{$pro_detail['id_product']}}</h6>
                                <!-- Ratings & Review -->
                                <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <div class="review">
                                        <a href="{{ route('review_detail', ['id'=>$pro_detail['id_product']]) }}">Xem đánh giá</a>
                                    </div>
                                </div>
                                <!-- Avaiable -->
                                <p class="avaibility"><i class="fa fa-circle"></i> {{$pro_detail['status']}}: {{$pro_detail['amount']}}</p>
                            </div>

                            <div class="short_overview my-5">
                                <p style="font-family: Lucida Grande">{{$pro_detail['descriptions']}}</p>
                            </div>

                            <!-- Add to Cart Form -->
                            <form class="cart clearfix" action="{{ route('add_cart', ['id'=>$pro_detail['id']]) }}" method="post">
                                @csrf
                                <div class="cart-btn d-flex mb-50">
                                    <div class="d-flex mr-3">
                                        <p>Qty</p>
                                        <div class="quantity">
                                            <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                            <input type="number" class="qty-text" id="qty" step="1" min="1" max="{{$pro_detail['amount']}}" name="quantity" value="1">
                                            <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                    <button type="submit" class="btncart"><i class='bx bxs-cart-add bx-sm mr-1 mt-1'></i></button>
                                </div>
                            </form>
                            <div>
                                <form action="{{ route('create_comment') }}" method="POST">
                                    @csrf
                                    @php
                                        use Carbon\Carbon;
                                        $time = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
                                    @endphp
                                    <input type="hidden" name="date_crt_cmt" value="{{$time}}">
                                    <input type="hidden" name="img" value="{{$pro_detail['images']}}">
                                    <input type="hidden" value="{{$pro_detail['id_product']}}" name="id_product_cmt">
                                    <textarea name="des_cmt" id="" cols="30" rows="3" class="form-control"></textarea>
                                    <button class="btntotal">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Details Area End -->
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