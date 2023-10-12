<li class="nav-item navbar-dropdown dropdown-user dropdown">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
      <div class="avatar avatar-online">
        {{-- <img src="{{ asset('dashboard/assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" /> --}}
        @if (Auth::user()->image == null)
          <img src="{{ asset('dashboard/assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle"/>
        @else
          <img src="{{ asset('dashboard/upload_img/user/'.Auth::user()->image.'') }}"  alt class="w-px-40 h-auto rounded-circle"/>
        @endif
      </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
      <li>
        <a class="dropdown-item" href="{{ route('edit_profile_user') }}">
          <div class="d-flex">
            <div class="flex-shrink-0 me-3">
              <div class="avatar avatar-online">
                {{-- <img src="{{ asset('dashboard/assets/img/avatars/1.png') }}" /> --}}
                @if (Auth::user()->image == null)
                  <img src="{{ asset('dashboard/assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle"/>
                @else
                  <img src="{{ asset('dashboard/upload_img/user/'.Auth::user()->image.'') }}"  alt class="w-px-40 h-auto rounded-circle"/>
                @endif
              </div>
            </div>
            <div class="flex-grow-1">
                <span class="fw-semibold d-block">{{Auth::user()->name}}</span>
                <small class="text-muted">{{Auth::user()->email}}</small>
            </div>
          </div>
        </a>
      </li>
      <li>
        <div class="dropdown-divider"></div>
      </li>
      <li>
        <a class="dropdown-item" href="{{ route('edit_profile_user') }}">
          <i class="bx bx-user me-2"></i>
          <span class="align-middle">Hồ sơ</span>
        </a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ route('calender') }}">
        {{-- <a class="dropdown-item" href="{{ route('calendar') }}"> --}}
          <i class='bx bx-calendar me-2'></i>
          <span class="align-middle">Lịch làm việc</span>
        </a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ route('salary') }}">
          <i class='bx bxs-offer me-2'></i>
          <span class="align-middle">Bảng lương</span>
        </a>
      </li>
      <li>
        <div class="dropdown-divider"></div>
      </li>
      <li>
        <a class="dropdown-item" href="{{route('logout')}}">
          <i class="bx bx-log-out-circle"></i>
          <span class="align-middle">Đăng xuất</span>
        </a>
      </li>
    </ul>
  </li>