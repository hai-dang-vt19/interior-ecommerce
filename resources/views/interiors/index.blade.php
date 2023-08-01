<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
  @include('interiors.blocks.head')

  {{-- <body style="background-image: url(https://images.pexels.com/photos/7914464/pexels-photo-7914464.jpeg)"> --}}
  <body style="background-color: #ffffff">
    @include('interiors.blocks.backGround')
    @php
    use App\Models\Hosts;
    $hosts = Hosts::where('active','y')->get();
    foreach ($hosts as $hts) {
        $host = $hts->host;
    }
    @endphp
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
        <div class="layout-page">
          <!-- Navbar -->
          @include('interiors.blocks.navbar')
          <div class="content-wrapper mt-4">
            <!-- Content -->
            <div class="container mt-5">
              {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI elements /</span> Carousel</h4> --}}
              <div class="row row-cols-1 row-cols-md-1 g-4 align-items-center">
                <!-- Bootstrap crossfade carousel -->
                <div class="col mt-5">
                  <div id="carouselExample-cf"class="w-100 carousel slide carousel-fade"data-bs-ride="carousel">
                    @php
                      $sl_active = $head_slide->where('type_product','1');
                      foreach($sl_active as $itm_sl_active){
                        $title = $itm_sl_active->name_product;
                        $des = $itm_sl_active->descriptions;
                        $images = $itm_sl_active->images;
                      }
                      $sl_next = $head_slide->where('type_product','!=','1');
                    @endphp
                    <div class="carousel-inner d-block">
                      <div class="carousel-item active">
                        <img class="d-block w-100 rounded-3" src="{{ asset('dashboard\upload_img\product/'.$images) }}" alt="First slide" style="max-height: 527px;"/>
                        <div class="carousel-caption d-none d-md-block">
                          <h3 style="color: #ffffff;text-shadow: black 0.1em 0.1em 0.2em;">{{ $title }}</h3>
                          <p style="color: #ffffff;text-shadow: black 0.1em 0.1em 0.2em;">{{ $des }}</p>
                        </div>
                      </div>
                      @foreach ($sl_next as $itm_sl_next_img)
                        <div class="carousel-item">
                          <img class="d-block w-100 rounded-3" src="{{ asset('dashboard\upload_img\product/'.$itm_sl_next_img->images) }}" alt="Second slide" style="max-height: 527px;"/>
                          <div class="carousel-caption d-none d-md-block">
                            <h3 style="color: #ffffff;text-shadow: black 0.1em 0.1em 0.2em;">{{ $itm_sl_next_img->name_product }}</h3>
                            <p style="color: #ffffff;text-shadow: black 0.1em 0.1em 0.2em;">{{ $itm_sl_next_img->descriptions }}</p>
                          </div>
                        </div>
                      @endforeach
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
              </div>
            </div>
            <div class="container-xxl flex-grow-1 container-p-y mt-5">
              <div class="divider divider-warning">
                <div class="divider-text">
                  <figure class="text-center">
                    <blockquote class="blockquote">
                      <p class="fs-4" style="font-family: 'Quicksand', sans-serif;">Họ có một con mắt tuyệt vời để tạo ra xu hướng.</p>
                    </blockquote>
                    <figcaption class="blockquote-footer fs-6"  style="font-family: 'Raleway', sans-serif;">
                      Một người nổi tiếng trong Design Sponge
                    </figcaption>
                  </figure>
                </div>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-lg">
                  <div class="card mb-3">
                    <div class="row g-0">
                      <div class="col-lg-4">
                        <img class="card-img card-img-left" src="{{ asset('interior\assets\img\avatars\7.png') }}" alt="Card image" />
                      </div>
                      <div class="col-lg-8">
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
                <div class="col-lg">
                  <div class="card mb-3">
                    <div class="row g-0">
                      <div class="col-lg-8">
                        <div class="card-body">
                          <h5 class="card-title">KTS - Nguyễn Khánh Huyền</h5>
                          <p class="card-text">
                            Huyền học chuyên ngành thiết kế nội thất tại HAU, trong đó luận án tốt nghiệp của Huyền là tất cả về các khía cạnh tương quan của thiết kế nội thất và đồ họa.
                          </p>
                          <p class="card-text"><small class="text-muted">Tốt nghiệp tháng 5 năm 2013</small></p>
                        </div>
                      </div>
                      <div class="col-lg-4">
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
                      <p class="fs-4"  style="font-family: 'Quicksand', sans-serif;">Sản phẩm nổi bật.</p>
                    </blockquote>
                    <figcaption class="blockquote-footer fs-6"  style="font-family: 'Raleway', sans-serif;">
                      Chung Si Interior
                    </figcaption>
                  </figure>
                </div>
              </div>
            </div>
            <div class="container mb-4">
              <div class="row row-cols-1 row-cols-md-3 g-4" >
                @foreach ($product_9slide as $item_9slide)
                  @php
                      $url = $host.'rdr/qrcode/'.$item_9slide->id_product;
                  @endphp
                  <div class="col">
                    <div class="card m-3">
                      <a href="{{ route('search_interior_client', ['key'=>$item_9slide->id_product]) }}">
                        <img class="card-img-top h-px-400" src="{{ asset('dashboard\upload_img\product/'.$item_9slide->images) }}" alt="Card image cap"  />
                      </a>
                      <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('search_interior_client', ['key'=>$item_9slide->id_product]) }}" class="text-warning">{{ $item_9slide->name_product }}</a></h5>
                        <p class="card-text max_dot">{{ $item_9slide->descriptions }}</p>
                      </div>
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">Mã sản phẩm: {{ $item_9slide->id_product }}</li>
                        <li class="list-group-item">Loại sản phẩm: {{ $item_9slide->type_product }}</li>
                        <li class="list-group-item">Giá tiền: {{ number_format($item_9slide->price) }} &#8363;
                          <span>
                            <a href="{{ route('create_favorite', ['id'=>$item_9slide->id_product]) }}" class="card-link text-decoration-none float-end"><i class='bx bxs-heart-circle bx-sm text-danger' ></i></a>
                            <a href="#" class="card-link text-decoration-none float-end me-2" data-bs-toggle="modal" data-bs-target="#qr{{$item_9slide->id_product}}"><i class='bx  bx-qr-scan bx-sm' ></i></a>
                          </span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  {{-- Modal QRCODE --}}
                  <div class="modal fade" id="qr{{$item_9slide->id_product}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center text-center">
                                {{ QrCode::color(251,183,16)->size(250)->generate($url) }}
                                <h5 class="mt-5">{{ $item_9slide->name_product }}</h5>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- / Modal --}}
                @endforeach
              </div>
            </div>
            <!-- / Content -->
            <!-- Footer -->
            @include('interiors.blocks.footer')
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

    @include('interiors.blocks.foo')
  </body>
</html>
