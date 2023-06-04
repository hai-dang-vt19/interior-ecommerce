<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
  @include('interiors.blocks.head')

  {{-- <body style="background-image: url(https://images.pexels.com/photos/7914464/pexels-photo-7914464.jpeg)"> --}}
  <body style="background-color: #ffffff">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
        <div class="layout-page">
          <!-- Navbar -->
          @include('interiors.blocks.navbar')
          <div class="content-wrapper mt-4">
            <!-- Content -->
            <div class="container-sm mt-2 px-3 py-5">
                <div class="row">
                    <div class="col">
                        <nav class="navbar navbar-example navbar-expand-xl navbar-detached bg-navbar-theme" 
                            style="
                                /* width: 100%; */
                                width: calc(100% - (1.625rem * 2));
                                margin: auto auto 0;
                                border-radius: 0.375rem;
                                padding: 0 1.5rem;
                                z-index: 1000;
                                opacity: 95%;
                            "
                        >
                            <div class="container-fluid">
                                <button
                                    class="navbar-toggler"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3" aria-controls="navbar-ex-3" aria-expanded="false" aria-label="Toggle navigation"
                                >
                                    <i class='bx bx-grid-vertical'></i>
                                </button>
                                <div class="collapse navbar-collapse" id="navbar-ex-3">
                                    <div class="me-auto text-left py-3">
                                        <p>Loại sản phẩm
                                            <br>
                                            @foreach ($types as $itm_types)
                                                <a class="nav-item nav-link" href="#">{{ $itm_types->name_type }}</a>  
                                            @endforeach
                                        </p>
                                        <p>Nhà cung cấp
                                            <br>
                                            @foreach ($suppliers as $itm_suppliers)
                                                <a class="nav-item nav-link" href="#">{{ $itm_suppliers->name_supplier }}</a>  
                                            @endforeach
                                        </p>
                                        {{-- <a class="nav-item nav-link" href="#">Category</a> --}}
                                        <p>Màu sắc
                                            <br>
                                            @foreach ($color as $itm_color)
                                                <a class="nav-item nav-link mb-1 mt-2 ms-2 border border-warning rounded-pill" href="#" style="min-width: 40px; max-width: 83px; background-color: {{$itm_color->id_color}};"> </a>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="col-9 rounded-3 py-3" style="background-color: #f9f9f9">
                        <div class="container mb-3">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <button type="button" class="btn btn-outline-warning btn-sm w-px-75">
                                    <i class='bx bx-sort-a-z'></i>
                                </button>
                                <button type="button" class="btn btn-outline-warning btn-sm w-px-75">
                                    <i class='bx bx-sort-z-a' ></i>
                                </button>
                                <div class="btn-group" role="group">
                                  <button
                                    id="btnGroupDrop1"
                                    type="button"
                                    class="btn btn-warning btn-sm hide-arrow dropdown-toggle w-px-150"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                  >
                                    Khoảng giá
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    @php
                                        $step = 500000;
                                        for ($i = $min; $i <= ceil($max / $step) * $step; $i++){
                                            if ($i % $step == 0) {
                                                $data = number_format($min)." - ".number_format($i);
                                                $min = $i + 0;
                                                echo ' <a class="dropdown-item px-3" href="'.route('product_with_price', ['data'=>$data]).'">'.$data.' &#8363;</a> ';
                                            }
                                        }
                                    @endphp
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="container mb-4">
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                @foreach ($product as $itm_prd)
                                    <div class="col">
                                        <div class="card">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#{{$itm_prd->id_product}}">
                                                <img class="card-img-top h-px-300" src="{{ asset('dashboard\upload_img\product/'.$itm_prd->images) }}" alt="Card image cap"  />
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $itm_prd->name_product }}</h5>
                                                <p class="card-text">{{ number_format($itm_prd->price) }} &#8363;</p>
                                            </div>
                                            <div class="card-body px-4">
                                                <a href="#" class="card-link text-decoration-none"><i class='bx bxs-heart-circle bx-sm text-danger' ></i></a>
                                                <a href="#" class="card-link float-end text-decoration-none"><i class='bx bxs-cart-add bx-sm'></i></a>
                                            </div>
                                            {{-- Modal --}}
                                            <div class="modal fade" id="{{$itm_prd->id_product}}" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
                                                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="modalScrollableTitle">{{ $itm_prd->name_product }} _ {{ number_format($itm_prd->price) }} &#8363;</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-2">
                                                            <div class="row g-0">
                                                              <div class="col-md-5">
                                                                <img class="card-img card-img-left" src="{{ asset('dashboard\upload_img\product/'.$itm_prd->images) }}" alt="Card image" />
                                                              </div>
                                                              <div class="col-md">
                                                                <div class="card-body">
                                                                  <h5 class="card-title">Mã sản phẩm: {{ $itm_prd->id_product }}</h5>
                                                                  <ul class="list-unstyled px-3">
                                                                    <li class="mb-2">Tên sản phẩm: {{ $itm_prd->name_product }}</li>
                                                                    <li class="mb-2">Loại sản phẩm: {{ $itm_prd->type_product }}</li>
                                                                    <li class="mb-2">Số lượng: {{ $itm_prd->amount }}</li>
                                                                    <li class="mb-2 d-flex">Mầu sắc:
                                                                        @php
                                                                            $explode = explode(', ', $itm_prd->color);
                                                                            $count = count($explode);
                                                                            for($cl = 0; $cl < $count; $cl++){
                                                                                echo '<p class="ms-3 mt-1 border border-dark rounded-pill" style="width: 15px;height: 15px; background-color: '.$explode[$cl].';" title="'.$explode[$cl].'"></p>';
                                                                            }
                                                                        @endphp
                                                                    </li>
                                                                    <li class="mb-2">Chất liệu: {{ $itm_prd->material }}</li>
                                                                    <li class="mb-2">Nhà cung cấp: {{ $itm_prd->supplier }}</li>
                                                                    <li class="mb-2">Giá tiền: {{ number_format($itm_prd->price) }} &#8363;</li>
                                                                  </ul>
                                                                  <p class="card-text"><small class="text-muted">{{ $itm_prd->descriptions }}</small></p>
                                                                </div>
                                                              </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <a href="#" class="card-link text-decoration-none me-3"><i class='bx bxs-heart-circle bx-sm text-danger' ></i></a>
                                                      <button type="submit" class="btn btn-warning text-light">Thêm vào giỏ hàng<i class='bx bxs-cart-add bx-sm'></i></button>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            {{-- / Modal --}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if ($pr_inte->count() > 12)
                            <div class="container">
                                <div class="row row-cols-1 row-cols-md-1 g-4 align-items-center">
                                <div class="col">
                                    <div class="mb-0">
                                    <div class="divider divider-warning">
                                        <div class="divider-text">
                                            <div class="d-flex mt-3">
                                                {{ $product->links() }}
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div> 
                        @endif
                    </div>
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