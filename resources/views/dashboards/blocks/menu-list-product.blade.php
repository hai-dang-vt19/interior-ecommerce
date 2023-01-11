<div class="app-brand demo justify-content-center">
  <a href="{{ route('index_dashboard') }}" class="app-brand-link d-flex">
    <img class="mt-2 ms-2 mb-3" src="{{ asset('interior\img\core-img\logo.png') }}" width="140px" height="51px" alt="Interior CS">
  </a>
  <a href="#" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
    <i class="bx bx-chevron-left bx-sm align-middle"></i>
  </a>
</div>
<div class="menu-inner-shadow"></div>
<ul class="menu-inner py-1">
  <!-- Dashboard -->
  @can('admin')
    <li class="menu-item">
      <a href="{{ route('index_dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div >Dashboard</div>
      </a>
    </li>
    @endcan
  <li class="menu-item">
    <a href="{{ route('bill_dashboad') }}" class="menu-link">
      <i class='menu-icon tf-icons bx bx-compass'></i>
      <div>Đơn hàng</div>
    </a>
  </li>
  @can('admin_manager')
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Product</span>
  </li>
  @endcan
  <li class="menu-item active">
    <a href="#" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-dock-top"></i>
      <div>Product</div>
    </a>
    <ul class="menu-sub">
      @can('admin_manager')
      <li class="menu-item">
        <a href="{{ route('product_dashboard') }}" class="menu-link">
          <div >New Product</div>
        </a>
      </li>   
      @endcan
      <li class="menu-item active">
        <a href="{{ route('list_product_dashboard') }}" class="menu-link">
          <div >List Product</div>
        </a>
      </li>
    </ul>
  </li>
@can('admin_manager')
  <li class="menu-item">
    <a href="#" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-box"></i>
      <div >Type Product</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item">
        <a href="{{ route('type_dashboard') }}" class="menu-link">
          <div >New Type</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ route('list_type_dashboard') }}" class="menu-link">
          <div >List Type</div>
        </a>
      </li>
    </ul>
  </li>
@endcan
@can('admin_manager')
  <li class="menu-item">
    <a href="#" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-crown"></i>
      <div >Supplier  - Material</div>
    </a>
    <ul class="menu-sub">
       <li class="menu-item">
        <a href=" {{ route('supplier_dashboard') }}" class="menu-link">
          <div>Supplier </div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ route('material_dashboard') }}" class="menu-link">
          <div>Material</div>
        </a>
      </li>
    </ul>
  </li>
@endcan
@can('admin_manager')
  <li class="menu-item">
    <a href="#" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-cube-alt"></i>
      <div >Warehouse</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item">
        <a href="{{ route('warehouse_dashboard') }}" class="menu-link" target="_blank">
          <div >New loại Warehouse</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ route('list_warehouse_dashboard') }}" class="menu-link" target="_blank">
          <div >List Warehouse </div>
        </a>
      </li>
    </ul>
  </li>
@endcan
  <!-- Components -->
  @can('admin_manager')
    <li class="menu-header small text-uppercase"><span class="menu-header-text">User</span></li>
    @endcan
  <!-- Cards -->
  <li class="menu-item">
    <a href="javascript:void(0)" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-user"></i>
      <div>User</div>
    </a>
    <ul class="menu-sub">
      @can('admin_manager')
      <li class="menu-item">
        <a href="{{ route('user_dashboard') }}" class="menu-link">
          <div>New User</div>
        </a>
      </li>
      @endcan
      <li class="menu-item">
        <a href="{{ route('list_user_dashboard') }}" class="menu-link">
          <div>List User</div>
        </a>
      </li>
    </ul>
  </li>
@can('admin_manager')
  <li class="menu-item">
    <a href="{{ route('list_favorite_dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-heart"></i>
      <div>Favorite</div>
    </a>
  </li>
  <li class="menu-item">
    <a href="{{ route('list_cart_dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-cart"></i>
      <div>Cart</div>
    </a>
  </li>
  <li class="menu-item">
    <a href="{{ route('comment_dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-comment-dots"></i>
      <div data-i18n="Boxicons">Comment</div>
    </a>
  </li>
@endcan
@can('admin_manager')
  <!-- Forms & Tables -->
  <li class="menu-header small text-uppercase"><span class="menu-header-text">Quản lý thông tin khác</span></li>
  <!-- Forms -->
  @can('admin')
  <li class="menu-item">
    <a href="{{ route('roles_dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-lock-alt"></i>
      <div data-i18n="Form Elements">Roles</div>
    </a>
  </li>
  <li class="menu-item">
    <a href="{{ route('status_dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-check-shield"></i>
      <div data-i18n="Form Layouts">Status Interior</div>
    </a>
  </li>
  @endcan
  <li class="menu-item">
    <a href="{{ route('discount_dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-purchase-tag-alt"></i>
      <div data-i18n="Form Layouts">Discount</div>
    </a>
  </li>
  <li class="menu-item">
    <a href="{{route('list_province_dashboard')}}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-building-house"></i>
      <div data-i18n="Form Layouts">Province - City</div>
    </a>
  </li>
  <li class="menu-item">
    <a href="{{ route('color_dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-cookie"></i>
      <div data-i18n="Form Layouts">Color Product</div>
    </a>
  </li>
  @can('admin')
  <li class="menu-item">
    <a href="{{ route('slide') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-outline"></i>
      <div data-i18n="Form Layouts">Slide</div>
    </a>
  </li>
  <li class="menu-item">
    <a href="{{ route('history_dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-history"></i>
      <div>History</div>
    </a>
  </li>
  @endcan
@endcan
</ul>