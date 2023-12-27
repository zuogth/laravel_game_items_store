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
                <div class="l-themes-register-page"><h3>Quên mật khẩu</h3></div>
            </div>
            <form method="POST" action="" id="m-form-forgot-pass">
                <div class="form-login-input-page">
                    <div class="l-themes-page"><label for="email">Email *</label></div>
                    <input type="email" id="email" placeholder="Nhập email nhận mật khẩu *" name="email">
                    <div class="modal-errorMessage">
                        <span class="errorMessage"></span>
                    </div>
                </div>
                <div class="l-list-button-page">
                    <div class="l-button-register-page">
                        <button type="submit" id="register" class="register">Đồng ý</button>
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
        form: "#m-form-forgot-pass",
        error: ".errorMessage",
        formGroupSelector: '.form-login-input-page',
        rules: [
            validation.isRequired("#email", "Bạn hãy nhập email"),
            validation.isEmail("#email", "Trường này phải là email")

        ],
        onSubmit: function (data) {
            console.log(data)
        }
    })
</script>
</body>
</html>
