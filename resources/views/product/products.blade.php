@extends('user.main')

@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <br/>
<<<<<<< HEAD
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
=======
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
                                <td>{!! $product->name !!}</td>
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
                                    <a href="/products/{{$product->code}}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-cart-arrow-down"></i>
                                        MUA NGAY
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
>>>>>>> bc37bb91855846a08b1ced75c3d628406be9b746
        </div>

    </div>

@endsection
