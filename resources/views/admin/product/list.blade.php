@extends('user.main')

@section('content')
    <div class="col-12">

        <br/>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="common-datatable" class="table table-bordered table-hover">
                    <thead style="background:#343a40;color:white;">
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Mã sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đã bán</th>
                        <th>Giá</th>
                        <th>Loại</th>
                        <th>Trạng thái</th>
                        <th style="width:10%">Phương thức</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="name-product">{!! $product->name !!}</td>
                            <td class="name-product">{!! $product->code !!}</td>
                            <td class="text-center">
                                <button class="btn btn-block btn-outline-success btn-sm">
                                    <span class="span-btn">Còn lại:<b> {{$product->total_quantity}}</b></span>
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-block btn-outline-success btn-sm">
                                    <span class="span-btn">Đã bán:<b> {{$product->sold}}</b></span>
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-block btn-outline-danger btn-sm">
                                <span class="span-btn">
                                     <i class="fas fa-money-bill"></i>
                                    <b>   {!! \App\Helpers\Helper::price($product->price) !!}</b>
                                </span>

                                </button>
                            </td>
                            <td class="text-center">{{$product->category_code}}</td>
                            <td class="text-center">
                                <div class="custom-control custom-switch">
                                    @if($product->status == 1)
                                        <input type="checkbox" class="custom-control-input" id="{{$product->code}}"
                                               value="{{$product->status}}" checked>
                                    @else
                                        <input type="checkbox" class="custom-control-input" id="{{$product->code}}"
                                               value="{{$product->status}}">
                                    @endif
                                    <label class="custom-control-label" for="{{$product->code}}"></label>
                                </div>
                            </td>
                            <td class="text-center"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

@endsection
@section('lib')
    <script src="/template/admin/js/product.js"></script>
@endsection
