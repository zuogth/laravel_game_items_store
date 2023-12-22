@extends('user.main')
@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <br/>

            @foreach($mapProducts as $key=>$mapProduct)
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <table class="table table-bordered table-hover" id="table-data">
                            <thead style="background:#12214E;color:white;">
                            <th>{{$key}}</th>
                            <th class="text-center hidemobile" style="width:10%">Hiện có</th>
                            <th class="text-center hidemobile" style="width:10%">Đã bán</th>
                            <th class="text-center hidemobile" style="width:10%">Giá</th>
                            <th class="text-center hidemobile" style="width:10%">Thao tác</th>
                            </thead>
                            <tbody>
                            @foreach($mapProduct as $product)
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
            @endforeach
        </div>

    </div>


    <div class="col-md-6">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Lịch sử giao dịch</h3>
            </div>
            <br/>

            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-bordered table-hover" id="table-data">
                        <thead style="background:#12214E;color:white;">
                        <tr>
                            <th class="text-center hidemobile">Mã giao dịch</th>
                            <th class="text-center hidemobile">Ngày giao dịch</th>
                            <th class="text-center hidemobile">Phương thức</th>
                            <th class="text-center hidemobile">Tổng tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bills as $bill)
                            <tr>
                                <td>{{$bill->bill_code}}...</td>
                                <td class="text-center">
                                    <button class="btn btn-block btn-outline-success btn-sm">
                                        <span class="span-btn"><b> {{$bill->bill_date}}</b></span>
                                    </button>
                                </td>
                                <td class="text-center">
                                    {!! \App\Helpers\Helper::convertPayType($bill->pay_type) !!}
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-block btn-outline-danger btn-sm">
                                        <span class="span-btn">
                                             <i class="fas fa-money-bill"></i>
                                            <b>   {!! \App\Helpers\Helper::price($bill->total_price) !!}</b>
                                        </span>
                                    </button>
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
