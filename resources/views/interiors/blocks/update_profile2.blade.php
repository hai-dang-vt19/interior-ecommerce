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
                    <li><a href="{{route('index')}}">Trang chủ</a></li>
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
            <div class="container fontCSI">
                <form action="{{ route('update_profile_city_cart', ['id'=>Auth::user()->id]) }}" method="POST">
                    <div class="row ml-100 mt-100 mb-50 d-flex">
                        @csrf
                        <h1>Cập nhật địa chỉ</h1>
                    </div>
                    <div class="row d-flex">
                        <div class="form-group">
                            <label><i class='bx bxl-gmail'></i> Địa chỉ cụ thể</label>
                            <input class="form_control_ict_cty mb-2" type="text" name="district" value="{{ Auth::user()->district }}">
                        </div>
                        <div class="form-group ml-5">
                            <label>Thành phố - Tỉnh</label>
                            <input class="form_control_ict_cty" type="text" value="{{ $cty_user['name_city'] }} - {{ $cty_user['city_province'] }}" disabled>
                            <input type="hidden" name="city" value="{{ $cty_user['name_city'] }}">
                            <input type="hidden" name="province" value="{{ $cty_user['city_province'] }}">
                        </div>
                        <div class="row btn_update_city">
                            <button type="submit">Cập nhật</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="dropdown">
                        <button onclick="myFunction()" class="dropbtn">Chọn địa chỉ cập nhật</button>
                        <div id="myDropdown" class="dropdown-content">
                          @foreach ($city_user as $city)
                              <a href="{{ route('update_profile_get_city', ['id'=>$city->id]) }}">{{ $city->name_city }}</a>
                          @endforeach
                        </div>
                    </div>
                    <script>
                        function myFunction() 
                        {
                            document.getElementById("myDropdown").classList.toggle("show");
                        }

                        // Close the dropdown menu if the user clicks outside of it
                        window.onclick = function(event) 
                        {
                            if (!event.target.matches('.dropbtn')) 
                            {
                                var dropdowns = document.getElementsByClassName("dropdown-content");
                                var i;
                                for (i = 0; i < dropdowns.length; i++) {
                                    var openDropdown = dropdowns[i];
                                    if (openDropdown.classList.contains('show')) 
                                    {
                                        openDropdown.classList.remove('show');
                                    }
                                }
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
        <!-- Product Details Area End -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->
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
    @if (session()->has('gd'))
      <script>
        swal({
              title: "{{session()->get('gd')}}",
              icon: "success",
              button: "OK",
              timer: 2000,
            });
      </script>
    @endif
</body>

</html>