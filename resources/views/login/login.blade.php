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
                <div class="l-themes-login-page"><h3>Đăng nhập</h3></div>

                <div class="l-themes-register-page"><h3><a href="/register">Đăng ký</a></h3></div>
            </div>
            <form method="POST" action="" id="m-form-login">
                <div class="form-login-input-page">
                    <div class="l-themes-page"><label for="email">Tài khoản email *</label></div>
                    <input type="text" id="email" placeholder="Nhập email *" name="email">
                    <div class="modal-errorMessage">
                        <span class="errorMessage"></span>
                    </div>
                </div>
                <div class="form-login-input-page">
                    <div class="l-themes-page"><label for="password">Mật khẩu *</label></div>
                    <input type="password" id="password" placeholder="Nhập mật khẩu *" name="password">
                    <div class="modal-errorMessage">
                        <span class="errorMessage"></span>
                    </div>
                </div>

                <div class="l-list-button-page">
                    <div class="l-button-login">
                        <button type="submit" id="login" class="login">Đăng nhập</button>
                    </div>
                    <div class="l-footer-page">
                        <div class="forgot-password-page"><a href="/forgot">Quên mật khẩu?</a></div>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
<!-- /.login-box -->

@include('user.footer')
<script>
    validation({
        form: "#m-form-login",
        error: ".errorMessage",
        formGroupSelector: '.form-login-input-page',
        rules: [
            validation.isRequired("#email", "Bạn hãy nhập email"),
            validation.isEmail("#email", "Trường này phải là email"),
            validation.isRequired("#password", "Bạn hãy nhập mật khẩu"),
            validation.isMinLength("#password", min = 6, `Số kí tự phải lớn hơn hoặc bằng ${min}`)
        ],
        onSubmit: function (data) {
            console.log(data)
        }
    })
</script>
</body>
</html>
