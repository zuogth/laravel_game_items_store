@extends('user.main')

@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <br/>
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <table class="table table-bordered table-hover" id="table-data">
                        <thead style="background:#12214E;color:white;">
                        <th>Sản phẩm</th>
                        <th class="text-center hidemobile" style="width:10%">Hiện có</th>
                        <th class="text-center hidemobile" style="width:10%">Đã bán</th>
                        <th class="text-center hidemobile" style="width:10%">Giá</th>
                        <th class="text-center hidemobile" style="width:10%">Thao tác</th>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="name-product">{!! $product->name !!}</td>
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
                                <td class="text-center">
                                    @if($product->total_quantity > 0)
                                        <a href="/products/{{$product->code}}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-cart-arrow-down"></i>
                                            MUA NGAY
                                        </a>
                                    @endif
                                    @if($product->total_quantity == 0)
                                        <button class="btn btn-primary btn-sm" disabled>
                                            <i class="fal fa-sad-tear"></i>
                                            HẾT HÀNG
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
