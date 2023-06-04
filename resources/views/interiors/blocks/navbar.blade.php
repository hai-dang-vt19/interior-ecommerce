{{-- <nav
    class="layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme ms-4"
    id="navbar"
> --}}
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
        <a class="nav-item nav-link active" href="{{ route('index') }}">Trang chủ</a>
        <a class="nav-item nav-link active" href="{{ route('product') }}">Sản phẩm</a>
        <a class="nav-item nav-link text-secondary" href="javascript:void(0)">Liên hệ</a>
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

        <a href="#" type="button" class="btn btn-outline-warning btn-sm">
          <i class='bx bxs-cart-alt'></i>
        </a>
      </div>
      @if (Auth::user() == null)
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
              <a class="dropdown-item" href="#">
                <i class="bx bx-user me-2"></i>
                <span class="align-middle">Hồ sơ</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#">
                <i class="bx bx-credit-card me-2"></i>
                <span class="align-middle">Đơn hàng</span>
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
<!-- Modal -->
<div class="modal fade" id="modalTop" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
  <div class="modal-dialog modal-dialog-top" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-warning" id="modalCenterTitle">Tìm kiếm tại đây</h5>
        {{-- <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button> --}}
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="nameWithTitle" class="form-label">Name</label>
            <input
              type="text"
              id="nameWithTitle"
              class="form-control"
              placeholder="Enter Name"
            />
          </div>
        </div>
        <div class="row g-2">
          <div class="col mb-0">
            <label for="emailWithTitle" class="form-label">Email</label>
            <input
              type="text"
              id="emailWithTitle"
              class="form-control"
              placeholder="xxxx@xxx.xx"
            />
          </div>
          <div class="col mb-0">
            <label for="dobWithTitle" class="form-label">DOB</label>
            <input
              type="text"
              id="dobWithTitle"
              class="form-control"
              placeholder="DD / MM / YY"
            />
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>