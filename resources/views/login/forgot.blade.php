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

            <form method="POST" action=""  id="m-form-forgot-pass">
                <div class="card-body">

                    <div class="form-group form-login-input-page">
                        <div class="l-themes-page"><label for="email">Email *</label></div>
                        <input class="form-control" type="email" id="email" placeholder="Nhập email nhận mật khẩu *" name="email">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button type="submit" id="login" class="btn btn-dark btn-sm w-50 m-2">Đồng ý</button>
                        <a href="/login" class="btn btn-outline-dark btn-sm w-50 m-2">Đăng nhập</a>
                    </div>
                    @csrf
                </div>

            </form>
        </div>

    </div>


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
@endsection
@section('lib')
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
@endsection
