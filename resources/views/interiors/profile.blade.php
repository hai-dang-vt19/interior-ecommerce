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
            <div class="container mt-5 mb-5">
              <div class="row row-cols-1 row-cols-md-1 g-4 justify-content-center">
                <div class="col-lg-10 mt-5">
                    <div class="card mb-4">
                        <h5 class="card-header">Thông tin cá nhân
                        </h5>
                        <!-- Account -->
                        <form action="{{ route('update_profile',['id'=>Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">@csrf
                          <div class="card-body">
                              <script>
                                  function chooseFile(fileInput){
                                      if(fileInput.files && fileInput.files[0]){
                                          var reader = new FileReader();
                                          reader.onload = function(e){
                                              $('#display_image').attr('src', e.target.result);
                                          }
                                          reader.readAsDataURL(fileInput.files[0]);
                                      }
                                  }
                              </script>
                              @php
                                  use Carbon\Carbon;
                              @endphp
                              <div class="d-flex align-items-start align-items-sm-center gap-4">
                                @if (Auth::user()->image == null)
                                  <img src="{{ asset('dashboard/assets/img/avatars/7.png') }}" alt="user-avatar" class="d-block rounded shadow" height="100" width="100" id="display_image"/>
                                @else
                                  <img src="{{ asset('dashboard/upload_img/user/'.Auth::user()->image.'') }}" alt="user-avatar" class="d-block rounded shadow" height="100" width="100" id="display_image"/>
                                @endif
                                <div class="button-wrapper">
                                  <label class="btn btn-sm btn-primary me-2 mb-4">
                                    <span class="d-none d-sm-block"><i class='bx bxs-camera'></i></span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" name="images" onchange="chooseFile(this)" class="account-file-inputx" hidden/>
                                  </label>
                                  @if (Auth::user()->district == null || Auth::user()->province == null)
                                    <p class="text-muted mb-0">D/c: Chưa cập nhật đủ thông tin.</p>  
                                  @else
                                    <p class="text-muted mb-0">D/c: {{Auth::user()->district}}, {{Auth::user()->city}}, {{Auth::user()->province}}</p> 
                                  @endif
                                </div>
                              </div>
                          </div>
                          <hr class="my-0" />
                          <div class="card-body">
                            
                              <div class="row">
                                  <!-- Basic with Icons -->
                                  <div class="col-xxl">
                                      <div class="card-header">
                                          <script type="text/javascript">
                                              function EnableCheckSeri(ckBtnUp){
                                                var ckBtnUpProfile = document.getElementById("ckBtnUpProfile");
                                                var ckBtnUpProfileMK = document.getElementById("ckBtnUpProfileMK");
                                                ckBtnUpProfile.disabled = ckBtnUp.checked ? false : true;
                                                ckBtnUpProfileMK.disabled = ckBtnUp.checked ? false : true;
                                                if(!ckBtnUpProfile.disabled){
                                                  ckBtnUpProfile.focus();
                                                }
                                                if(!ckBtnUpProfileMK.disabled){
                                                  ckBtnUpProfileMK.focus();
                                                }
                                              }
                                          </script>
                                          <div class="form-check form-switch mb-2" style="z-index: 5">
                                              <input class="form-check-input" type="checkbox" id="ckBtnUp" onclick="EnableCheckSeri(this)"/>
                                              <label class="form-check-label" for="ckBtnUp"
                                                >Cho phép cập nhật</label
                                              >
                                              <div class="float-end">
                                                  <button class="btn btn-sm btn-dark" id="ckBtnUpProfileMK"  disabled="disabled"  type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBoth" aria-controls="offcanvasBoth">
                                                  Đổi mật khẩu
                                                  </button>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="card-body">
                                          <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Họ tên</label>
                                            <div class="col-sm-10">
                                              <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                                <input type="text" class="form-control"  value="{{ Auth::user()->name }}" name="name"/>
                                              </div>
                                            </div>
                                          </div>
                                          
                                          <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                              <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                                <input type="text" class="form-control" value="{{ Auth::user()->email }}" name="email"/>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row mb-3">
                                              <label class="col-sm-2 col-form-label">Giới tính</label>
                                              <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                  <span class="input-group-text"><i class='bx bx-group'></i></span>
                                                  <input type="text" class="form-control"  value="{{ Auth::user()->sex_user }}" name="sx_us"/>
                                                </div>
                                              </div>
                                          </div>
                                          <div class="row mb-3">
                                              <label class="col-sm-2 col-form-label">Ngày sinh</label>
                                              <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                  <span class="input-group-text"><i class='bx bx-calendar'></i></span>
                                                  <input type="text" class="form-control" value="{{ Carbon::parse(Auth::user()->date_user)->format('d/m/Y') }}" name="date"  id="datepiker"/>
                                                </div>
                                              </div>
                                          </div>
                                          <div class="row mb-3">
                                            <label class="col-sm-2 form-label">SĐT</label>
                                            <div class="col-sm-10">
                                              <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                                <input type="text" class="form-control phone-mask" value="{{ Auth::user()->phone }}" name="phone"/>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row mb-3">
                                            <label class="col-sm-2 form-label">Thành phố</label>
                                            <div class="col-sm-5">
                                              <select class="form-select" name="city" id="choices-multiple-remove-button" style="z-index: 4">
                                                  <option value="{{ Auth::user()->city }}" selected disabled>
                                                      {{ Auth::user()->city }} - {{ Auth::user()->province }}
                                                  </option>
                                                  @foreach ($city as $itm_city)
                                                      <option value="{{ $itm_city->id }}">{{ $itm_city->name_city }} - {{ $itm_city->city_province }}</option>
                                                  @endforeach
                                              </select>
                                            </div>
                                          </div>
                                          <div class="row mb-3">
                                            <label class="col-sm-2 form-label">Địa chỉ cụ thể</label>
                                            <div class="col-sm-10">
                                              <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                                <input type="text" class="form-control phone-mask" value="{{ Auth::user()->district }}" name="district"/>
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="mt-2">
                                <button type="submit" id="ckBtnUpProfile" disabled="disabled" class="btn btn-success float-end me-5 mb-3">Save changes</button>
                              </div>
                            
                          </div>
                        </form>
                        <!-- /Account -->
                    </div>
                    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasBoth" aria-labelledby="offcanvasBothLabel">
                      <div class="offcanvas-header">
                          <h5 id="offcanvasBothLabel" class="offcanvas-title">Nhập những thông tin sau</h5>
                          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                      </div>
                      <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                          <div class="app-brand justify-content-center">
                          <img class="mt-2 ms-2 mb-5" src="{{ asset('interior\img\core-img\logo.png') }}" width="150px" height="61px" alt="Interior CS">
                          </div>
                          <form action="{{ route('update_password') }}" method="POST">
                          @csrf
                          <div class="mb-3">
                              <label class="form-label">Mật khẩu hiện tại</label>
                              <input class="form-control" type="password" name="pass_old"/>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Mật khẩu mới</label>
                              <input class="form-control" type="password" name="pass_new"/>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Nhập lại mật khẩu mới</label>
                              <input class="form-control" type="password" name="check_pass_new"/>
                          </div>
                          <hr class="mt-5">
                          <button type="submit" class="btn btn-success mb-2 d-grid w-100">Đổi mật khẩu</button>
                          </form>
                      </div>
                    </div>
                    <div class="card">
                        <h5 class="card-header">Khóa tài khoản</h5>
                        <div class="card-body">
                          <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                              <h6 class="alert-heading fw-bold mb-1">Bạn có chắc chắn khóa tài khoản này?</h6>
                              <p class="mb-0">Sau khi khóa tài khoản mà bạn muốn sử dụng lại thì liên hệ với chúng tôi.</p>
                            </div>
                          </div>
                            <a href="{{ route('lookup_user') }}"  onclick="return confirm('Bạn có chắc chắn khóa tài khoản này?')" class="btn btn-danger deactivate-account">Khóa tài khoản</a>
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
