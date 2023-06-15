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
                                use Carbon\Carbon;
                                use App\Models\cart;
                                $times = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                                $id_bill = 'ICS0'.time().'COD';
                                $dt_cart = $data_cart->limit(10)->paginate(10);
                                $all_cart = cart::where('id_cart_user','CART_CS'.Auth::user()->user_id)->get();
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
                                                                        {{-- <input type="hidden" value="{{$itm_dt_cart->total+$ct}}" name="total_vnpay"> --}}
                                                                        {{-- <input type="hidden" value="{{$itm_dt_cart->id_product}}" name="total_vnpay_idpr"> --}}
                                                                        <input type="hidden" value="{{ $ct }}" name="price_service">
                                                                        <input type="hidden" value="{{ Auth::user()->name }}" name="username">
                                                                        <input type="hidden" value="{{ Auth::user()->email }}" name="email">
                                                                        <input type="hidden" value="{{ Auth::user()->phone }}" name="phone">
                                                                        <input type="hidden" value="{{ $times }}" name="date_create">
                                                                        <input type="hidden" value="COD" name="method">
                                                                        <input type="hidden" value="{{ Auth::user()->district.', '.Auth::user()->city.', '.Auth::user()->province }}" name="address">
                                                                        <input type="hidden" value="1" name="status_product_bill">
                                                                        <input type="hidden" value="{{ $id_bill }}" name="id_bill">
                                                                        <input type="hidden" value="{{ $itm_dt_cart->id_product }}" name="id_product">
                                                                        <input type="hidden" value="{{ $itm_dt_cart->name_product }}" name="name_product">
                                                                        <input type="hidden" value="{{ $itm_dt_cart->amount_product }}" name="amount_product">
                                                                        <input type="hidden" value="{{ $itm_dt_cart->image_product }}" name="images">
                                                                        <input type="hidden" value="{{ $itm_dt_cart->type_product }}" name="types">
                                                                        
                                                                        @if ($itm_dt_cart->sales == 0)
                                                                            <input type="hidden" value="{{ $itm_dt_cart->total }}" name="price">
                                                                            <input type="hidden" value="{{ $itm_dt_cart->total+$ct }}" name="total">
                                                                        @else
                                                                            <input type="hidden" value="{{ $itm_dt_cart->total_sales }}" name="price">
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
                                                              </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div>
                                                            <input class="form-control form-control-sm" type="text" placeholder="Mã giảm giá" name="discount"/>
                                                        </div>
                                                        <button type="submit" name="redirect" class="btn btn-success float-end me-3">Xác nhận thanh toán</button>
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
                                <div class="rounded-3 border px-5 py-3">
                                    <p>Tổng giá: {{ number_format($sum_not_sale) }} &#8363;</p>
                                    <p>Tổng sale: {{ number_format($sum_sale) }} &#8363;</p>
                                    <p>Phí dịch vụ: {{ number_format($ct) }} &#8363;</p>
                                    <hr>
                                    <p>Tổng: <strong class="float-end text-primary">{{ number_format($sum+$ct) }} &#8363;</strong></p>
                                </div>
                                <script type="text/javascript">
                                        function EnableCheckSeri(ckPayAll){
                                          var ckBtnPayAll = document.getElementById("ckBtnPayAll");
                                          ckBtnPayAll.disabled = ckPayAll.checked ? false : true;
                                          if(!ckBtnPayAll.disabled){
                                            ckBtnPayAll.focus();
                                          }
                                        }
                                </script>
                                <div class="d-flex justify-content-center mt-3 mb-2">
                                    <div class="form-check form-switch mb-2" style="z-index: 5">
                                        <input class="form-check-input" type="checkbox" id="ckPayAll" onclick="EnableCheckSeri(this)"/>
                                        <label class="form-check-label ms-2" for="ckPayAll"
                                          >Xác nhận mua hàng</label
                                        >
                                    </div>
                                </div>
                                <button class="btn btn-success w-100" id="ckBtnPayAll" disabled="disabled"  data-bs-toggle="modal" data-bs-target="#BtnPayAll">Đặt hàng</button>
                                {{-- modal all --}}
                                <div class="modal fade" id="BtnPayAll" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                    <form action="{{ route('pay_all') }}" method="POST">@csrf
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
                                                        @foreach ($all_cart as $itm_pay_cart)
                                                        <tr>
                                                            <td>{{ $itm_pay_cart->name_product }}</td>
                                                            <td>{{ $itm_pay_cart->id_product }}</td>
                                                            <td>{{ $itm_pay_cart->type_product }}</td>
                                                            <td>{{ $itm_pay_cart->amount_product }}</td>
                                                            <td>
                                                                @if ($itm_pay_cart->sales == 0)
                                                                    {{ number_format($itm_pay_cart->price_product) }}&#8363;
                                                                @else
                                                                    {{ number_format($itm_pay_cart->sales) }}&#8363; <i class='bx bxs-offer ms-1'></i>
                                                                @endif
                                                                
                                                            </td>
                                                            <td>
                                                                @if ($itm_pay_cart->sales == 0)
                                                                    {{ number_format($itm_pay_cart->total) }}
                                                                @else
                                                                    {{ number_format($itm_pay_cart->total_sales) }}
                                                                @endif
                                                                &#8363;
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                                <input type="hidden" value="{{ $id_bill }}" name="id_billAll">
                                                                <input type="hidden" value="{{ $ct }}" name="price_serviceAll">
                                                                <input type="hidden" value="{{ Auth::user()->name }}" name="usernameAll">
                                                                <input type="hidden" value="{{ Auth::user()->email }}" name="emailAll">
                                                                <input type="hidden" value="{{ Auth::user()->phone }}" name="phoneAll">
                                                                <input type="hidden" value="{{ $times }}" name="date_createAll">
                                                                <input type="hidden" value="COD" name="methodAll">
                                                                <input type="hidden" value="{{ Auth::user()->district.', '.Auth::user()->city.', '.Auth::user()->province }}" name="addressAll">
                                                                <input type="hidden" value="1" name="status_product_billAll">
                                                                
                                                        @php
                                                            $sumTotal = $all_cart->where('sales',0)->sum('total');
                                                            $sumSales = $all_cart->where('sales','!=',0)->sum('total_sales');
                                                            $sumAll = $sumTotal + $sumSales;
                                                        @endphp
                                                                <input type="hidden" value="{{ $sumAll+$ct }}" name="totalAll">
                                                        <tr>
                                                            <td colspan="4"></td>
                                                            <td colspan="1"><Strong>Tổng:</Strong></td>
                                                            <td colspan="1">
                                                                <strong>{{ number_format($sumAll) }} &#8363;</strong>
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
                                                                    {{ number_format($sumAll+$ct) }}
                                                                    &#8363;
                                                                </strong>
                                                            </td>
                                                            <td colspan="1"></td>
                                                            <td colspan="4">
                                                                <div class="d-flex justify-content-center">
                                                                    <div class="form-check me-4">
                                                                        <input
                                                                        name="checkMethodAll"
                                                                        class="form-check-input"
                                                                        type="radio"
                                                                        value="ATM"
                                                                        id="ckatm_All"
                                                                        checked
                                                                        />
                                                                        <label class="form-check-label" for="ckatm_All"> ATM VNPAY </label>
                                                                    </div>
                                                                    <div class="form-check me-4">
                                                                        <input
                                                                        name="checkMethodAll"
                                                                        class="form-check-input"
                                                                        type="radio"
                                                                        value="QR"
                                                                        id="ckqr_All"
                                                                        />
                                                                        <label class="form-check-label" for="ckqr_All"> QR VNPAY </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input
                                                                        name="checkMethodAll"
                                                                        class="form-check-input"
                                                                        type="radio"
                                                                        value="COD"
                                                                        id="ckcod_All"
                                                                        />
                                                                        <label class="form-check-label" for="ckcod_All"> COD </label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                  </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div>
                                                <input class="form-control form-control-sm" type="text" placeholder="Mã giảm giá" name="discountAll"/>
                                            </div>
                                            <button type="submit" name="redirect" class="btn btn-success float-end me-3">Xác nhận thanh toán</button>
                                        </div>
                                      </div>
                                    </form>
                                    </div>
                                </div>
                                {{-- modal --}}
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
