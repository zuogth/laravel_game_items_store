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
                <div class="l-themes-register-page"><h3>Đổi mật khẩu</h3></div>
            </div>
            <form method="POST" action="" id="m-form-change-pass">
                <div class="form-login-input-page">
                    <div class="l-themes-page"><label for="password">Mật khẩu cũ *</label></div>
                    <input type="password" id="password" placeholder="Nhập mật khẩu cũ *" name="password">
                    <div class="modal-errorMessage">
                        <span class="errorMessage"></span>
                    </div>
                </div>
                <div class="form-login-input-page">
                    <div class="l-themes-page"><label for="password-new">Mật khẩu mới *</label></div>
                    <input type="password" id="password-new" placeholder="Nhập mật khẩu mới *" name="password-new">
                    <div class="modal-errorMessage">
                        <span class="errorMessage"></span>
                    </div>
                </div>

                <div class="form-login-input-page">
                    <div class="l-themes-page"><label for="password-repeat">Mật khẩu mới *</label></div>
                    <input type="password" id="password-repeat" placeholder="Nhập lại mật khẩu *" name="password-repeat">
                    <div class="modal-errorMessage">
                        <span class="errorMessage"></span>
                    </div>
                </div>
                <input type="text" id="id-user" name="id-user" value="{{\Illuminate\Support\Facades\Auth::user()->id}}" hidden>
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
        form: "#m-form-change-pass",
        error: ".errorMessage",
        formGroupSelector: '.form-login-input-page',
        rules: [
            validation.isRequired("#password", "Bạn hãy nhập mật khẩu cũ"),
            validation.isRequired("#password-new", "Bạn hãy nhập mật khẩu mới"),
            validation.isMinLength("#password-new", min = 6, `Số kí tự phải lớn hơn hoặc bằng ${min}`),
            validation.isRequired("#password-repeat", "Bạn hãy nhập lại mật khẩu"),
            validation.isPassword_confirm("#password-repeat",()=>{
                return document.querySelector('#m-form-change-pass #password-new').value
            } , "Vui lòng xác nhập lại mật khẩu")

        ],
        onSubmit: function (data) {
            console.log(data)
        }
    })
</script>
</body>
</html>
