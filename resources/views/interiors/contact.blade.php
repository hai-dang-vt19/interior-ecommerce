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
                    <li class="active"><a href="{{ route('contact') }}">Liên hệ</a></li>
                    <li><a href="{{ route('cart') }}">Giỏ hàng</a></li>
                    <li><a href="{{ route('review') }}">Đánh giá</a></li>
                </ul>
            </nav>
            @include('interiors.blocks.nav_btn')
             
        </header>
        <!-- Header Area End -->

        <!-- Product Catagories Area Start -->
        <div class="products-catagories-area clearfix">
            <div class="amado-pro-catagory clearfix mt-100">
                <div class="body_contact">
                    <div class="input_mail">
                        <div class="mr-50 div_input_mail">
                            @foreach ($adm as $ad)
                                <div class="ml-50 profile_inte">
                                    <div class="ibx">
                                        <i class='bx bx-user'> {{ $ad->name }}</i><i class='bx bx-phone-call ml-5'> {{ $ad->phone }}</i><br>
                                    </div>
                                    <div class="ibx">
                                        <i class='bx bxs-institution'> {{ $ad->district.' - '.$ad->city.' - '.$ad->province}}</i><br>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-5">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9671271815073!2d105.76816471488348!3d21.034001285995497!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b7603f0e67%3A0x2249d4a286914421!2zRkxDIExhbmRtYXJrIFRvd2VyLCBN4bu5IMSQw6xuaCwgTmFtIFThu6sgTGnDqm0sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1672364599796!5m2!1svi!2s" 
                        width="95%" height="536" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Catagories Area End -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->
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