<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            .row {
                --bs-gutter-x: 1.625rem;
                --bs-gutter-y: 0;
                display: flex;
                flex-wrap: wrap;
                margin-top: calc(-1 * var(--bs-gutter-y));
                margin-right: calc(-0.5 * var(--bs-gutter-x));
                margin-left: calc(-0.5 * var(--bs-gutter-x));
            }
            .col-12 {
                flex: 0 0 auto;
                flex-grow: 0;
                flex-shrink: 0;
                flex-basis: auto;
                width: 100%;
            }
            .row > * {
                flex-shrink: 0;
                width: 100%;
                max-width: 100%;
                padding-right: calc(var(--bs-gutter-x) * 0.5);
                padding-left: calc(var(--bs-gutter-x) * 0.5);
                margin-top: var(--bs-gutter-y);
            }
            .card {
                background-clip: padding-box;
                box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
            }
            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #ffffff;
                background-clip: border-box;
                border: 0 solid #d9dee3;
                border-radius: 0.5rem;
            }
            .border-0 {
                border: 0 !important;
            }
            .text-white {
                color: #fff !important;
            }
            .text-center {
                text-align: center !important;
            }
            .card-img-overlay {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                padding: 1.5rem;
                border-radius: 0.5rem;
            }
            .card-title {
                margin-bottom: 0.875rem;
            }
            .mt-2 {
                margin-top: 0.5rem !important;
            }
        </style>
    </head>
<body
style="background: #d53369;
background: -webkit-linear-gradient(to right, #cbad6d, #d53369);
background: linear-gradient(to right, #cbad6d, #d53369);"
>
    <div class="bod">
        <div class="row">
            <div class="col-12">
                <div class="border-0 text-white text-center">
                    <div class="card-img-overlay">
                        <a href="http://10.10.104.209:8099/interior-index" style="text-decoration: none;">
                            <h1 class="card-title"  style="color: #fff;">Chung Si Interior <br>
                            
                            </h1>
                        </a>
                      <p class="card-text">
                        {{ $data['name'] }} &#10084;
                      </p>
                        <p class="card-text" style="color: #FFC800;">
                            <span style="background-color: #fff;padding: 8px; border-radius: 25px;">
                                {{ $data['password'] }}
                            </span>
                        </p>
                      <p class="card-text">Sử dụng mã để đăng nhập khi chưa đổi mật khẩu</p>
                      <a href="http://10.10.104.209:8099/interior/loginMail/{{ $data['email'] }}/{{ $data['password'] }}" target="_blank" style="text-decoration: none; background-color: #ffff;color: #843f3f; padding: 5px;">Đăng nhập</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</body>
</html>