<div class="app-brand demo">
    <a href="{{ route('index_dashboard') }}" class="app-brand-link d-flex">
      <span class="app-brand-text demo menu-text fw-bolder ms-2">Interior </span><span class="menu-text fw-bolder ms-2" style="color: rgb(231, 171, 6)">CS</span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>
  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item">
      <a href="{{ route('index_dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Product</span>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <div data-i18n="Account Settings">Product</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="pages-account-settings-account.html" class="menu-link">
            <div data-i18n="Account">New Product</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="pages-account-settings-notifications.html" class="menu-link">
            <div data-i18n="Notifications">List Product</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-box"></i>
        <div data-i18n="Authentications">Type Product</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="auth-login-basic.html" class="menu-link" target="_blank">
            <div data-i18n="Basic">New Type</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="auth-register-basic.html" class="menu-link" target="_blank">
            <div data-i18n="Basic">List Type</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-crown"></i>
        <div data-i18n="Misc">Supplier  - Material</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item active">
          <a href="pages-misc-error.html" class="menu-link">
            <div data-i18n="Error">New Supplier </div>
          </a>
        </li>
        <li class="menu-item">
          <a href="pages-misc-under-maintenance.html" class="menu-link">
            <div data-i18n="Under Maintenance">List Supplier </div>
          </a>
        </li> 

        <li class="menu-item">
          <a href="pages-misc-error.html" class="menu-link">
            <div data-i18n="Error">New Material</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="pages-misc-under-maintenance.html" class="menu-link">
            <div data-i18n="Under Maintenance">List Material</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cube-alt"></i>
        <div data-i18n="Authentications">Warehouse</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="auth-login-basic.html" class="menu-link" target="_blank">
            <div data-i18n="Basic">New loại Warehouse</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="auth-register-basic.html" class="menu-link" target="_blank">
            <div data-i18n="Basic">List Warehouse </div>
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
        <div data-i18n="User interface">User</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="ui-accordion.html" class="menu-link">
            <div data-i18n="Accordion">New User</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-alerts.html" class="menu-link">
            <div data-i18n="Alerts">List User</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-heart"></i>
        <div data-i18n="User interface">Favorite</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="ui-accordion.html" class="menu-link">
            <div data-i18n="Accordion">New Favorite</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="ui-alerts.html" class="menu-link">
            <div data-i18n="Alerts">List Favorite</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cart"></i>
        <div data-i18n="Extended UI">Cart</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="extended-ui-perfect-scrollbar.html" class="menu-link">
            <div data-i18n="Perfect Scrollbar">New Cart</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="extended-ui-text-divider.html" class="menu-link">
            <div data-i18n="Text Divider">List Cart</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="icons-boxicons.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-comment-dots"></i>
        <div data-i18n="Boxicons">Comment</div>
      </a>
    </li>

    <!-- Forms & Tables -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Quản lý thông tin khác</span></li>
    <!-- Forms -->
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-lock-alt"></i>
        <div data-i18n="Form Elements">Roles</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-check-shield"></i>
        <div data-i18n="Form Layouts">Status Interior</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-purchase-tag-alt"></i>
        <div data-i18n="Form Layouts">Discount</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-building-house"></i>
        <div data-i18n="Form Layouts">Province - City</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="form-layouts-vertical.html" class="menu-link">
            <div data-i18n="Vertical Form">List Province</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="form-layouts-vertical.html" class="menu-link">
            <div data-i18n="Vertical Form">List City</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cookie"></i>
        <div data-i18n="Form Layouts">Color Product</div>
      </a>
    </li>
  </ul>