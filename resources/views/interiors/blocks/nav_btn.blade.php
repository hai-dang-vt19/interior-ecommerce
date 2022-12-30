<div class="amado-btn-group mt-30 mb-100">
    {{-- <a href="{{ route('new_product') }}" class="btn amado-btn mb-15">New this week</a> --}}
    <!-- Nút Để  Mở Modal -->
    <button id="myBtn" class="btn amado-btn ">Tìm kiếm</button>
    <!-- Modal Cho Website -->
    <div id="myModal" class="modal">
    <!-- Nội Dung Modal -->
    <div class="modal-content">
        <div>
            <span class="close">&times;</span>
        </div>
        <div >
            <form action="{{ route('search_interior_client') }}" method="get">
                <div class="d-flex item_search">
                    <input type="search" name="search" id="search" placeholder="Tìm kiếm tại đây" class="inte_search">
                 <button type="submit"><i class='bx bx-search-alt-2 bx-xs'></i></button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script>
            /* lấy phần tử modal */
        var modal = document.getElementById("myModal");

        /* thiết lập nút mở modal */
        var btn = document.getElementById("myBtn");

        /* thiết lập nút đóng modal */
        var span = document.getElementsByClassName("close")[0];

        /* Sẽ hiển thị modal khi người dùng click vào */
        btn.onclick = function() {
        modal.style.display = "block";
        }

        /* Sẽ đóng modal khi nhấn dấu x */
        span.onclick = function() {
        modal.style.display = "none";
        }

        /*Sẽ đóng modal khi nhấp ra ngoài màn hình*/
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }
    </script>
    <a href="{{ route('new_product') }}" class="btn amado-btn active mt-15">New this week</a>
</div>
<div class="cart-fav-search font_nav_btn mb-100">
    <a class="d-flex" href="{{ route('cart') }}"><i class='bx bx-cart-alt bx-sm mr-2'></i> 
        <p class="font_nav_btn">Giỏ hàng</p>
    </a>
    <a class="d-flex" href="{{ route('favorite_user') }}"><i class='bx bx-heart-circle bx-sm mr-2'></i> 
        <p class="font_nav_btn">Yêu thích</p>
    </a>
    {{-- <a class="d-flex" href="#" class="search-nav"><i class='bx bx-search-alt-2 bx-sm mr-2'></i> 
        <p class="font_nav_btn">Tìm kiếm</p>
    </a> --}}
    <a class="d-flex" href="{{ route('profile_user') }}"><i class='bx bx-user-circle bx-sm mr-2'></i> 
        <p class="font_nav_btn">Tài khoản</p>
    </a>
    <a class="d-flex" href="{{ route('logout') }}"><i class='bx bx-log-out bx-sm mr-2'></i> 
        <p class="font_nav_btn">Đăng xuất</p>
    </a>
</div>
<div class="social-info d-flex justify-content-between">
    <a href="{{ route('index') }}"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
    <a href="{{ route('index') }}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
    <a href="{{ route('index') }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
    <a href="{{ route('index') }}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
</div>