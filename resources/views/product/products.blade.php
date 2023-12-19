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
                            <td>{{$product->price}}</td>
                            <td>{{$product->now_available}}</td>
                            <td>{{$product->sold}}</td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm">Mua</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection