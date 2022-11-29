<!doctype html>
<html class="no-js" lang="en">

    <head>
        <!-- meta data -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
        <!-- title of site -->
        <title>Interior Design - CHUNG SI</title>
        <!-- For favicon png -->
		<link rel="shortcut icon" type="image/icon" href="{{ asset('dashboard\assets\img\favicon\logo-interior.png') }} "/>
        <!--font-awesome.min.css-->
        <link rel="stylesheet" href="{{ asset('interior/css/font-awesome.min.css') }} ">
        <!--linear icon css-->
		<link rel="stylesheet" href="{{ asset('interior/css/linearicons.css') }} ">
		<!--animate.css-->
        <link rel="stylesheet" href="{{ asset('interior/css/animate.css') }} ">
        <!--owl.carousel.css-->
        <link rel="stylesheet" href="{{ asset('interior/css/owl.carousel.min.css') }} ">
		<link rel="stylesheet" href="{{ asset('interior/css/owl.theme.default.min.css') }} ">
        <!--bootstrap.min.css-->
        <link rel="stylesheet" href="{{ asset('interior/css/bootstrap.min.css') }} ">
		<!-- bootsnav -->
		<link rel="stylesheet" href="{{ asset('interior/css/bootsnav.css') }} " >	
        <!--style.css-->
        <link rel="stylesheet" href="{{ asset('interior/css/style.css') }} ">      
        <!--responsive.css-->
        <link rel="stylesheet" href="{{ asset('interior/css/responsive.css') }} ">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		
        <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>	
	<body>
		<!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
		<!--welcome-hero start -->
		<header id="home" class="welcome-hero">

			<div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
				<!--/.carousel-indicator -->
				 <ol class="carousel-indicators">
					<li data-target="#header-carousel" data-slide-to="0" class="active"><span class="small-circle"></span></li>
					<li data-target="#header-carousel" data-slide-to="1"><span class="small-circle"></span></li>
					<li data-target="#header-carousel" data-slide-to="2"><span class="small-circle"></span></li>
				</ol><!-- /ol-->
				<!--/.carousel-indicator -->

				<!--/.carousel-inner -->
				<div class="carousel-inner" role="listbox">
					<!-- .item -->
					<div class="item active">
						<div class="single-slide-item slide1">
							<div class="container">
								<div class="welcome-hero-content">
									<div class="row">
										<div class="col-sm-7">
											<div class="single-welcome-hero">
												@foreach ($slide_1 as $sl1)
												<div class="welcome-hero-txt">
													<input type="hidden" value="{{$sl1->id_product}}">
													<h4>{{$sl1->type_product}}</h4>
													<h2>{{$sl1->name_product}}</h2>
													<p>
														{{$sl1->descriptions}}
													</p>
													<div class="packages-price">
														<p>
															{{number_format($sl1->price)}} &#8363;
															<del>{{number_format($sl1->price)}} &#8363;</del>
														</p>
													</div>
													<button class="btn-cart welcome-add-cart" onclick="window.location.href='#'">
														<span class="lnr lnr-plus-circle"></span>
														add <span>to</span> cart
													</button>
													<button class="btn-cart welcome-add-cart welcome-more-info" onclick="window.location.href='#'">
														more info
													</button>
												</div><!--/.welcome-hero-txt-->
												@endforeach
											</div><!--/.single-welcome-hero-->
										</div><!--/.col-->
										<div class="col-sm-5">
											<div class="single-welcome-hero">
												<div class="welcome-hero-img">
													<img src="{{ asset('dashboard\upload_img\product/'.$sl1->images) }}" alt="slider image">
												</div><!--/.welcome-hero-txt-->
											</div><!--/.single-welcome-hero-->
										</div><!--/.col-->
									</div><!--/.row-->
								</div><!--/.welcome-hero-content-->
							</div><!-- /.container-->
						</div><!-- /.single-slide-item-->

					</div><!-- /.item .active-->

					<div class="item">
						<div class="single-slide-item slide2">
							<div class="container">
								<div class="welcome-hero-content">
									<div class="row">
										<div class="col-sm-7">
											<div class="single-welcome-hero">
												@foreach ($slide_2 as $sl2)
												<div class="welcome-hero-txt">
													<input type="hidden" value="{{$sl2->id_product}}">
													<h4>{{$sl2->type_product}}</h4>
													<h2>{{$sl2->name_product}}</h2>
													<p>
														{{$sl2->descriptions}} 
													</p>
													<div class="packages-price">
														<p>
															{{number_format($sl2->price)}} &#8363;
															<del>{{number_format($sl2->price)}} &#8363;</del>
														</p>
													</div>
													<button class="btn-cart welcome-add-cart" onclick="window.location.href='#'">
														<span class="lnr lnr-plus-circle"></span>
														add <span>to</span> cart
													</button>
													<button class="btn-cart welcome-add-cart welcome-more-info" onclick="window.location.href='#'">
														more info
													</button>
												</div><!--/.welcome-hero-txt-->
												@endforeach
											</div><!--/.single-welcome-hero-->
										</div><!--/.col-->
										<div class="col-sm-5">
											<div class="single-welcome-hero">
												<div class="welcome-hero-img">
													<img src="{{ asset('dashboard\upload_img\product/'.$sl2->images) }}" alt="slider image">
												</div><!--/.welcome-hero-txt-->
											</div><!--/.single-welcome-hero-->
										</div><!--/.col-->
									</div><!--/.row-->
								</div><!--/.welcome-hero-content-->
							</div><!-- /.container-->
						</div><!-- /.single-slide-item-->

					</div><!-- /.item .active-->

					<div class="item">
						<div class="single-slide-item slide3">
							<div class="container">
								<div class="welcome-hero-content">
									<div class="row">
										<div class="col-sm-7">
											<div class="single-welcome-hero">
												@foreach ($slide_3 as $sl3)
												<div class="welcome-hero-txt">
													<input type="hidden" value="{{$sl3->id_product}}">
													<h4>{{$sl3->type_product}}</h4>
													<h2>{{$sl3->name_product}}</h2>
													<p>
														{{$sl3->descriptions}} 
													</p>
													<div class="packages-price">
														<p>
															{{number_format($sl3->price)}} &#8363;
															<del>{{number_format($sl3->price)}} &#8363;</del>
														</p>
													</div>
													<button class="btn-cart welcome-add-cart" onclick="window.location.href='#'">
														<span class="lnr lnr-plus-circle"></span>
														add <span>to</span> cart
													</button>
													<button class="btn-cart welcome-add-cart welcome-more-info" onclick="window.location.href='#'">
														more info
													</button>
												</div><!--/.welcome-hero-txt-->
												@endforeach
											</div><!--/.single-welcome-hero-->
										</div><!--/.col-->
										<div class="col-sm-5">
											<div class="single-welcome-hero">
												<div class="welcome-hero-img">
													<img src="{{ asset('dashboard\upload_img\product/'.$sl3->images) }}" alt="slider image">
												</div><!--/.welcome-hero-txt-->
											</div><!--/.single-welcome-hero-->
										</div><!--/.col-->
									</div><!--/.row-->
								</div><!--/.welcome-hero-content-->
							</div><!-- /.container-->
						</div><!-- /.single-slide-item-->
						
					</div><!-- /.item .active-->
				</div><!-- /.carousel-inner-->

			</div><!--/#header-carousel-->

			<!-- top-area Start -->
			<div class="top-area">
				<div class="header-area">
					<!-- Start Navigation -->
				    <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy"  data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

				        <!-- Start Top Search -->
				        <div class="top-search">
				            <div class="container">
				                <div class="input-group">
				                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
				                    <input type="text" class="form-control" placeholder="Search">
				                    <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
				                </div>
				            </div>
				        </div>
				        <!-- End Top Search -->

				        <div class="container">            
				            <!-- Start Atribute Navigation -->
				            <div class="attr-nav">
				                @include('interiors.blocks.cart')
				            </div><!--/.attr-nav-->
				            <!-- End Atribute Navigation -->

				            <!-- Start Header Navigation -->
				            <div class="navbar-header">
				                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
				                    <i class="fa fa-bars"></i>
				                </button>
								<a class="navbar-brand" href="{{route('index')}}">Interior<span>CS</span>.</a>
				            </div><!--/.navbar-header-->
				            <!-- End Header Navigation -->

				            <!-- Collect the nav links, forms, and other content for toggling -->
				            <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
				                <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
				                    <li class=" scroll active"><a href="#home">home</a></li>
				                    <li><a href="{{route('product')}}">product</a></li>
				                    <li><a href="{{route('blog')}}">blog</a></li>
				                    <li class="scroll"><a href="#newsletter">contact</a></li>
				                </ul><!--/.nav -->
				            </div><!-- /.navbar-collapse -->
				        </div><!--/.container-->
				    </nav><!--/nav-->
				    <!-- End Navigation -->
				</div><!--/.header-area-->
			    <div class="clearfix"></div>

			</div><!-- /.top-area-->
			<!-- top-area End -->

		</header><!--/.welcome-hero-->
		<!--welcome-hero end -->

		<!--populer-products start -->
		<section id="populer-products" class="populer-products">
			<div class="container">
				<div class="populer-products-content">
					<div class="row">
						<div class="col-md-3">
							<div class="single-populer-products">
								<div class="single-populer-product-img mt40">
									<img src="{{ asset('interior/images/populer-products/p1.png') }}" alt="populer-products images">
								</div>
								<h2><a href="#">arm chair</a></h2>
								<div class="single-populer-products-para">
									<p>Nemo enim ipsam voluptatem quia volu ptas sit asperna aut odit aut fugit.</p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="single-populer-products">
								<div class="single-inner-populer-products">
									<div class="row">
										<div class="col-md-4 col-sm-12">
											<div class="single-inner-populer-product-img">
												<img src="{{ asset('interior/images/populer-products/p2.png') }}" alt="populer-products images">
											</div>
										</div>
										<div class="col-md-8 col-sm-12">
											<div class="single-inner-populer-product-txt">
												<h2>
													<a href="#">
														latest designed stool <span>and</span> chair
													</a>
												</h2>
												<p>
													Edi ut perspiciatis unde omnis iste natusina error sit voluptatem accusantium doloret mque laudantium, totam rem aperiam.
												</p>
												<div class="populer-products-price">
													<h4>Sales Start from <span>$99.00</span></h4>
												</div>
												<button class="btn-cart welcome-add-cart populer-products-btn" onclick="window.location.href='#'">
													discover more
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="single-populer-products">
								<div class="single-populer-products">
									<div class="single-populer-product-img">
										<img src="{{ asset('interior/images/populer-products/p3.png') }}" alt="populer-products images">
									</div>
									<h2><a href="#">hanging lamp</a></h2>
									<div class="single-populer-products-para">
										<p>Nemo enim ipsam voluptatem quia volu ptas sit asperna aut odit aut fugit.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!--/.container-->

		</section><!--/.populer-products-->
		<!--populer-products end-->

		<!--new-arrivals start -->
		<section id="new-arrivals" class="new-arrivals"> <!-- Lấy 8 sản phẩm mới nhất-->
			<div class="container">
				<div class="section-header">
					<h2>new arrivals (8 sản phẩm)</h2>
				</div><!--/.section-header-->
				<div class="new-arrivals-content">
					<div class="row">
						@foreach ($product as $products)
						<div class="col-md-3 col-sm-4">
							<div class="single-new-arrival">
								<div class="single-new-arrival-bg">
									<img src="{{ asset('dashboard\upload_img\product/'.$products->images) }}" alt="new-arrivals images">
									<div class="single-new-arrival-bg-overlay"></div>
									<div class="sale bg-1">
										<p>sale</p>
									</div>
									<div class="new-arrival-cart">
										<p>
											<span class="lnr lnr-cart"></span>
											<a href="#">add <span>to </span> cart</a>
										</p>
										<p class="arrival-review pull-right">
											<span class="lnr lnr-heart"></span>
											<span class="lnr lnr-frame-expand"></span>
										</p>
									</div>
								</div>
								<h4><a href="#">{{'['.$products->id_product.']'}} {{$products->name_product}}</a></h4>
								<p class="arrival-product-price">{{number_format($products->price)}} &#8363;</p>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div><!--/.container-->
		
		</section><!--/.new-arrivals-->
		<!--new-arrivals end -->


		<section id="sofa-collection">
			@include('interiors.blocks.unlimit-collection')
		</section>
		<section id="newsletter"  class="newsletter">
			@include('interiors.blocks.news-letter')
		</section><!--/newsletter-->	
		<footer id="footer"  class="footer">
			@include('interiors.blocks.footer')
        </footer>
		
		<!-- Include all js compiled plugins (below), or include individual files as needed -->

		<script src="{{ asset('interior/js/jquery.js') }} "></script>
        
        <!--modernizr.min.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		
		<!--bootstrap.min.js-->
        <script src="{{ asset('interior/js/bootstrap.min.js') }} "></script>
		
		<!-- bootsnav js -->
		<script src="{{ asset('interior/js/bootsnav.js') }} "></script>

		<!--owl.carousel.js-->
        <script src="{{ asset('interior/js/owl.carousel.min.js') }} "></script>


		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
		
        
        <!--Custom JS-->
        <script src="{{ asset('interior/js/custom.js') }} "></script>
        
    </body>
	
</html>