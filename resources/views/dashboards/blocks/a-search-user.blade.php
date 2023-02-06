<div class="navbar-nav align-items-center">
    <div class="nav-item d-flex align-items-center">
      <i class="bx bx-search fs-4 lh-0"></i>
      <form action="{{ route('search_dashboard_up') }}" method="GET">
        <div class="d-flex">
            <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." name="data_search"/>
            <div class="col-4">
                <select name="check_kh" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                    <option value="1" selected>Sản phẩm</option>
                    <option value="2">Đơn hàng</option>
                    <option value="3">Người dùng</option>
                </select>
            </div>
            <div class="ms-2">
                <button class="btn btn-outline-secondary" type="submit">Tìm</button>
            </div>
        </div>
       </form>
    </div>
  </div>