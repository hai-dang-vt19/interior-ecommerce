<ul>
    <li class="search">
        <a href="#"><span class="lnr lnr-magnifier"></span></a>
    </li><!--/.search-->
    <li class="nav-setting">
        <a href="{{route('logout')}}"><span class="lnr lnr-user"></span></a>
    </li><!--/.search-->
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
            <span class="lnr lnr-cart"></span>
            <span class="badge badge-bg-1">2</span>
        </a>
        <ul class="dropdown-menu cart-list s-cate">
            <li class="single-cart-list">
                <a href="#" class="photo"><img src="{{ asset('interior/images/collection/arrivals1.png') }}" class="cart-thumb" alt="image" /></a>
                <div class="cart-list-txt">
                    <h6><a href="#">arm <br> chair</a></h6>
                    <p>1 x - <span class="price">180.000đ</span></p>
                </div><!--/.cart-list-txt-->
                <div class="cart-close">
                    <span class="lnr lnr-cross"></span>
                </div><!--/.cart-close-->
            </li><!--/.single-cart-list -->
            <li class="total">
                <span>Tổng: 0đ</span>
                <button class="btn-cart pull-right" onclick="window.location.href='#'">Giỏ hàng</button>
            </li>
        </ul>
    </li><!--/.dropdown-->
</ul>