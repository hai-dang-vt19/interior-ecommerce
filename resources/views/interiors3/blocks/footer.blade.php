<section class="newsletter-area p-5 px-5">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        @php
                            $pr_sl = $pr_inte->where('size','533x533')->take(1)->get();
                            foreach ($pr_sl as $val) {
                                $pr_sl2 = $pr_inte->where('id','!=',$val->id)->where('size','533x533')->get();
                            }
                        @endphp
                      <div class="carousel-item active">
                        @foreach ($pr_sl as $pr_active)
                            <img class="d-block w-100" src="{{ asset('dashboard/upload_img/product/'.$pr_active->images) }}" width="800px" height="400px" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="text-warning">{{ $pr_active->name_product }}</h5>
                                <p class="text-light">{{ number_format($pr_active->price) }}</p>
                            </div>
                        @endforeach
                      </div>
                      @foreach ($pr_sl2 as $pr2)
                        <div class="carousel-item">
                            <img class="d-block w-100 d-block" src="{{ asset('dashboard/upload_img/product/'.$pr2->images) }}" width="800px" height="400px" style="max-width: 800px; max-height: 400px;" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="text-warning">{{ $pr2->name_product }}</h5>
                                <p class="text-light">{{ number_format($pr2->price) }}</p>
                            </div>
                        </div> 
                      @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-7 mt-5">
                <div class="newsletter-text mb-100 mt-5">
                    <h2>Liên hệ chúng tôi <span>Chung Si Interior</span></h2>
                    <p>
                        Sự lựa chọn của bạn là ưu tiên hàng đầu và quan trọng nhất của chúng tôi. Thiết kế Đúng và Ý tưởng Đúng quan trọng rất nhiều trong Kinh doanh Thiết kế Nội thất. 
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
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
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('index') }}">Trang chủ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('product') }}">Sản phẩm</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('contact') }}">Liên hệ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('cart') }}">Giỏ hàng</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('review') }}">Đánh giá</a>
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