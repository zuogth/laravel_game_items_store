@extends('user.main')

@section('content')
<div class="col-md-12">
    <!-- jquery validation -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Lịch sử giao dịch</h3>
        </div>
        <br/>

        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-bordered table-hover" id="table-data">
                    <thead style="background:#12214E;color:white;top: 0" class="position-sticky">
                    <tr>
                        <th class="text-center hidemobile">Mã giao dịch</th>
                        <th class="text-center hidemobile">Mã sản phẩm</th>
                        <th class="text-center hidemobile">Ngày giao dịch</th>
                        <th class="text-center hidemobile">Mã tài khoản</th>
                        <th class="text-center hidemobile">Số luợng</th>
                        <th class="text-center hidemobile">Giá</th>
                        <th class="text-center hidemobile">Tổng tiền</th>
                        <th class="text-center hidemobile">Trạng thái</th>
                        <th class="text-center hidemobile">Phương thức</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bills as $bill)
                        <tr>
                            <td>{{$bill->bill_code}}</td>
                            <td>{{$bill->product_code}}</td>
                            <td class="text-center">
                                <button class="btn btn-block btn-outline-success btn-sm">
                                    <span class="span-btn"><b> {{$bill->bill_date}}</b></span>
                                </button>
                            </td>
                            <td>{{$bill->id_game}}</td>
                            <td>{{$bill->quantity}}</td>
                            <td class="text-center">
                                <button class="btn btn-block btn-outline-danger btn-sm">
                                        <span class="span-btn">
                                             <i class="fas fa-money-bill"></i>
                                            <b>   {!! \App\Helpers\Helper::price($bill->price) !!}</b>
                                        </span>
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-block btn-outline-danger btn-sm">
                                        <span class="span-btn">
                                             <i class="fas fa-money-bill"></i>
                                            <b>   {!! \App\Helpers\Helper::price($bill->total_price) !!}</b>
                                        </span>
                                </button>
                            </td>
                            <td class="text-center">
                                {!! \App\Helpers\Helper::statusBill($bill->status) !!}
                            </td>
                            <td class="text-center">
                                {!! \App\Helpers\Helper::convertPayType($bill->pay_type) !!}
                            </td>
                            <td>
                                @if($bill->status == '1')
                                    <a href="{{'/bills/history/confirm/'.$bill->bill_code}}" class="btn btn-block btn-success btn-sm">Xác nhận thanh toán</a>
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
