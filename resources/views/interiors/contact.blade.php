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
            <div class="container mt-5 mb-3">
              <div class="row mt-4 justify-content-center">
                <div class="col-md-10">
                  <div class="card mb-3">
                    <div class="row g-0 shadow rounded-3">
                      <div class="col-md-7">
                        <div class="card-body py-5">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="text-center">
                                <i class='bx bx-envelope p-2 fs-3 mb-2' style="background-color: #ffcf6e; border-radius: 50%; color: #ffffff;"></i>
                                <p class="fs-6">admin@gmail.com</p>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="text-center">
                                <i class='bx bx-phone-call p-2 fs-3 mb-2' style="background-color: #ffcf6e; border-radius: 50%; color: #ffffff;"></i>
                                <p class="fs-6">+84 947.508.288</p>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="text-center">
                                <i class='bx bxl-instagram p-2 fs-3 mb-2' style="background-color: #ffcf6e; border-radius: 50%; color: #ffffff;"></i>
                                <p class="fs-6">&commat;chungsi_interior1905</p>
                              </div>
                            </div>
                          </div>
                          <div class="row px-4">
                            <form action="{{ route('sendmail') }}" method="POST">
                              @csrf
                              @if (empty(Auth::user()))
                                <div class="mb-3">
                                  <label class="form-label" for="basic-icon-default-company">Tên của bạn</label>
                                  <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-company2" class="input-group-text">
                                      <i class='bx bx-rename'></i>
                                    </span>
                                    <input  type="text"  id="basic-icon-default-company"  class="form-control"  placeholder="..."  aria-label="ACME Inc."  aria-describedby="basic-icon-default-company2"  name="name"
                                    />
                                  </div>
                                </div>
                                <div class="mb-3">
                                  <label class="form-label" for="basic-icon-default-email">Email</label>
                                  <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input  type="text"  id="basic-icon-default-email"  class="form-control"  placeholder="..."  aria-label="john.doe"  aria-describedby="basic-icon-default-email2"  name="email_user"
                                    />
                                  </div>
                                  <div class="form-text">Nhập email của bạn chúng tôi sẽ liên hệ lại.</div>
                                </div>
                                <div class="mb-3">
                                  <label class="form-label" for="basic-icon-default-phone">Số điện thoại</label>
                                  <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-phone2" class="input-group-text"
                                      ><i class="bx bx-phone"></i
                                    ></span>
                                    <input  type="text" name="phone"  id="basic-icon-default-phone"  class="form-control phone-mask"  placeholder="..."  aria-label="658 799 8941"  aria-describedby="basic-icon-default-phone2"
                                    />
                                  </div>
                                </div>
                              @else
                                <div class="mb-3">
                                  <label class="form-label" for="basic-icon-default-company">Tên của bạn</label>
                                  <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-company2" class="input-group-text">
                                      <i class='bx bx-rename'></i>
                                    </span>
                                    <input  type="text"  id="basic-icon-default-company"  class="form-control"  placeholder="..."  aria-label="ACME Inc."  aria-describedby="basic-icon-default-company2"  name="name"  value="{{ Auth::user()->name }}"
                                    />
                                  </div>
                                </div>
                                <div class="mb-3">
                                  <label class="form-label" for="basic-icon-default-email">Email</label>
                                  <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input  type="text"  id="basic-icon-default-email"  class="form-control"  placeholder="..."  aria-label="john.doe"  aria-describedby="basic-icon-default-email2"  name="email_user"  value="{{ Auth::user()->email }}"
                                    />
                                  </div>
                                  <div class="form-text">Nhập email của bạn chúng tôi sẽ liên hệ lại.</div>
                                </div>
                                <div class="mb-3">
                                  <label class="form-label" for="basic-icon-default-phone">Số điện thoại</label>
                                  <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-phone2" class="input-group-text"
                                      ><i class="bx bx-phone"></i
                                    ></span>
                                    <input  type="text" name="phone"  id="basic-icon-default-phone"  class="form-control phone-mask"  placeholder="..."  aria-label="658 799 8941"  aria-describedby="basic-icon-default-phone2"  value="{{ Auth::user()->phone }}"
                                    />
                                  </div>
                                </div>
                              @endif
                              <input type="hidden" name="email" value="zzztrunzzz@gmail.com">
                              <input type="hidden" name="check" value="contact">
                              <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-message">Message</label>
                                <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-message2" class="input-group-text"
                                    ><i class="bx bx-comment"></i
                                  ></span>
                                  <textarea
                                    id="basic-icon-default-message"
                                    class="form-control"
                                    placeholder="Viết tất cả những gì bạn muốn vào đây ..."
                                    aria-describedby="basic-icon-default-message2"
                                    name="content"
                                  ></textarea>
                                </div>
                              </div>
                              <button type="submit" class="btn btn-primary mt-2">Send <i class='bx bx-mail-send'></i></button>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <img class="card-img card-img-right" src="{{ asset('interior\assets\img\backgrounds\img.jpg') }}" alt="Card image" />
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
