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
                            <input type="text" class="form-control" id="priceentry"
                                   value="{{\App\Helpers\Helper::price($product->price)}}" readonly>
                            @error('price')
                            <span style="color: #da0101">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="total_quantity">Hiện có</label>
                            <input type="number" name="total_quantity" class="form-control" id="total_quantity"
                                   placeholder="Enter name" value="{{$product->total_quantity}}" readonly>
                            @error('total_quantity')
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
                <input type="text" name="price" class="form-control" value="{{$product->price}}" hidden>
                <input type="number" name="sold" class="form-control" value="{{$product->sold}}" hidden>
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
        let total_quantity = document.querySelector('#form-buy-product #total_quantity').value;
        validation({
            form: "#form-buy-product",
            error: ".errorMessage",
            formGroupSelector: '.form-group',
            rules: [
                validation.isRequired("#quantity", "Bạn hãy nhập số lượng muốn mua"),
                validation.isRequired("#id_game", "Bạn hãy nhập ID Game của bạn"),
                validation.isMin("#quantity", min = 0, `Số lượng muốn mua phải lớn hơn ${min}`),
                validation.isMax("#quantity", max = total_quantity, `Số lượng muốn mua phải nhỏ hơn hoặc bằng ${max}`),
            ],
            onSubmit: function (data) {
                console.log(data)
            }
        })
    </script>
@endsection
