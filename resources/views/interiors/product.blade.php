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
        <!-- Mobile Nav (max width 767px)-->
        @include('interiors.blocks.mobile-nav')
        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            @include('interiors.blocks.logo')
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>
                    <li class="active"><a href="{{ route('product') }}">Sản phẩm</a></li>
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

        <div class="shop_sidebar_area">

            <!-- ##### Single Widget ##### -->
            <div class="widget catagory mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Loại sản phẩm</h6>
                <!--  Catagories  -->
                <div class="catagories-menu">
                    <ul>
                        @foreach ($type as $typ)
                            <li>
                                <a href="{{ route('get_with_type', ['type'=>$typ->name_type]) }}">
                                    <span class="containerinte d-flex">
                                        <div class="textinte" data-text="{{$typ->name_type}}">{{$typ->name_type}}</div>
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="widget catagory mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Màu sản phẩm</h6>

                <!--  Catagories  -->
                <div class="catagories-menu">
                    <ul>
                        {{-- <div class="interior_color" style="background-color: #FFFFFF">   </div> --}}
                        @foreach ($color as $cl)
                            <li class="mb-2">
                                <a href="{{ route('get_with_color', ['col'=>$cl->color]) }}" class="btn btn-lg interior_color" style="background-color: {{$cl->color}}"></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="amado_product_area mt-5 ml-5">
            <div class="container-fluid mt-5">
                <div class="dropdown mb-5">
                    <button class="btn btn-warning dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Khoảng giá
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @php
                            $step = 500000;
                            for ($i = $min; $i <= ceil($max / $step) * $step; $i++){
                                if ($i % $step == 0) {
                                    $data = number_format($min)." - ".number_format($i);
                                    $min = $i + 0;
                                    echo ' <a class="dropdown-item" href="'.route('product_with_price', ['data'=>$data]).'">'.$data.' &#8363;</a> ';
                                }
                            }
                        @endphp
                    </div>
                </div>
                <div class="row border-bottom border-warning">
                    <!-- Single Product Area -->
                    @foreach ($product as $pro)
                    <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <a href="{{ route('product_detail', ['id'=>$pro->id]) }}">
                                <div class="product-img">
                                    @if ($pro->sales != 0)   
                                    <div style="position: absolute; color: #FBB710;margin-left: 10px; margin-top: 10px">
                                        <i class='bx bxs-discount bx-tada bx-md'></i>
                                    </div>
                                    @endif
                                    <img src="{{ asset('dashboard\upload_img\product/'.$pro->images) }}" style="max-height: 370px" alt="">
                                    {{-- <div class="sales">
                                        <i class='bx bxs-discount bx-sm bx-tada'></i>
                                    </div> --}}
                                    <!-- Hover Thumb -->
                                    @if ($pro->images2 != null)
                                    <img class="hover-img" src="{{ asset('dashboard\upload_img\product/'.$pro->images2) }}" style="max-height: 370px" alt="">
                                    @endif
                                </div>
                            </a>
                            <!-- Product Description -->
                            <div class="product-description d-flex align-items-center justify-content-between">
                                <!-- Product Meta Data -->
                                <div class="product-meta-data">
                                    <div class="line"></div>
                                    @if ($pro->sales == 0)
                                    <p class="product-price" style="font-family: Lucida Grande">
                                            {{number_format($pro->price)}} &#8363;
                                    </p>
                                    @else
                                    <p class="product-price" style="font-family: Lucida Grande">
                                        {{number_format($pro->sales)}}&#8363;
                                        <span style="color: #dddddd; text-decoration-line: line-through; margin-left:10px">
                                            {{number_format($pro->price)}} &#8363;
                                        </span>
                                    </p>
                                    @endif
                                    <a href="{{ route('product_detail', ['id'=>$pro->id]) }}">
                                        <h6 style="font-family: Times; font-weight: bold">{{$pro->name_product}}</h6>
                                    </a>
                                </div>
                                <!-- Ratings & Cart -->
                                <div class="ratings-cart text-right d-flex">
                                    <div class="ratings ratings_2">
                                        <a href="{{ route('create_favorite', ['id'=>$pro->id_product]) }}"><i class='bx bx-bookmark-heart bx-md'></i></a>
                                    </div>
                                    {{-- <div class="add_to_cart">
                                        <a href="" data-toggle="tooltip" data-placement="left" title="Add to Cart"><i class='bx bxs-cart-add bx-md' ></i></a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Pagination -->
                        <nav aria-label="navigation">
                            <div class="pagination justify-content-center mt-10">
                                {{$product->links()}}
                            </div>
                        </nav>
                    </div>
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
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session()->has('create_fv'))
      <script>
        swal({
              title: "{{session()->get('create_fv')}}",
              icon: "success",
              button: "OK",
              timer: 1000,
            });
      </script>
    @endif
    @if (session()->has('ck_favo'))
      <script>
        swal({
              title: "{{session()->get('ck_favo')}}",
              icon: "error",
              button: "OK",
              timer: 1000,
            });
      </script>
    @endif
    
</body>

</html>