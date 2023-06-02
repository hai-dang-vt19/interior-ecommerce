<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>Interior.CS</title>
    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('interior/assets/img/favicon/logo-interior.png') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="{{ asset('interior/assets/vendor/fonts/boxicons.css') }}" />

    <link rel="stylesheet" href="{{ asset('interior/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('interior/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('interior/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('interior\assets\css\navbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('interior/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('interior/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('interior\css\animate.css') }}">
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{ asset('interior/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('interior/assets/js/config.js') }}"></script>
    <script src="assets/vendor/js/dropdown-hover.js"></script>
    

  </head>
  {{-- <body style="background-image: url(https://images.pexels.com/photos/7914464/pexels-photo-7914464.jpeg)"> --}}
  <body style="background-color: #ffffff">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
        <div class="layout-page">
          <!-- Navbar -->
          @include('interiors2.blocks.navbar')
          <div class="content-wrapper mt-4">
            <!-- Content -->

            <div class="container mt-5">
              {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI elements /</span> Carousel</h4> --}}
              <div class="row row-cols-1 row-cols-md-1 g-4 align-items-center">
                <!-- Bootstrap crossfade carousel -->
                <div class="col mt-5">
                  <div id="carouselExample-cf"class="w-100 carousel carousel-dark slide carousel-fade"data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-bs-target="#carouselExample-cf" data-bs-slide-to="0" class="active"></li>
                      <li data-bs-target="#carouselExample-cf" data-bs-slide-to="1"></li>
                      <li data-bs-target="#carouselExample-cf" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner d-block">
                      <div class="carousel-item active">
                        <img class="d-block w-100 rounded-3" src="{{ asset('interior/assets/img/elements/slide_index1.jpg') }}" alt="First slide" style="max-height: 527px"/>
                        <div class="carousel-caption d-none d-md-block">
                          <h3 class="text-light">First slide</h3>
                          <p class="text-light">Eos mutat malis maluisset et, agam ancillae quo te, in vim congue pertinacia.</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100 rounded-3" src="{{ asset('interior/assets/img/elements/slide_index2.jpg') }}" alt="Second slide" style="max-height: 527px"/>
                        <div class="carousel-caption d-none d-md-block">
                          <h3 class="text-light">Second slide</h3>
                          <p class="text-light">In numquam omittam sea.</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100 rounded-3" src="{{ asset('interior/assets/img/elements/slide_index3.jpg') }}" alt="Third slide" style="max-height: 527px"/>
                        <div class="carousel-caption d-none d-md-block">
                          <h3 class="text-light">Third slide</h3>
                          <p class="text-light">Lorem ipsum dolor sit amet, virtute consequat ea qui, minim graeco mel no.</p>
                        </div>
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample-cf" role="button" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample-cf" role="button" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </a>
                  </div>
                </div>
                <div class="col">
                  <div class="mb-5 mt-4">
                    <div class="divider divider-warning">
                      <div class="divider-text">
                        <figure class="text-center">
                          <blockquote class="blockquote">
                            <p class="fs-4">Họ có một con mắt tuyệt vời để tạo ra xu hướng.</p>
                          </blockquote>
                          <figcaption class="blockquote-footer">
                            Một người nổi tiếng trong <cite title="Source Title">Design Sponge</cite>
                          </figcaption>
                        </figure>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-md">
                  <div class="card mb-3">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img class="card-img card-img-left" src="{{ asset('interior\assets\img\avatars\7.png') }}" alt="Card image" />
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">KTS - Nguyễn Tiến Chung</h5>
                          <p class="card-text">
                            Chung học chuyên ngành thiết kế nội thất tại HAU, trong đó luận án tốt nghiệp của Chung là tất cả về các khía cạnh tương quan của thiết kế nội thất và đồ họa.
                          </p>
                          <p class="card-text"><small class="text-muted">Tốt nghiệp tháng 5 năm 2012</small></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="card mb-3">
                    <div class="row g-0">
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">KTS - Nguyễn Khánh Huyền</h5>
                          <p class="card-text">
                            Huyền học chuyên ngành thiết kế nội thất tại HAU, trong đó luận án tốt nghiệp của Huyền là tất cả về các khía cạnh tương quan của thiết kế nội thất và đồ họa.
                          </p>
                          <p class="card-text"><small class="text-muted">Tốt nghiệp tháng 5 năm 2013</small></p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <img class="card-img card-img-right" src="{{ asset('interior\assets\img\avatars\6.png') }}" alt="Card image" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="container-xxl flex-grow-1 container-p-y mt-5">
              <div class="divider divider-warning">
                <div class="divider-text">
                  <figure class="text-center">
                    <blockquote class="blockquote">
                      <p class="fs-4">Sản phẩm nổi bật.</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                      Chung Si <cite title="Source Title">Interior</cite>
                    </figcaption>
                  </figure>
                </div>
              </div>
            </div>
            <div class="container">
              <div class="row row-cols-1 row-cols-md-3 g-4" >
                <div class="col">
                  <div class="card m-3">
                    <img class="card-img-top" src="{{ asset('interior/assets/img/elements/2.jpg') }}" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Tên sản phẩm</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Mã sản phẩm: </li>
                      <li class="list-group-item">Nhà sản xuất: </li>
                      <li class="list-group-item">Giá tiền: </li>
                    </ul>
                    <div class="card-body">
                      <a href="#" class="card-link text-decoration-none"><i class='bx bxs-heart-circle bx-sm' ></i></a>
                      <a href="#" class="card-link float-end text-decoration-none"><i class='bx bxs-cart-add bx-sm'></i></a>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card m-3">
                    <img class="card-img-top" src="{{ asset('interior/assets/img/elements/2.jpg') }}" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Tên sản phẩm</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Mã sản phẩm: </li>
                      <li class="list-group-item">Nhà sản xuất: </li>
                      <li class="list-group-item">Giá tiền: </li>
                    </ul>
                    <div class="card-body">
                      <a href="#" class="card-link text-decoration-none"><i class='bx bxs-heart-circle bx-sm' ></i></a>
                      <a href="#" class="card-link float-end text-decoration-none"><i class='bx bxs-cart-add bx-sm'></i></a>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card m-3">
                    <img class="card-img-top" src="{{ asset('interior/assets/img/elements/2.jpg') }}" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Tên sản phẩm</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Mã sản phẩm: </li>
                      <li class="list-group-item">Nhà sản xuất: </li>
                      <li class="list-group-item">Giá tiền: </li>
                    </ul>
                    <div class="card-body">
                      <a href="#" class="card-link text-decoration-none"><i class='bx bxs-heart-circle bx-sm' ></i></a>
                      <a href="#" class="card-link float-end text-decoration-none"><i class='bx bxs-cart-add bx-sm'></i></a>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card m-3">
                    <img class="card-img-top" src="{{ asset('interior/assets/img/elements/2.jpg') }}" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Tên sản phẩm</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Mã sản phẩm: </li>
                      <li class="list-group-item">Nhà sản xuất: </li>
                      <li class="list-group-item">Giá tiền: </li>
                    </ul>
                    <div class="card-body">
                      <a href="#" class="card-link text-decoration-none"><i class='bx bxs-heart-circle bx-sm' ></i></a>
                      <a href="#" class="card-link float-end text-decoration-none"><i class='bx bxs-cart-add bx-sm'></i></a>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card m-3">
                    <img class="card-img-top" src="{{ asset('interior/assets/img/elements/2.jpg') }}" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Tên sản phẩm</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Mã sản phẩm: </li>
                      <li class="list-group-item">Nhà sản xuất: </li>
                      <li class="list-group-item">Giá tiền: </li>
                    </ul>
                    <div class="card-body">
                      <a href="#" class="card-link text-decoration-none"><i class='bx bxs-heart-circle bx-sm' ></i></a>
                      <a href="#" class="card-link float-end text-decoration-none"><i class='bx bxs-cart-add bx-sm'></i></a>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card m-3">
                    <img class="card-img-top" src="{{ asset('interior/assets/img/elements/2.jpg') }}" alt="Card image cap" />
                    <div class="card-body">
                      <h5 class="card-title">Tên sản phẩm</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Mã sản phẩm: </li>
                      <li class="list-group-item">Nhà sản xuất: </li>
                      <li class="list-group-item">Giá tiền: </li>
                    </ul>
                    <div class="card-body">
                      <a href="#" class="card-link text-decoration-none"><i class='bx bxs-heart-circle bx-sm' ></i></a>
                      <a href="#" class="card-link float-end text-decoration-none"><i class='bx bxs-cart-add bx-sm'></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
            <!-- Footer -->
            @include('interiors2.blocks.footer')
            <!-- / Footer -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('interior/assets/vendor/libs/masonry/masonry.js') }}"></script>
    <script src="{{ asset('interior/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('interior/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('interior/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('interior/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('interior/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script src="{{ asset('interior/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('interior/assets/js/main.js') }}"></script>
    <script src="{{ asset('interior\assets\vendor\js\menu.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('interior/assets/js/dashboards-analytics.js') }}"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </body>
</html>
