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
            <div class="container-fluid fontCSI">
                <form action="{{ route('update_profile_city', ['id'=>$user['id']]) }}" method="POST">
                    @csrf
                    <div class="row ml-100 mt-100">
                        <h1>Thông tin {{ $user['name'] }}</h1>
                    </div>
                    <div class="row">
                        <div class="form-group mr-3">
                            <label><i class='bx bxl-gmail'></i> Email</label>
                            <input class="form_control_ict mb-2" type="text" name="email" value="{{ $user['email'] }}">
                        </div>
                        <div class="form-group mr-3">
                            <label>Họ tên</label>
                            <input class="form_control_ict" type="text" name="name" value="{{ $user['name'] }}">
                        </div>
                        <div class="form-group mr-3">
                            <label><i class='bx bxl-gmail'></i> Giới tính</label>
                            <input class="form_control_ict mb-2" type="text" name="sex_user" value="{{ $user['sex_user'] }}">
                        </div>
                        <div class="form-group">
                            <label>Ngày sinh</label>
                            <input class="form_control_ict" type="text" name="date_user" value="{{ $user['date_user'] }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mr-3">
                            <label>Số điện thoại </label>
                            <input class="form_control_ict" type="text" name="phone" value="{{ $user['phone'] }}">
                        </div>
                        <div class="form-group slct mr-3">
                            <label>Thành phố</label>
                            <select class="form_control_ict_slct"  name="city" >
                                <option selected>{{ $user['city'] }}</option>
                                @foreach ($city_user as $city)
                                    <option value="{{ $city->name_city }}">{{ $city->name_city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group slct mr-3">
                            <label>Tỉnh</label>
                            <select class="form_control_ict_slct"  name="province" >
                                <option selected>{{ $user['province'] }}</option>
                                @foreach ($city_user as $city)
                                    <option value="{{ $city->city_province }}">{{ $city->city_province }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="submit_profile">
                            <button type="submit">Cập nhật</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group ml-1">
                            <label>Địa chỉ </label>
                            <p>{{ $user['district'] }}, {{ $user['city'] }}, {{ $user['province'] }}</p>
                        </div>
                    </div>
                </form>
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
    @if (session()->has('update_sc'))
      <script>
        swal({
              title: "{{session()->get('update_sc')}}",
              icon: "success",
              button: "OK",
              timer: 2000,
            });
      </script>
    @endif
    @if (session()->has('err'))
      <script>
        swal({
              title: "Thiếu thông tin",
              text: "{{session()->get('err')}}",
              icon: "error",
              button: "OK",
              timer: 2000,
            });
      </script>
    @endif
</body>

</html>