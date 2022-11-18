<div class="app-brand demo">
  <a href="{{ route('index_dashboard') }}" class="app-brand-link d-flex">
    <span class="app-brand-text demo menu-text fw-bolder ms-2">Interior </span><span class="menu-text fw-bolder ms-2" style="color: rgb(231, 171, 6)">CS</span>
  </a>
  <a href="#" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
    <i class="bx bx-chevron-left bx-sm align-middle"></i>
  </a>
</div>

<div class="menu-inner-shadow"></div>
<ul class="menu-inner py-1">
  <!-- Dashboard -->
  <li class="menu-item">
    <a href="{{ route('index_dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-home-circle"></i>
      <div >Dashboard</div>
    </a>
  </li>

  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Product</span>
  </li>
  <li class="menu-item">
    <a href="#" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-dock-top"></i>
      <div >Product</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item">
        <a href="{{ route('product_dashboard') }}" class="menu-link">
          <div  >New Product</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ route('list_product_dashboard') }}" class="menu-link">
          <div >List Product</div>
        </a>
      </li>
    </ul>
  </li>
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
  <li class="menu-item active">
    <a href="#" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-crown"></i>
      <div >Supplier  - Material</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item">
        <a href=" {{ route('supplier_dashboard') }}" class="menu-link">
          <div >New Supplier </div>
        </a>
      </li>
      <li class="menu-item active">
        <a href="{{ route('list_supplier_dashboard') }}" class="menu-link">
          <div >List Supplier </div>
        </a>
      </li> 

      <li class="menu-item">
        <a href="{{ route('material_dashboard') }}" class="menu-link">
          <div >New Material</div>
        </a>
      </li>
      <li class="menu-item ">
        <a href="{{ route('list_material_dashboard') }}" class="menu-link">
          <div >List Material</div>
        </a>
      </li>
    </ul>
  </li>
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
  <!-- Components -->
  <li class="menu-header small text-uppercase"><span class="menu-header-text">User</span></li>
  <!-- Cards -->
  <li class="menu-item">
    <a href="javascript:void(0)" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-user"></i>
      <div >User</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item">
        <a href="{{ route('user_dashboard') }}" class="menu-link">
          <div >New User</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ route('list_user_dashboard') }}" class="menu-link">
          <div >List User</div>
        </a>
      </li>
    </ul>
  </li>
  <li class="menu-item">
    <a href="javascript:void(0)" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-heart"></i>
      <div >Favorite</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item">
        <a href="{{ route('favorite_dashboard') }}" class="menu-link">
          <div >New Favorite</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ route('list_favorite_dashboard') }}" class="menu-link">
          <div >List Favorite</div>
        </a>
      </li>
    </ul>
  </li>
  <li class="menu-item">
    <a href="javascript:void(0)" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-cart"></i>
      <div>Cart</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item">
        <a href="{{ route('cart_dashboard') }}" class="menu-link">
          <div >New Cart</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ route('list_cart_dashboard') }}" class="menu-link">
          <div>List Cart</div>
        </a>
      </li>
    </ul>
  </li>
  <li class="menu-item">
    <a href="{{ route('comment_dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-comment-dots"></i>
      <div>Comment</div>
    </a>
  </li>

  <!-- Forms & Tables -->
  <li class="menu-header small text-uppercase"><span class="menu-header-text">Quản lý thông tin khác</span></li>
  <!-- Forms -->
  <li class="menu-item">
    <a href="{{ route('roles_dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-lock-alt"></i>
      <div>Roles</div>
    </a>
  </li>
  <li class="menu-item">
    <a href="{{ route('status_dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-check-shield"></i>
      <div>Status Interior</div>
    </a>
  </li>
  <li class="menu-item">
    <a href="{{ route('discount_dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-purchase-tag-alt"></i>
      <div>Discount</div>
    </a>
  </li>
  <li class="menu-item">
    <a href="#" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-building-house"></i>
      <div>Province - City</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item">
        <a href="{{ route('list_province_dashboard') }}" class="menu-link">
          <div>List Province</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{ route('list_city_dashboard') }}" class="menu-link">
          <div data-i18n="Vertical Form">List City</div>
        </a>
      </li>
    </ul>
  </li>
  <li class="menu-item">
    <a href="{{ route('color_dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-cookie"></i>
      <div>Color Product</div>
    </a>
  </li>
</ul>