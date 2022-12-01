<footer class="footer_area clearfix">
    <div class="container">
        <div class="row align-items-center">
            <!-- Single Widget Area -->
            <div class="col-12 col-lg-4">
                <div class="single_widget_area">
                    <!-- Logo -->
                    <div class="footer-logo">
                        <a href="{{ route('index') }}"><img src="{{ asset('interior/img/core-img/logo2.png') }}" alt=""></a>
                    </div>
                    <!-- Copywrite Text -->
                    <p class="copywrite" style="font-family: 'Dancing Script', cursive;">
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> <i class="fa fa-heart-o" aria-hidden="true"></i> by Đặng Hải Đăng</p>
                </div>
            </div>
            <!-- Single Widget Area -->
            <div class="col-12 col-lg-8">
                <div class="single_widget_area">
                    <!-- Footer Menu -->
                    <div class="footer_menu">
                        <nav class="navbar navbar-expand-lg justify-content-end">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                            <div class="collapse navbar-collapse" id="footerNavContent">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{ route('index') }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('product') }}">Product</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="product-details.html">Thay Thế</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="cart.html">Cart</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="checkout.html">Checkout</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>