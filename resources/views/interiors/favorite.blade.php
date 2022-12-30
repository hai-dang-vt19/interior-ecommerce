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
        <div class="single-product-area body_favo">
            <div class="">
                <div class="row">
                    <div class="col-10">
                        <h3 class="text-center">Danh sách sản phẩm yêu thích của bạn</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table_favo_2">
                                <thead>
                                    <tr style="background-color: #FBB710">
                                      <th style="color: white;font-size: 14px">STT</th>
                                      <th style="color: white;font-size: 14px">MSP</th>
                                      <th style="color: white;font-size: 14px">Tên sản phẩm</th>
                                      <th style="color: white;font-size: 14px">Giá tiền</th>
                                      <th style="color: white;font-size: 14px">Hình ảnh</th>
                                      <th colspan="2" style="color: white;font-size: 14px">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($favorite as $key => $favo)
                                    <tr>
                                      <td scope="row">{{$key+1}}</td>
                                      <td>{{$favo->id_product}}</td>
                                      <td>{{$favo->name_product}}</td>
                                      <td>{{number_format($favo->price)}} &#8363;</td>
                                      <td>
                                        <div class="d-flex">
                                          <img src="{{ asset('dashboard\upload_img\product/'.$favo->img) }}" alt=""  style="max-width: 39px;max-height: 42px">  
                                        </div>
                                      </td>
                                      <td>{{$favo->status_product}}</td>
                                      <td>
                                        <a href="{{ route('destroy_favorite_user', ['id'=>$favo->id_product]) }}"><i class='bx bx-x bx-sm'></i></a>
                                      </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                        <div class="pagination justify-content-end mt-10">
                            {{$favorite->links()}}
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
</body>

</html>