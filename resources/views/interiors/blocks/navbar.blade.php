<nav class="ms-4 navbar navbar-example navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" 
  style="
    width: calc(100% - (1.625rem * 2));
    margin: 1rem auto 0;
    border-radius: 0.375rem;
    padding: 0 1.5rem;
    z-index: 1020;
    opacity: 95%;
  "
  id="navbar"
>
  <div class="container-fluid ms-4">
    <a class="navbar-brand" href="{{ route('index') }}">
      <img src="{{ asset('interior\img\core-img\logo-client.png') }}" alt="" >
    </a>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbar-ex-2"
      aria-controls="navbar-ex-2"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class='bx bx-menu'></i>
    </button>

    <div class="collapse navbar-collapse ms-4" id="navbar-ex-2">
      <div class="navbar-nav me-auto">
        <div>
          <a class="nav-item nav-link fs-6" href="{{ route('index') }}">Trang chủ</a>
        </div>
        <div class="btn-group">
          <a class="nav-item nav-link fs-6 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false" href="#">Sản phẩm</a>
          <ul class="dropdown-menu mt-1 text-uppercase">
            @foreach ($types as $item_type_footer)
              <li>
                <li><a class="dropdown-item" href="{{ route('get_with_type', ['type'=>$item_type_footer->name_type]) }}">{{ $item_type_footer->name_type }}</a></li>
              </li>
            @endforeach
            <li>
              <hr class="dropdown-divider" />
            </li>
            <li><a class="dropdown-item" href="{{ route('product') }}">Tất cả sản phẩm</a></li>
          </ul>
        </div>
        <div>
          <a class="nav-item nav-link fs-6" href="{{ route('contact') }}">Liên hệ</a>
        </div>
      </div>
      <div class="btn-group" role="group" aria-label="Basic example">
        <button
          type="button"
          class="btn btn-outline-warning btn-sm"
          data-bs-toggle="modal"
          data-bs-target="#modalTop"
        >
          <i class='bx bx-search-alt-2'></i>
        </button>
        {{-- Modal ở dưới cùng --}}
        @if (!empty(Auth::user()))
          <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalScrollable">
            <i class='bx bxs-cart-alt'></i>
          </button>
        @endif
      </div>
      @if (empty(Auth::user()))
        <div class="nav-item d-block ms-4"><a href="{{ route('login') }}" class="btn btn-secondary btn-sm">Đăng nhập</a></div>
      @else
        <div class="nav-item navbar-dropdown dropdown-user dropdown d-block">
          <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            <div class="avatar avatar-online">
              @if (Auth::user()->image == null)
                <img src="{{ asset('interior\assets\img\avatars\7.png') }}" alt class="w-px-40 h-auto rounded-circle" />
              @else
                <img src="{{ asset('interior\assets\img\avatars/'.Auth::user()->image) }}" alt class="w-px-40 h-auto rounded-circle" />  
              @endif
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="#">
                <div class="d-flex">
                  <div class="flex-shrink-0 me-3">
                    <div class="avatar avatar-online">
                      @if (Auth::user()->image == null)
                        <img src="{{ asset('interior\assets\img\avatars\7.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                      @else
                        <img src="{{ asset('interior\assets\img\avatars/'.Auth::user()->image) }}" alt class="w-px-40 h-auto rounded-circle" />
                      @endif
                    </div>
                  </div>
                  <div class="flex-grow-1">
                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('profile') }}">
                <i class="bx bx-user text-info me-2"></i>
                <span class="align-middle">Hồ sơ</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('cart') }}">
                <i class="bx bxs-cart-alt text-warning me-2"></i>
                <span class="align-middle">Giỏ hàng</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('bill') }}">
                <i class="bx bx-credit-card text-success me-2"></i>
                <span class="align-middle">Đơn hàng</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('favorite_user') }}">
                <i class='bx bxs-heart-circle text-danger me-2' ></i>
                <span class="align-middle">Sản phẩm</span>
              </a>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                <i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Log Out</span>
              </a>
            </li>
          </ul>
        </div>
      @endif
    </div>
  </div>
  <script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
      var currentScrollPos = window.pageYOffset;
      if (prevScrollpos > currentScrollPos) {
        document.getElementById("navbar").style.top = "0";
      } else {
        document.getElementById("navbar").style.top = "-100px";
      }
      prevScrollpos = currentScrollPos;
    }
  </script>
</nav>
<!-- Modal tìm kiếm -->
<div class="modal fade" id="modalTop" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-top modal-lg" role="document">
    <form action="{{ route('search_interior_client') }}" method="GET">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <div class="container justify-content-center">
            <input type="text" class="form-control rounded-pill" placeholder="Nhập tên sản phẩm" name="key"/>
          </div>
        </div>
        <div class="modal-body">
          <div class="form-check form-switch mb-2">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" value="1" name="check"/>
            <label class="form-check-label" for="flexSwitchCheckDefault"
              >Tìm kiếm với mệnh giá và loại sản phẩm
            </label>
          </div>
          <div class="px-5">
            <div class="row g-2 mt-3"> @php $maxs = ceil($max); @endphp
              <div class="col mb-0">
                <label class="form-label">Min: <span id="op_min" class="text-warning"></span></label>
                <div class="px-5">
                  <input type="range" class="form-range" min="0" max="{{ $maxs }}" step="100000" value="0"  id="ip_min" name="min">
                </div>
                <script>
                    const op_min = document.querySelector("#op_min")
                    const ip_min = document.querySelector("#ip_min")
                    op_min.textContent = ip_min.value
                    ip_min.addEventListener("input", (event) => {
                        op_min.textContent = event.target.value
                    })
                </script>
              </div>
              <div class="col mb-0">
                <label class="form-label">Max: <span id="op_max" class="text-danger"></span></label>
                <div class="px-5">
                  <input type="range" class="form-range" min="0" max="{{ $maxs }}" step="100000" value="{{ $maxs }}"  id="ip_max" name="max">
                </div>
                <script>
                    const op_max = document.querySelector("#op_max")
                    const ip_max = document.querySelector("#ip_max")
                    op_max.textContent = ip_max.value
                    ip_max.addEventListener("input", (event) => {
                      op_max.textContent = event.target.value
                    })
                </script>
              </div>
            </div>
          </div>
          <div class="px-5">
            <div class="col mb-0">
              <label class="form-label">Loại sản phẩm: <span id="op_min" class="text-warning"></span></label>
              <div class="px-5">
                @foreach ($types as $item_type_nav)
                  <div>
                    <input name="types_nav" class="form-check-input" type="radio" value="{{ $item_type_nav->name_type }}" id="{{ $item_type_nav->name_type }}"/>
                    <label class="form-check-label" for="{{ $item_type_nav->name_type }}"> {{ $item_type_nav->name_type }} </label>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
      </div>
    </form>
  </div>
</div>
@if (!empty(Auth::user()))    
  <!-- Modal -->
  <div class="modal fade" id="modalScrollable" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content"> {{--carts--}}
        <div class="modal-header">
          @php
              $lst_cart = $carts->get();
              $count_cart = $carts->count();
          @endphp
          <a href="{{ route('cart') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Click xem danh sách đơn hàng">
            <h5 class="hover_link_bottom modal-title" id="modalScrollableTitle">Xem danh sách đơn hàng: {{ $count_cart }} đơn</h5>
          </a>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @if ($lst_cart == '[]')
            <div class="row g-0 mb-3">
              <div class="col-lg">
                <div class="container">
                  <p class="text-center mt-3 text-info fs-5">Chưa có sản phẩm</p>
                </div>
              </div>
            </div>
          @else
            @foreach ($lst_cart as $itm_cart_nav)
              <form action="" method="">
                @csrf
                <hr>
                <div class="row g-0 mb-3">
                  <div class="col-lg-4">
                    <img class="card-img card-img-left" src="{{ asset('dashboard\upload_img\product/'.$itm_cart_nav->image_product) }}" alt="Card image" />
                  </div>
                  <div class="col-lg-8">
                    <div class="card-body">
                          <a href="{{ route('destroy_cart_product', ['id'=>$itm_cart_nav->id, 'id_pr'=>$itm_cart_nav->id_product, 'amount_pr'=>$itm_cart_nav->amount_product]) }}" type="button" class="btn btn-outline-danger btn-xs float-end rounded-pill">Xóa</a>
                          <h5 class="card-title">{{ $itm_cart_nav->name_product }} - {{ $itm_cart_nav->id_product }}</h5>
                          <p class="card-text max_dot">
                            Giá tiền:
                              @if ($itm_cart_nav->sales == 0)
                                  {{ number_format($itm_cart_nav->price_product) }} &#8363;
                              @else
                                  <span class="text-decoration-line-through text-muted">{{ number_format($itm_cart_nav->price_product) }} &#8363;</span>
                                  &emsp;<i class='bx bxs-offer bx-tada text-danger' ></i>&ensp;{{ number_format($itm_cart_nav->sales) }} &#8363;
                              @endif
                          </p>
                          <p class="card-text">
                            <small class="text-muted">Số lượng mua: {{ $itm_cart_nav->amount_product }}</small>
                          </p>
                          <a href="{{ route('cart', ['id_product'=>$itm_cart_nav->id_product,]) }}" class="btn btn-success btn-sm float-end">Đặt hàng</a>
                    </div>
                  </div>
                </div>
              </form>
            @endforeach 
          @endif
        </div>
      </div>
    </div>
  </div>  
@endif