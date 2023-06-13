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
            <div class="container mt-5 px-5 py-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row justify-content-center">
                            @php
                                use Carbon\Carbon;
                                $times = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                                $id_bill = 'ICS0'.time().'COD';
                                $dt_cart = $data_cart->limit(10)->paginate(10);
                            @endphp
                            {{-- <div class="col-lg-1">
                            </div> --}}
                            <div class="col-lg-6 py-2 rounded-3" style="background-color: #f9f9f9;">
                                @if ($data_cart->get() == '[]')
                                    <p class="text-center py-5 mt-5">Chưa có sản phẩm</p>
                                @else
                                    <div class="scrollDad">
                                        @foreach ($dt_cart as $number => $itm_dt_cart)
                                            <div class="card mb-3">
                                                <div class="row g-0 mb-3">
                                                    <div class="col-lg-1">
                                                        {{-- <div>
                                                            <p class="ms-2 mt-1 text-warning fs-6 btn btn-xs rounded-pill" style="background-color: #f7f7f7">{{ $number+1 }}</p>
                                                        </div> --}}
                                                        <span class="badge bg-label-primary ms-2 mt-1 rounded-pill">{{ $number+1 }}</span>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <img class="card-img card-img-left" src="{{ asset('dashboard\upload_img\product/'.$itm_dt_cart->image_product) }}" alt="Card image" />
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="card-body">
                                                            <a href="{{ route('destroy_cart_product', ['id'=>$itm_dt_cart->id, 'id_pr'=>$itm_dt_cart->id_product, 'amount_pr'=>$itm_dt_cart->amount_product]) }}" type="button" class="btn btn-outline-danger btn-xs float-end rounded-pill">Xóa</a>
                                                            
                                                            <h5 class="card-title">{{ $itm_dt_cart->name_product }} - {{ $itm_dt_cart->id_product }}</h5>

                                                            <p class="card-text max_dot">
                                                                    Giá tiền:
                                                                @if ($itm_dt_cart->sales == 0)
                                                                    {{ number_format($itm_dt_cart->price_product) }} &#8363;
                                                                @else
                                                                    <span class="text-decoration-line-through text-muted">{{ number_format($itm_dt_cart->price_product) }} &#8363;</span>
                                                                    &emsp;<i class='bx bxs-offer bx-tada text-danger' ></i>&ensp;{{ number_format($itm_dt_cart->sales) }} &#8363;
                                                                @endif
                                                            </p>
                                                            <p class="card-text">
                                                                <small class="text-muted">Số lượng mua: {{ $itm_dt_cart->amount_product }}</small>
                                                            </p>
                                                            <a href="#" class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#{{ $itm_dt_cart->id_product }}">
                                                                Đặt hàng
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- modal --}}
                                            <div class="modal fade" id="{{ $itm_dt_cart->id_product }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                                <form action="{{ route('pay_don') }}" method="POST">@csrf
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title text-center" id="modalScrollableTitle">Xác nhận thông tin</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <hr>
                                                    <div class="modal-body">
                                                        <div class="table-responsive text-nowrap">
                                                            <table class="table table-borderless">
                                                              <thead>
                                                                <tr colspan="6">
                                                                    <ul class="list-unstyled ms-4">
                                                                        <li>
                                                                          <strong>Thông tin khách hàng</strong>
                                                                          <ul>
                                                                            <li>Họ tên: {{ Auth::user()->name }}</li>
                                                                            <li>Email: {{ Auth::user()->email }}</li>
                                                                            <li>SĐT: {{ Auth::user()->phone }}</li>
                                                                            <li>Địa chỉ: {{ Auth::user()->district }}, {{ Auth::user()->city }}, {{ Auth::user()->province }}</li>
                                                                          </ul>
                                                                        </li>
                                                                    </ul>
                                                                    <hr>
                                                                </tr>
                                                                <tr>
                                                                  <th><strong>Thông tin sản phẩm</strong></th>
                                                                  <th>Mã SP</th>
                                                                  <th>Loại SP</th>
                                                                  <th>Số lượng</th>
                                                                  <th>Giá tiền</th>
                                                                  <th>Tổng</th>
                                                                </tr>
                                                              </thead>
                                                              <tbody>
                                                                <tr>
                                                                  <td>{{ $itm_dt_cart->name_product }}</td>
                                                                  <td>{{ $itm_dt_cart->id_product }}</td>
                                                                  <td>{{ $itm_dt_cart->type_product }}</td>
                                                                  <td>{{ $itm_dt_cart->amount_product }}</td>
                                                                  <td>
                                                                    @if ($itm_dt_cart->sales == 0)
                                                                        {{ number_format($itm_dt_cart->price_product) }}
                                                                    @else
                                                                        {{ number_format($itm_dt_cart->sales) }}
                                                                    @endif
                                                                    &#8363;
                                                                  </td>
                                                                  <td>
                                                                    @if ($itm_dt_cart->sales == 0)
                                                                        {{ number_format($itm_dt_cart->total) }}
                                                                    @else
                                                                        {{ number_format($itm_dt_cart->total_sales) }}
                                                                    @endif
                                                                    &#8363;
                                                                  </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="1"><hr>
                                                                        Phí dịch vụ: {{ number_format($ct) }} &#8363;
                                                                    </td>
                                                                    <td colspan="1"></td>
                                                                    <td colspan="4" class="text-center"><hr>
                                                                        <strong>Phương thức thanh toán</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="1">
                                                                        Tổng tiền:
                                                                        <strong>
                                                                            @if ($itm_dt_cart->sales == 0)
                                                                                {{ number_format($itm_dt_cart->total+$ct) }}
                                                                            @else
                                                                                {{ number_format($itm_dt_cart->total_sales+$ct) }}
                                                                            @endif
                                                                            &#8363;
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="1"></td>
                                                                    <td colspan="4">
                                                                        {{-- Thanh toán onlune --}}
                                                                        <input type="hidden" value="{{$itm_dt_cart->total+$ct}}" name="total_vnpay">
                                                                        <input type="hidden" value="{{$itm_dt_cart->id_product}}" name="total_vnpay_idpr">
                                                                        <input type="hidden" value="{{$itm_dt_cart->total+$ct}}" name="tt_cod">
                                                                        {{-- Thanh toán cod --}}
                                                                        <input type="hidden" value="{{ $id_bill }}" name="id_bill">
                                                                        <input type="hidden" value="{{ Auth::user()->name }}" name="username">
                                                                        <input type="hidden" value="{{ Auth::user()->email }}" name="email">
                                                                        <input type="hidden" value="{{ Auth::user()->phone }}" name="phone">
                                                                        <input type="hidden" value="{{ $times }}" name="date_create">
                                                                        <input type="hidden" value="COD" name="method">
                                                                        <input type="hidden" value="{{ Auth::user()->district.', '.Auth::user()->city.', '.Auth::user()->province }}" name="address">
                                                                        <input type="hidden" value="Xử lý" name="status_product_bill">
                                                                        <input type="hidden" value="{{ $itm_dt_cart->id_product }}" name="id_product">
                                                                        <input type="hidden" value="{{ $itm_dt_cart->name_product }}" name="name_product">
                                                                        <input type="hidden" value="{{ $ct }}">
                                                                        <input type="hidden" value="{{ $itm_dt_cart->amount_product }}" name="amount_product">
                                                                        @if ($itm_dt_cart->sales == 0)
                                                                            <input type="hidden" value="{{ $itm_dt_cart->total }}" name="price">
                                                                        @else
                                                                            <input type="hidden" value="{{ $itm_dt_cart->total_sales }}" name="price">
                                                                        @endif
                                                                        
                                                                        @if ($itm_dt_cart->sales == 0)
                                                                            <input type="hidden" value="{{ $itm_dt_cart->total+$ct }}" name="total">
                                                                        @else
                                                                            <input type="hidden" value="{{ $itm_dt_cart->total_sales+$ct }}" name="total">
                                                                        @endif
                                                                        <div class="d-flex justify-content-center">
                                                                            <div class="form-check me-4">
                                                                                <input
                                                                                  name="checkMethod"
                                                                                  class="form-check-input"
                                                                                  type="radio"
                                                                                  value="ATM"
                                                                                  id="ckatm_{{$itm_dt_cart->id_product}}"
                                                                                  checked
                                                                                />
                                                                                <label class="form-check-label" for="ckatm_{{$itm_dt_cart->id_product}}"> ATM VNPAY </label>
                                                                            </div>
                                                                            <div class="form-check me-4">
                                                                                <input
                                                                                  name="checkMethod"
                                                                                  class="form-check-input"
                                                                                  type="radio"
                                                                                  value="QR"
                                                                                  id="ckqr_{{$itm_dt_cart->id_product}}"
                                                                                />
                                                                                <label class="form-check-label" for="ckqr_{{$itm_dt_cart->id_product}}"> QR VNPAY </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input
                                                                                  name="checkMethod"
                                                                                  class="form-check-input"
                                                                                  type="radio"
                                                                                  value="COD"
                                                                                  id="ckcod_{{$itm_dt_cart->id_product}}"
                                                                                />
                                                                                <label class="form-check-label" for="ckcod_{{$itm_dt_cart->id_product}}"> COD </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <button type="submit" name="redirect" class="btn btn-success btn-sm float-end me-3">Xác nhận</button>
                                                                    </td>
                                                                </tr>
                                                              </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                  </div>
                                                </form>
                                                </div>
                                            </div>
                                            {{-- modal --}}
                                        @endforeach
                                    </div>
                                    <div class="d-flex mt-1 pagination pagination-sm justify-content-center">
                                        {{ $dt_cart->links() }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-3">
                                <div class="list-group list-group-horizontal-md text-md-center mb-2">
                                    <a
                                      class="list-group-item list-group-item-action active bg-dark border border-dark"
                                      href="{{ route('cart') }}"
                                      >Giỏ hàng</a
                                    >
                                    <a
                                      class="list-group-item list-group-item-action"
                                      href="{{ route('bill') }}"
                                      >Đơn hàng</a
                                    >
                                </div>
                                <div class="rounded-3 border border-waring px-5 py-3">
                                    <p>Tổng giá: {{ number_format($sum_not_sale) }} &#8363;</p>
                                    <p>Tổng sale: {{ number_format($sum_sale) }} &#8363;</p>
                                    <p>Phí dịch vụ: {{ number_format($ct) }} &#8363;</p>
                                    <hr>
                                    <p>Tổng: <strong class="float-end text-primary">{{ number_format($sum+$ct) }} &#8363;</strong></p>
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
