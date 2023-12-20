<!DOCTYPE html>
<html lang="en">
<head>
    @include('user.head')
    <link rel="stylesheet" href="/template/user/dist/css/login.css">
</head>
<body class="hold-transition login-page">
@include('user.alert')
<div class="main" style="width:100%">
    <div class="container">
        <div class="l-page-desgin">
            <div class="l-detail-page">
                <div class="l-themes-login-page"><h3>Đăng ký</h3></div>

                <div class="l-themes-register-page"><h3><a href="/user/login">Đăng nhập</a></h3></div>
            </div>
            <form method="POST" action="" id="m-form-register-main">
                <div class="form-login-input-page">
                    <div class="l-themes-page"><label for="username">Tài khoản email *</label></div>
                    <input type="text" id="email" placeholder="Nhập email *" name="email">
                    <div class="modal-errorMessage">
                        <span class="errorMessage"></span>
                        @error('email')
                        <span style="color: #da0101">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-login-input-page">
                    <div class="l-themes-page"><label for="password">Mật khẩu *</label></div>
                    <input type="password" id="password" placeholder="Nhập mật khẩu *" name="password">
                    <div class="modal-errorMessage">
                        <span class="errorMessage"></span>
                    </div>
                </div>
                <div class="form-login-input-page">
                    <div class="l-themes-page"><label for="password">Nhập lại mật khẩu *</label></div>
                    <input type="password" id="repeat_password" placeholder="Nhập mật khẩu *" name="repeat_password">
                    <div class="modal-errorMessage">
                        <span class="errorMessage"></span>
                        @error('repeat_password')
                        <span style="color: #da0101">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-login-input-page">
                    <div class="l-themes-page"><label for="fullname">Họ và tên *</label></div>
                    <input type="text" id="fullname" placeholder="Nhập họ và tên *" name="fullname">
                    <div class="modal-errorMessage">
                        <span class="errorMessage"></span>
                    </div>
                </div>
                <div class="form-login-input-page">
                    <div class="l-themes-page"><label for="phone">Số điện thoại *</label></div>
                    <input type="number" id="phone" placeholder="Nhập số điện *" name="phone">
                    <div class="modal-errorMessage">
                        <span class="errorMessage"></span>
                    </div>
                </div>

                <div class="l-list-button-page">
                    <div class="l-button-register-page">
                        <button type="submit" id="register" class="register">Đăng ký</button>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
<!-- /.login-box -->
<script src="/template/user/js/validate.js"></script>
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
@include('user.footer')
</body>
</html>
