<div class="position-absolute bottom-0 end-0 me-5 mb-5" style="z-index: 2">
    <a href="#" class="position-fixed"><i class='bx bxs-chevron-up-circle text-warning fs-1'></i></a>
</div>
<footer class="content-footer footer bg-footer-theme px-5" style="z-index: 1">
  <div class="container-fluid pt-5 pb-4">
    <div class="row">
      <div class="divider divider-secondary">
        <div class="divider-text">
          <p class="fs-4 text-dark" style="font-family: 'Quicksand', sans-serif;">Một số đánh giá từ khách hàng của Chung SI</p>
        </div>
      </div>
    </div>
    <div class="row mb-5 justify-content-center">
      <div class="col-md-8">
        <div id="carouselExample-cf2"class="w-100 carousel carousel-dark slide carousel-fade"data-bs-ride="carousel">
          <div class="carousel-inner d-block">
            <div class="carousel-item d-flex justify-content-center active">
              <div class="card">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img class="card-img card-img-left" src="{{ asset('interior/assets/img/elements/13.jpg') }}" alt="Card image" />
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text max_dot">
                              This is a wider card with supporting text below as a natural lead-in to additional content.
                              This content is a little bit longer.
                            </p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="carousel-item d-flex justify-content-center">
              <div class="card">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img class="card-img card-img-left" src="{{ asset('interior/assets/img/elements/12.jpg') }}" alt="Card image" />
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text max_dot">
                              This is a wider card with supporting text below as a natural lead-in to additional content.
                              This content is a little bit longer.
                            </p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="carousel-item d-flex justify-content-center">
              <div class="card">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img class="card-img card-img-left" src="{{ asset('interior/assets/img/elements/11.jpg') }}" alt="Card image" />
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text max_dot">
                              This is a wider card with supporting text below as a natural lead-in to additional content.
                              This content is a little bit longer.
                            </p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <hr>
    </div>
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3 mb-4 mb-sm-0">
        <h4 class="fw-bolder mb-3"><a href="#" target="_blank" class="footer-text">Chung Si Interior </a></h4><span>Cảm ơn bạn đã ghé thăm</span>
        <div class="social-icon my-3">
          <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-facebook"><i class='bx bxl-facebook'></i></a>
          <a href="javascript:void(0)" class="ms-2 btn btn-icon btn-sm btn-twitter"><i class='bx bxl-twitter'></i></a>
          <a href="javascript:void(0)" class="ms-2 btn btn-icon btn-sm btn-linkedin"><i class='bx bxl-linkedin'></i></a>
          <a href="javascript:void(0)" class="ms-2 btn btn-icon btn-sm btn-github"><i class='bx bxl-github'></i></a>
        </div>
        <p class="pt-4">
          <script>
          document.write(new Date().getFullYear())
          </script> || Hỗ trợ: +84 947508288
        </p>
      </div>
      <div class="col-12 col-sm-6 col-md-3 mb-4 mb-md-0">
        <h5>Menu</h5>
        <ul class="list-unstyled">
          <li><a href="{{ route('index') }}" class="footer-link d-block pb-2">Trang chủ</a></li>
          <li><a href="{{ route('product') }}" class="footer-link d-block pb-2">Sản phẩm</a></li>
          <li><a href="{{ route('contact') }}" class="footer-link d-block pb-2">Liên hệ</a></li>
          <li><a href="javascript:void(0)" class="footer-link d-block pb-2">Giỏ hàng</a></li>
        </ul>
      </div>
      <div class="col-12 col-sm-6 col-md-3 mb-4 mb-sm-0">
        <h5>Loại sản phẩm</h5>
        <ul class="list-unstyled">
          @foreach ($types as $item_type_footer)
            <li>
              <a href="#" class="footer-link d-block pb-2">{{ $item_type_footer->name_type }}</a>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="col-12 col-sm-6 col-md-3">
        <h5>Nhà cung cấp sản phẩm</h5>
        <ul class="list-unstyled">
          @foreach ($suppliers as $item_suppliers_footer)
            <li><a href="#" class="footer-link d-block pb-2">{{ $item_suppliers_footer->name_supplier }}</a></li>  
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</footer>