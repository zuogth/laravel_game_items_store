@extends('user.main')
@section('content')
    @include('user.alert')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary m-auto col-md-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <br/>

            <form method="POST" action="" id="m-form-register-main">
                <div class="card-body">

                    <div class="form-group form-login-input-page">
                        <div class="l-themes-page"><label for="email">Tài khoản email *</label></div>
                        <input type="text" class="form-control" id="email" placeholder="Nhập email *" name="email">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                            @error('email')
                            <span style="color: #da0101">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group form-login-input-page">
                        <div class="l-themes-page"><label for="password">Mật khẩu *</label></div>
                        <input type="password" id="password" class="form-control" placeholder="Nhập mật khẩu *" name="password">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                        </div>
                    </div>

                    <div class="form-group form-login-input-page">
                        <div class="l-themes-page"><label for="password">Nhập lại mật khẩu *</label></div>
                        <input type="password" id="repeat_password" class="form-control"  placeholder="Nhập mật khẩu *" name="repeat_password">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                            @error('repeat_password')
                            <span style="color: #da0101">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group form-login-input-page">
                        <div class="l-themes-page"><label for="fullname">Họ và tên *</label></div>
                        <input type="text" id="fullname" class="form-control"  placeholder="Nhập họ và tên *" name="fullname">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                        </div>
                    </div>
                    <div class="form-group form-login-input-page">
                        <div class="l-themes-page"><label for="phone">Số điện thoại *</label></div>
                        <input type="number" id="phone" class="form-control"  placeholder="Nhập số điện *" name="phone">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <button type="submit" id="login" class="btn btn-dark btn-sm w-50 m-2">Đăng ký</button>
                        <a href="/login" class="btn btn-outline-dark btn-sm w-50 m-2">Đăng nhập</a>
                    </div>
                    @csrf
                </div>

            </form>
        </div>

    </div>


@endsection
@section('lib')
    <script>
        validation({
            form: "#m-form-register-main",
            error: ".errorMessage",
            formGroupSelector: '.form-login-input-page',
            rules: [
                validation.isRequired("#password", "Bạn hãy nhập mật khẩu"),
                validation.isMinLength("#password", min = 6, `Số kí tự phải lớn hơn hoặc bằng ${min}`),
                validation.isRequired("#repeat_password", "Bạn hãy nhập lại mật khẩu"),
                validation.isPassword_confirm("#repeat_password", () => {
                    return document.querySelector('#m-form-register-main #password').value
                }, "Vui lòng xác nhập lại mật khẩu"),
                validation.isRequired("#fullname", "Bạn hãy nhập họ và tên"),
                validation.isRequired("#email", "Bạn hãy nhập email"),
                validation.isEmail("#email", "Trường này phải là email"),
                validation.isRequired("#phone", "Bạn hãy nhập số điện thoại"),

            ],
            onSubmit: function (data) {
                console.log(data)
            }
        })
    </script>
@endsection
