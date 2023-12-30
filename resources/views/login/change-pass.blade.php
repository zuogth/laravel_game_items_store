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

            <form method="POST" action="" id="m-form-change-pass">
                <div class="card-body">

                    <div class="form-group form-login-input-page">
                        <div class="l-themes-page"><label for="password">Mật khẩu cũ *</label></div>
                        <input type="password" id="password" class="form-control" placeholder="Nhập mật khẩu cũ *" name="password">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                        </div>
                    </div>
                    <div class="form-group form-login-input-page">
                        <div class="l-themes-page"><label for="password-new">Mật khẩu mới *</label></div>
                        <input type="password" id="password-new" class="form-control" placeholder="Nhập mật khẩu mới *" name="password-new">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                        </div>
                    </div>

                    <div class="form-group form-login-input-page">
                        <div class="l-themes-page"><label for="password-repeat">Mật khẩu mới *</label></div>
                        <input type="password" id="password-repeat" class="form-control" placeholder="Nhập lại mật khẩu *" name="password-repeat">
                        <div class="modal-errorMessage">
                            <span class="errorMessage"></span>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button type="submit" id="login" class="btn btn-dark btn-sm w-50 m-2">Đồng ý</button>
                        <a href="/" class="btn btn-outline-dark btn-sm w-50 m-2">Quay lại</a>
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

@endsection
