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
            <div class="container mt-5 px-5 py-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row justify-content-center">
                            @php
                             use App\Models\bill; 
                             use App\Models\product;
                                // $dt_bill = $bill->limit(10)->paginate(10);
                                $start = bill::where('email',Auth::user()->email)->where('status_product_bill','1')->get();
                                $ship = bill::where('email',Auth::user()->email)->whereBetween('status_product_bill', [2, 3])->get();
                                $end =  bill::where('email',Auth::user()->email)->where('status_product_bill','4')->get();
                            @endphp
                            {{-- <div class="col-lg-1">
                            </div> --}}
                            <div class="col-lg-6 py-2 rounded-3" style="background-color: #f9f9f9;">
                                @if ($bill->get() == '[]')
                                    <p class="text-center py-5 mt-5">Chưa có đơn hàng.</p>
                                @else
                                    <div class="scrollDad">
                                        <div class="list-group list-group-horizontal-md text-md-center mb-2">
                                            <a
                                              class="list-group-item list-group-item-action "
                                              id="home-list-item"
                                              data-bs-toggle="list"
                                              href="#horizontal-home"
                                              >Đang lấy hàng</a
                                            >
                                            <a
                                              class="list-group-item list-group-item-action active"
                                              id="profile-list-item"
                                              data-bs-toggle="list"
                                              href="#horizontal-profile"
                                              >Đơn vận chuyển</a
                                            >
                                            <a
                                              class="list-group-item list-group-item-action"
                                              id="messages-list-item"
                                              data-bs-toggle="list"
                                              href="#horizontal-messages"
                                              >Đơn thành công</a
                                            >
                                        </div>
                                        <div class="tab-content px-0 mt-0">
                                            <div class="tab-pane fade show " id="horizontal-home">
                                                @if ($start == '[]')
                                                    <p class="text-center py-5 mt-5">Không có đơn</p>
                                                @else
                                                    @foreach ($start as $number => $itm_bill_start)
                                                    <div class="card mb-3">
                                                        <div class="row g-0 mb-3">
                                                            <div class="col-lg-12">
                                                                <div class="card-body">
                                                                    <div class="row" data-bs-toggle="modal" data-bs-target="#{{ $itm_bill_start->id_bill }}">
                                                                        <div class="col-lg-4 text-center">
                                                                            <h5 class="card-title">{{ $itm_bill_start->id_bill }}</h5><br>
                                                                            <button class="btn btn-secondary btn-sm rounded-3">Đang lấy hàng</button>
                                                                        </div>
                                                                        <div class="col-lg-1"></div>
                                                                        <div class="col-lg">
                                                                            <p>Sản phẩm: <span>{{ $itm_bill_start->name_product }}</span></p>
                                                                            <p class="card-text max_dot">
                                                                                Giá tiền: {{ number_format($itm_bill_start->price) }} &#8363;
                                                                            </p>
                                                                            <p class="card-text">
                                                                                Số lượng mua: {{ $itm_bill_start->amount }}
                                                                            </p>
                                                                            <p class="card-text">
                                                                                Tổng tiền: {{ number_format($itm_bill_start->total) }} &#8363;
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <a href="{{ route('destroy_bill', ['id'=>$itm_bill_start->id_bill]) }}" class="btn btn-danger btn-xs float-end" onclick="return confirm('Bạn có chắc chắn hủy đơn này')">Hủy đơn hàng</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="{{ $itm_bill_start->id_bill }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <div class="container justify-content-center">
                                                                    Đơn hàng: <strong class="fs-5">{{ $itm_bill_start->id_bill }}</strong>
                                                                    <button class="btn btn-secondary btn-sm rounded-3 float-end">Đang lấy hàng</button>
                                                                  </div>
                                                                </div>
                                                                <hr>
                                                                <div class="modal-body">
                                                                  <div>
                                                                    <div class="row justify-content-center g-2">
                                                                        <div class="col-lg mb-0 ms-5">
                                                                            @php
                                                                                $product_start =  product::where('id_product',$itm_bill_start->id_product)->get();
                                                                            @endphp
                                                                            @foreach ($product_start as $itm_pr_start)
                                                                                <dl class="row">
                                                                                    <dt class="col-lg">Mã sản phẩm:</dt>
                                                                                    <dd class="col-lg-8">{{ $itm_pr_start->id_product }}</dd>
                                                                                </dl>
                                                                                <dl class="row">
                                                                                    <dt class="col-lg">Tên sản phẩm:</dt>
                                                                                    <dd class="col-lg-8">{{ $itm_pr_start->name_product }}</dd>
                                                                                </dl>
                                                                                <dl class="row">
                                                                                    <dt class="col-lg">Loại sản phẩm:</dt>
                                                                                    <dd class="col-lg-8">{{ $itm_pr_start->type_product }} - {{ $itm_pr_start->material }}</dd>
                                                                                </dl>
                                                                                <dl class="row">
                                                                                    <dt class="col-lg">Nhà cung cấp:</dt>
                                                                                    <dd class="col-lg-8">{{ $itm_pr_start->supplier }}</dd>
                                                                                </dl>
                                                                                <dl class="row">
                                                                                    <dt class="col-lg">Giá tiền:</dt>
                                                                                    <dd class="col-lg-8">{{ number_format($itm_pr_start->price) }} &#8363;</dd>
                                                                                </dl>
                                                                            @endforeach
                                                                            <dl class="row">
                                                                                <dt class="col-lg">Số lượng mua:</dt>
                                                                                <dd class="col-lg-8">{{ $itm_bill_start->amount }}</dd>
                                                                            </dl>
                                                                        </div>
                                                                        <div class="col-lg-4 mb-0 rounded-3 shadow py-2 me-5">
                                                                            <img class="card-img" src="{{ asset('dashboard\upload_img\product/'.$itm_pr_start->images) }}" alt="Card image" />
                                                                        </div>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <hr>
                                                                <div class="modal-footer">
                                                                    <p class="card-text me-5">
                                                                        Tổng tiền: <strong class="fs-6">{{ number_format($itm_bill_start->total) }} &#8363;</strong>
                                                                    </p>
                                                                  <button type="button" class="btn btn-outline-secondary btn-sm ms-2" data-bs-dismiss="modal">
                                                                    Close
                                                                  </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="tab-pane fade show active" id="horizontal-profile">
                                                @if ($ship == '[]')
                                                    <p class="text-center py-5 mt-5">Không có đơn</p>
                                                @else
                                                    @foreach ($ship as $number => $itm_bill_ship)
                                                    <div class="card mb-3">
                                                        <div class="row g-0 mb-3">
                                                            <div class="col-lg-12">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 text-center">
                                                                            <h5 class="card-title">{{ $itm_bill_ship->id_bill }}</h5><br>
                                                                            <button class="btn btn-warning btn-sm rounded-3" data-bs-toggle="modal" data-bs-target="#{{ $itm_bill_ship->id_bill }}">Đang vận chuyển</button>
                                                                            <button class="btn btn-danger btn-xs mt-1"><a href="{{ route('destroy_bill', ['id'=>$itm_bill_ship->id_bill]) }}"  style="color: #ffffff"  onclick="return confirm('Bạn có chắc chắn hủy đơn này')">Hủy đơn hàng</a></button>
                                                                        </div>
                                                                        <div class="col-lg-1"></div>
                                                                        <div class="col-lg">
                                                                            <p>Sản phẩm: <span>{{ $itm_bill_ship->name_product }}</span></p>
                                                                            <p class="card-text max_dot">
                                                                                Giá tiền: {{ number_format($itm_bill_ship->price) }} &#8363;
                                                                            </p>
                                                                            <p class="card-text">
                                                                                Số lượng mua: {{ $itm_bill_ship->amount }}
                                                                            </p>
                                                                            <p class="card-text">
                                                                                Tổng tiền: {{ number_format($itm_bill_ship->total) }} &#8363;
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <a href="{{ route('ship_done', ['id_bill'=>$itm_bill_ship->id_bill]) }}" class="btn btn-success btn-sm float-end">Đã nhận hàng</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="{{ $itm_bill_ship->id_bill }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <div class="container justify-content-center">
                                                                    Đơn hàng: <strong class="fs-5">{{ $itm_bill_ship->id_bill }}</strong>
                                                                    <button class="btn btn-warning btn-sm rounded-3 float-end">Đang vận chuyển</button>
                                                                  </div>
                                                                </div>
                                                                <hr>
                                                                <div class="modal-body">
                                                                  <div>
                                                                    <div class="row justify-content-center g-2">
                                                                        <div class="col-lg mb-0 ms-5">
                                                                            @php
                                                                                $product_ship =  product::where('id_product',$itm_bill_ship->id_product)->get();
                                                                            @endphp
                                                                            @foreach ($product_ship as $itm_pr_ship)
                                                                                <dl class="row">
                                                                                    <dt class="col-lg">Mã sản phẩm:</dt>
                                                                                    <dd class="col-lg-8">{{ $itm_pr_ship->id_product }}</dd>
                                                                                </dl>
                                                                                <dl class="row">
                                                                                    <dt class="col-lg">Tên sản phẩm:</dt>
                                                                                    <dd class="col-lg-8">{{ $itm_pr_ship->name_product }}</dd>
                                                                                </dl>
                                                                                <dl class="row">
                                                                                    <dt class="col-lg">Loại sản phẩm:</dt>
                                                                                    <dd class="col-lg-8">{{ $itm_pr_ship->type_product }} - {{ $itm_pr_ship->material }}</dd>
                                                                                </dl>
                                                                                <dl class="row">
                                                                                    <dt class="col-lg">Nhà cung cấp:</dt>
                                                                                    <dd class="col-lg-8">{{ $itm_pr_ship->supplier }}</dd>
                                                                                </dl>
                                                                                <dl class="row">
                                                                                    <dt class="col-lg">Giá tiền:</dt>
                                                                                    <dd class="col-lg-8">{{ number_format($itm_pr_ship->price) }} &#8363;</dd>
                                                                                </dl>
                                                                            @endforeach
                                                                            <dl class="row">
                                                                                <dt class="col-lg">Số lượng mua:</dt>
                                                                                <dd class="col-lg-8">{{ $itm_bill_ship->amount }}</dd>
                                                                            </dl>
                                                                        </div>
                                                                        <div class="col-lg-4 mb-0 rounded-3 shadow py-2 me-5">
                                                                            <img class="card-img" src="{{ asset('dashboard\upload_img\product/'.$itm_pr_ship->images) }}" alt="Card image" />
                                                                        </div>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <hr>
                                                                <div class="modal-footer">
                                                                    <p class="card-text me-5">
                                                                        Tổng tiền: <strong class="fs-6">{{ number_format($itm_bill_ship->total) }} &#8363;</strong>
                                                                    </p>
                                                                  <button type="button" class="btn btn-outline-secondary btn-sm ms-2" data-bs-dismiss="modal">
                                                                    Close
                                                                  </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="tab-pane fade show" id="horizontal-messages">
                                                @if ($end == '[]')
                                                    <p class="text-center py-5 mt-5">Không có đơn</p>
                                                @else
                                                    @foreach ($end as $itm_bill_end)
                                                    <div class="card mb-3">
                                                        <div class="row g-0 mb-3">
                                                            <div class="col-lg-12">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 text-center">
                                                                            <h5 class="card-title">{{ $itm_bill_end->id_bill }}</h5><br>
                                                                            <button class="btn btn-success btn-sm rounded-3" data-bs-toggle="modal" data-bs-target="#{{ $itm_bill_end->id_product }}">Giao hàng thành công</button>
                                                                        </div>
                                                                        <div class="col-lg-1"></div>
                                                                        <div class="col-lg">
                                                                            <p>Sản phẩm: <span>{{ $itm_bill_end->name_product }}</span></p>
                                                                            <p class="card-text max_dot">
                                                                                Giá tiền: {{ number_format($itm_bill_end->price) }} &#8363;
                                                                            </p>
                                                                            <p class="card-text">
                                                                                Số lượng mua: {{ $itm_bill_end->amount }}
                                                                            </p>
                                                                            <p class="card-text">
                                                                                Tổng tiền: {{ number_format($itm_bill_end->total) }} &#8363;
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-outline-secondary btn-xs float-end" data-bs-toggle="modal" data-bs-target="#modal{{ $itm_bill_end->id_product }}">
                                                                        Đánh giá sản phẩm
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- modal detail --}}
                                                    <div class="modal fade" id="{{ $itm_bill_end->id_product }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-top modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <div class="container justify-content-center">
                                                                    Đơn hàng: <strong class="fs-5">{{ $itm_bill_end->id_bill }}</strong>
                                                                    <button class="btn btn-success btn-sm rounded-3 float-end">Giao hàng thành công</button>
                                                                  </div>
                                                                </div>
                                                                <hr>
                                                                <div class="modal-body">
                                                                  <div>
                                                                    <div class="row justify-content-center g-2">
                                                                        <div class="col-lg mb-0 ms-5">
                                                                                    <dl class="row">
                                                                                        <dt class="col-lg">Mã sản phẩm:</dt>
                                                                                        <dd class="col-lg-8">{{ $itm_bill_end->id_product }}</dd>
                                                                                    </dl>
                                                                                    <dl class="row">
                                                                                        <dt class="col-lg">Tên sản phẩm:</dt>
                                                                                        <dd class="col-lg-8">{{ $itm_bill_end->name_product }}</dd>
                                                                                    </dl>
                                                                                    <dl class="row">
                                                                                        <dt class="col-lg">Loại sản phẩm:</dt>
                                                                                        <dd class="col-lg-8">{{ $itm_bill_end->type_product }}</dd>
                                                                                    </dl>
                                                                                    <dl class="row">
                                                                                        <dt class="col-lg">Giá tiền:</dt>
                                                                                        <dd class="col-lg-8">{{ number_format($itm_bill_end->price) }} &#8363;</dd>
                                                                                    </dl>
                                                                                    <dl class="row">
                                                                                        <dt class="col-lg">Số lượng mua:</dt>
                                                                                        <dd class="col-lg-8">{{ $itm_bill_end->amount }}</dd>
                                                                                    </dl>
                                                                                
                                                                            </div>
                                                                            <div class="col-lg-4 mb-0 rounded-3 shadow py-2 ms-2 me-5">
                                                                                <img class="card-img" src="{{ asset('dashboard\upload_img\product/'.$itm_bill_end->image_product) }}" style="max-width: 252px; max-height: 248px;" alt="Card image" />
                                                                                <p class="card-text text-center mt-2">
                                                                                    Tổng tiền: <strong class="fs-6">{{ number_format($itm_bill_end->total) }} &#8363;</strong>
                                                                                </p>
                                                                            </div>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <hr>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary btn-sm ms-2" data-bs-dismiss="modal">
                                                                        Close
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Modal review --}}
                                                    <div class="modal fade" id="modal{{ $itm_bill_end->id_product }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered  modal-sm" role="document">
                                                        <form action="{{ route('add_review') }}" method="POST">@csrf
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h5 class="modal-title" id="modalCenterTitle">Gửi đánh giá cho chúng tôi</h5>
                                                              <button
                                                                type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"
                                                              ></button>
                                                            </div>
                                                            <div class="modal-body">
                                                              <div class="row">
                                                                <div class="col mb-3">
                                                                    <img class="card-img" src="{{ asset('dashboard\upload_img\product/'.$itm_bill_end->image_product) }}" style="max-width: 252px; max-height: 248px;" alt="Card image" />
                                                                </div>
                                                              </div>
                                                              <div class="row">
                                                                <div class="col mb-3">
                                                                  <label for="nameWithTitle" class="form-label">Nhập đánh giá của bạn: </label>
                                                                  <textarea class="form-control" name="descriptions" id="nameWithTitle" cols="30" rows="2"></textarea>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <input type="hidden" value="{{ $itm_bill_end->id_product }}" name="id_product_rv">
                                                            <input type="hidden" value="{{ $itm_bill_end->image_product }}" name="img_rv">
                                                            <div class="modal-footer">
                                                              <button type="submit" class="btn btn-primary w-100">Gửi đánh giá</button>
                                                            </div>
                                                          </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="d-flex mt-1 pagination pagination-sm justify-content-center">
                                        {{ $dt_cart->links() }}
                                    </div> --}}
                                @endif
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-3">
                                <div class="list-group list-group-horizontal-md text-md-center mb-2">
                                    <a
                                      class="list-group-item list-group-item-action"
                                      href="{{ route('cart') }}"
                                      >Giỏ hàng</a
                                    >
                                    <a
                                      class="list-group-item list-group-item-action active bg-dark border border-dark"
                                      href="{{ route('bill') }}"
                                      >Đơn hàng</a
                                    >
                                </div>
                                <div class="rounded-3 border border-waring px-5 py-3">
                                    <p>Đang lấy hàng: <span class="rounded-pill px-2 bg-secondary" style="color: #ffffff">{{ $start->count() }}</span></p>
                                    <p>Đơn vận chuyển: <span class="rounded-pill px-2 bg-warning" style="color: #ffffff">{{ $ship->count() }}</span></p>
                                    <p>Đơn thành công: <span class="rounded-pill px-2 bg-success" style="color: #ffffff">{{ $end->count() }}</span></p>
                                    <hr>
                                    <p class="fs-5 text-center">Tổng số đơn: <strong class="text-danger">{{ $start->count()+$ship->count()+$end->count() }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
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
