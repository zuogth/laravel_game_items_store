@extends('user.main')
@section('content')
    @include('user.alert')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary w-50 m-auto">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <br/>

            <form method="POST" action="" id="m-form-login">
                <div class="card-body">

                    <div class="form-group form-login-input-page">
                        <div class="l-themes-page"><label for="email">Tài khoản email *</label></div>
                        <input type="text" class="form-control" id="email" placeholder="Nhập email *" name="email">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                        </div>
                    </div>

                    <div class="form-group form-login-input-page">
                        <div class="l-themes-page"><label for="password">Mật khẩu *</label></div>
                        <input type="password" id="password" class="form-control" placeholder="Nhập mật khẩu *"
                               name="password">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <button type="submit" id="login" class="btn btn-dark btn-sm w-50 m-2">Đăng nhập</button>
                        <a href="/forgot" class="btn btn-outline-dark btn-sm w-50 m-2">Quên mật khẩu?</a>
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

@endsection
