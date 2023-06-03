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
    z-index: 1075;
    opacity: 95%;
  "
  id="navbar"
>
  <div class="container-fluid ms-4">
    <a class="navbar-brand" href="javascript:void(0)">
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
        <a class="nav-item nav-link active" href="javascript:void(0)">Trang chủ</a>
        <div class="btn-group nav-item nav-link">
          <a href="#"
            class="dropdown-toggle hide-arrow text-decoration-none text-secondary"
            data-bs-toggle="dropdown"
          >
            Sản phẩm
          </a>
          <ul class="dropdown-menu">
            @foreach ($types as $item_type)
            <li>
              <a href="#" class="dropdown-item">{{ $item_type->name_type }}</a>
            </li>
            @endforeach
          </ul>
        </div>
        <a class="nav-item nav-link text-secondary" href="javascript:void(0)">Liên hệ</a>
      </div>
      <div class="me-5">
        <!-- Button trigger modal -->
        
      </div>

      <div class="btn-group" role="group" aria-label="Basic example">
        <button
          type="button"
          class="btn btn-outline-warning btn-sm"
          data-bs-toggle="modal"
          data-bs-target="#modalCenter"
        >
          <i class='bx bx-search-alt-2'></i>
        </button>
        <!-- Modal -->
        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
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

        <a href="#" type="button" class="btn btn-outline-warning btn-sm">
          <i class='bx bxs-cart-alt'></i>
        </a>
      </div>
    
      <div class="nav-item navbar-dropdown dropdown-user dropdown d-block">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="{{ asset('interior\assets\img\avatars\7.png') }}" alt class="w-px-40 h-auto rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <img src="{{ asset('interior\assets\img\avatars\7.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block">John Doe</span>
                  <small class="text-muted">Admin</small>
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
              <span class="align-middle">My Profile</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="bx bx-cog me-2"></i>
              <span class="align-middle">Settings</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <span class="d-flex align-items-center align-middle">
                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                <span class="flex-grow-1 align-middle">Billing</span>
                <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
              </span>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="auth-login-basic.html">
              <i class="bx bx-power-off me-2"></i>
              <span class="align-middle">Log Out</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  {{-- <div class="navbar-nav-right d-flex align-items-center px-3" id="navbar-collapse">
    <div class="row">
      <div class="col align-self-start">
        <div class="nav-item align-items-center">
          <a href="#">
            <img src="{{ asset('interior\img\core-img\logo.png') }}" alt="" >
          </a>
        </div>
      </div>
      <div class="col align-self-center text-center">
        <div class="nav-item d-flex align-items-center">
          <form action="">
            @csrf
            <input type="text" class="form-control border-0 shadow-none" placeholder="Tìm kiếm ... " aria-label="Search..."/>
          </form>
        </div>
      </div>
    </div>
    
    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <!-- Place this tag where you want the button to render. -->
      <li class="nav-item lh-1 me-5">
          <a href="#" class="text-decoration-none text-dark fs-5 ">
              Trang chủ
          </a>
      </li>
      <li class="nav-item lh-1 me-5">
        <div class="btn-group">
          <a href="#"
            class="dropdown-toggle hide-arrow text-decoration-none text-dark fs-5 "
            data-bs-toggle="dropdown"
          >
            Sản phẩm
          </a>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button">Action</button></li>
            <li><button class="dropdown-item" type="button">Another action</button></li>
            <li><button class="dropdown-item" type="button">Something else here</button></li>
          </ul>
        </div>
      </li>
      <li class="nav-item lh-1 me-5">
          <a href="#" class="text-decoration-none text-dark fs-5 ">
              Liên hệ
          </a>
      </li>
      <li class="nav-item lh-1 me-5">
        <a
          class="btn btn-sm btn-outline-warning"
          href="#"
        >Đơn hàng</a>
      </li>

      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="{{ asset('interior\assets\img\avatars\7.png') }}" alt class="w-px-40 h-auto rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <img src="{{ asset('interior\assets\img\avatars\7.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block">John Doe</span>
                  <small class="text-muted">Admin</small>
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
              <span class="align-middle">My Profile</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="bx bx-cog me-2"></i>
              <span class="align-middle">Settings</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <span class="d-flex align-items-center align-middle">
                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                <span class="flex-grow-1 align-middle">Billing</span>
                <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
              </span>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="auth-login-basic.html">
              <i class="bx bx-power-off me-2"></i>
              <span class="align-middle">Log Out</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div> --}}
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