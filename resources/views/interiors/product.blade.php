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
          <div class="content-wrapper mt-4">
            <!-- Content -->
            <div class="container-sm mt-4 py-5">
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
                                                <a class="nav-item nav-link" href="{{ route('get_with_type', ['type'=>$itm_types->name_type]) }}">
                                                        {{ $itm_types->name_type }}
                                                </a>  
                                            @endforeach
                                        </p>
                                        <p>Nhà cung cấp
                                            <br>
                                            @foreach ($suppliers as $itm_suppliers)
                                                <a class="nav-item nav-link" href="{{ route('get_with_brand', ['supplier'=>$itm_suppliers->name_supplier]) }}">
                                                        {{ $itm_suppliers->name_supplier }}
                                                </a>  
                                            @endforeach
                                        </p>
                                        <p>Màu sắc
                                            <br>
                                            @foreach ($color as $itm_color)
                                                <a class="nav-item nav-link mb-1 mt-2 ms-2 border border-warning rounded-pill" href="{{ route('get_with_color', ['color'=>$itm_color->id_color]) }}" style="min-width: 40px; max-width: 83px; background-color: {{$itm_color->id_color}};"> </a>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="col-9 rounded-3 py-3 ms-5" style="background-color: #f9f9f9">
                        <div class="container mb-3">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <a href="{{ route('get_a_z') }}" class="btn btn-outline-warning btn-sm w-px-50">
                                    <i class='bx bx-sort-a-z'></i>
                                </a>
                                <a href="{{ route('get_z_a') }}" class="btn btn-outline-warning btn-sm w-px-50">
                                    <i class='bx bx-sort-z-a' ></i>
                                </a>
                            </div>
                        </div>
                        <div class="container mb-4">
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                @foreach ($product as $itm_prd)
                                @php
                                    $url = 'http://127.0.0.1:8000/rdr/qrcode/'.$itm_prd->id_product;
                                @endphp
                                    <div class="col">
                                        <div class="card">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#{{$itm_prd->id_product}}">
                                                {{-- <div style="position: absolute; margin: 5px;">{{ QrCode::color(251,183,16)->size(50)->generate($url) }}</div> --}}
                                                <img class="card-img-top h-px-300" src="{{ asset('dashboard\upload_img\product/'.$itm_prd->images) }}" alt="Card image cap"  />
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $itm_prd->name_product }}</h5>
                                                    <p class="card-text">{{ number_format($itm_prd->price) }} &#8363;</p>
                                                    <a href="{{ route('create_favorite', ['id'=>$itm_prd->id_product]) }}" class="card-link text-decoration-none float-end"><i class='bx bxs-heart-circle bx-sm text-danger' ></i></a>
                                                    <a href="#" class="card-link text-decoration-none float-end me-2" data-bs-toggle="modal" data-bs-target="#qr{{$itm_prd->id_product}}"><i class='bx  bx-qr-scan bx-sm' ></i></a>
                                                </div>
                                            </a>
                                            {{-- Modal --}}
                                            <div class="modal fade" id="{{$itm_prd->id_product}}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="modalScrollableTitle">{{ $itm_prd->name_product }} _ {{ number_format($itm_prd->price) }} &#8363;</h5>
                                                      <a href="{{ route('create_favorite', ['id'=>$itm_prd->id_product]) }}" class="card-link text-decoration-none ms-3"><i class='bx bxs-heart-circle bx-sm text-danger' ></i></a>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <hr>
                                                    <form action="{{ route('add_cart', ['id'=>$itm_prd->id]) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="mb-1">
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
                                                            <div>
                                                                <label class="form-label">Số lượng mua: </label>
                                                                <input type="number" class="form-control form-control-sm w-75" value="1" min="1" max="{{ $itm_prd->amount }}" name="quantity">
                                                                {{-- <input type="text" class="form-control form-control-sm w-50" value="1" name="quantity"> --}}
                                                            </div>
                                                            <button type="submit" class="btn btn-warning">Thêm vào giỏ hàng<i class='bx bxs-cart-add bx-sm'></i></button>
                                                        </div>
                                                    </form>
                                                  </div>
                                                </div>
                                            </div>
                                            {{-- / Modal --}}
                                            {{-- Modal QRCODE --}}
                                            <div class="modal fade" id="qr{{$itm_prd->id_product}}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row justify-content-center text-center">
                                                            {{ QrCode::color(251,183,16)->size(250)->generate($url) }}
                                                            <h5 class="mt-5">{{ $itm_prd->name_product }}</h5>
                                                        </div>
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