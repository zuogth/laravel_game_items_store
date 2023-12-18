<!DOCTYPE html>
<html lang="en">
<head>
  @include('user.head')
</head>
<body class="hold-transition login-page">
@include('user.alert')
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>H3</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Đăng nhập vào hệ thống</p>

      <form action="/user/login" method="post" id="m-form-login">
        <div class="form-group">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Phone" name="phone" id="phone">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="modal-errorMessage">
                <span class="errorMessage"></span>
            </div>
        </div>
          <div class="form-group">
              <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                  <div class="input-group-append">
                      <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                      </div>
                  </div>
              </div>
              <div class="modal-errorMessage">
                  <span class="errorMessage"></span>
              </div>
          </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
        @csrf
      </form>
      <!-- /.social-auth-links -->

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script src="/user/js/validate.js"></script>
<script>
    validation({
        form: "#m-form-login",
        error: ".errorMessage",
        formGroupSelector: '.form-group',
        rules: [
            validation.isRequired("#phone", "Bạn hãy nhập số điện thoại"),
            validation.isRequired("#password", "Bạn hãy nhập mật khẩu"),
            validation.isMinLength("#password", min = 6 ,`Số kí tự phải lớn hơn hoặc bằng ${min}`)
        ],
        onSubmit: function (data) {
            console.log(data)
        }
    })
</script>
    @include('user.footer')
</body>
</html>
