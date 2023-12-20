@extends('user.main')

@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <form action="{{ '/payment/'.$bill_code }}" method="POST" id="form-buy-product">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="productname">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" id="productname"
                                   placeholder="Enter name" value="{{$product->name}}" readonly>
                            @error('name')
                            <span style="color: #da0101">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="priceentry">Giá</label>
                            <input type="number" name="price" class="form-control" id="priceentry"
                                   value="{{$product->price}}" readonly>
                            @error('price')
                            <span style="color: #da0101">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="now_available">Hiện có</label>
                            <input type="number" name="now_available" class="form-control" id="now_available"
                                   placeholder="Enter name" value="{{$product->now_available}}" readonly>
                            @error('now_available')
                            <span style="color: #da0101">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="quantity">Số lượng mua</label>
                            <input type="number" name="quantity" class="form-control" id="quantity">
                            <div class="modal-errorMessage">
                                <span class="errorMessage"></span>
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="id_game">ID Game</label>
                            <input type="text" name="id_game" class="form-control" id="id_game">
                            <div class="modal-errorMessage">
                                <span class="errorMessage"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" name="product_id" class="form-control" value="{{$product->id}}" hidden>
                <input type="text" name="bill_code" class="form-control" value="{{$bill_code}}" hidden>
                @csrf
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Thanh toán</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        let now_available = document.querySelector('#form-buy-product #now_available').value;
        validation({
            form: "#form-buy-product",
            error: ".errorMessage",
            formGroupSelector: '.form-group',
            rules: [
                validation.isRequired("#quantity", "Bạn hãy nhập số lượng muốn mua"),
                validation.isRequired("#id_game", "Bạn hãy nhập ID Game của bạn"),
                validation.isMin("#quantity", min = 0, `Số lượng muốn mua phải lớn hơn ${min}`),
                validation.isMax("#quantity", max = now_available, `Số lượng muốn mua phải nhỏ hơn hoặc bằng ${max}`),
            ],
            onSubmit: function (data) {
                console.log(data)
            }
        })
    </script>
@endsection
