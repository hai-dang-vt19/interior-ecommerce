<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
  @include('interiors.blocks.head')

  {{-- <body style="background-image: url(https://images.pexels.com/photos/7914464/pexels-photo-7914464.jpeg)"> --}}
  <body style="background-color: #ffffff">
    @include('interiors.blocks.backGround')
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
        <div class="layout-page">
          <!-- Navbar -->
          @include('interiors.blocks.navbar')
          <div class="content-wrapper mt-4 ps-5">
            <!-- Content -->
            <div class="container mt-5">
              {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI elements /</span> Carousel</h4> --}}
              <div class="row mt-5" data-masonry='{"percentPosition": true }'>
                @foreach ($favorite as $itm_favo)
                    <div class="col-sm-6 col-lg-4 mb-4">
                        <div class="card w-75 ms-4">
                            <img class="card-img-top" src="{{ asset('dashboard\upload_img\product/'.$itm_favo->img) }}" alt="Card image cap" />
                            <div class="card-body">
                                <h5 class="card-title">{{ $itm_favo->name_product }}</h5>
                                <p class="card-text">
                                    {{ $itm_favo->id_product }} - {{ number_format($itm_favo->price) }} &#8363;
                                </p>
                                <div class="float-end">
                                    <a href="{{ route('destroy_favorite_user', ['id'=> $itm_favo->id]) }}" class="btn btn-xs btn-outline-danger rounded-3"><i class='bx bx-x'></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
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
