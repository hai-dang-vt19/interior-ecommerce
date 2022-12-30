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
                    <li><a href="{{ route('product') }}">Sản phẩm</a></li>
                    <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                    <li><a href="{{ route('cart') }}">Giỏ hàng</a></li>
                    <li class="active"><a href="{{ route('review') }}">Đánh giá</a></li>
                </ul>
            </nav>
            <!-- Button Group -->
 
            <!-- Cart Menu -->
            @include('interiors.blocks.nav_btn')
            <!-- Social Button -->
             
        </header>
        <!-- Header Area End -->

        <!-- Product Catagories Area Start -->
        <div class="products-catagories-area clearfix">
            <div class="amado-pro-catagory clearfix mb-100 ml-50">
                <h2 class="mt-100"></h2>
                <section class="hero-section ">
                    <div class="card-grid">
                        @php
                            $bg = 'http://127.0.0.1:8000/dashboard/upload_img/product/';
                            // $bg = 'https://images.unsplash.com/photo-1557177324-56c542165309?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80';
                        @endphp
                      @foreach ($comment as $cmt)
                      <a class="card_interior" href="{{ route('review_product_detail', ['id'=>$cmt->id_product]) }}">
                          <div class="card__background" style="background-image: url({{$bg.$cmt->img}})"></div>
                          <div class="card__content">
                          <p class="card__category">{{$cmt->id_product}}</p>
                          <p class="card__category">{{$cmt->name_user}}</p>
                          <h3 class="card__heading">{{$cmt->descriptions}}</h3>
                        </div>
                      </a>
                      @endforeach
                      <div class="mt-50 ml-50">
                        {{$comment->links()}}
                      </div>
                    <div>
                </section>
            </div>
        </div>
        <!-- Product Catagories Area End -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->
    <!-- ##### Newsletter Area Start ##### -->
      
    <!-- ##### Newsletter Area End ##### -->
    @include('interiors.blocks.footer')

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="{{ asset('interior\js\jquery\jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('interior\js\popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('interior\js\bootstrap.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('interior\js\plugins.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('interior\js\active.js') }}"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>

</html>