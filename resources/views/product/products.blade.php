@extends('user.main')

@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <br/>
            <table class="table" id="table-data">
                <thead>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Hiện có</th>
                <th>Đã bán</th>
                <th style="width:10%">&nbsp;</th>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{App\Helpers\Helper::price($product->price)}}</td>
                        <td>{{$product->now_available}}</td>
                        <td>{{$product->sold}}</td>
                        <td>
                            @if($product->now_available <= 0)
                                <a class="btn btn-warning btn-sm">Hết hàng</a>
                            @else
                                <a href="/products/{{$product->code}}" class="btn btn-primary btn-sm">Mua</a>
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
