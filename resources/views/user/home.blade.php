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
                                    <td class="name-product">{!! $product->name !!}</td>
                                    <td class="text-center">
                                        <button class="btn btn-block btn-outline-success btn-sm">
                                            <span class="span-btn">Còn lại:<b> {{$product->status != 2 ? $product->total_quantity : 0}}</b></span>
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
                                        @if($product->total_quantity > 0 && $product->status != 2)
                                            <a href="/products/{{$product->code}}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-cart-arrow-down"></i>
                                                MUA NGAY
                                            </a>
                                        @else
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
            @endforeach
        </div>
    </div>


    <div class="col-md-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
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
                        <thead style="background:#12214E;color:white;top: 0" class="position-sticky">
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


    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="color: red"><i class="fas fa-bullhorn"></i>
                        <span>Chào mừng bạn đến với SHOP của LAIANHMINH</span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>Tặng thêm 1 ngày cho tất cả các gói thuê UGPHONE</div>
                </div>
                <div class="modal-footer">
                    <div>
                        <div><span class="info-admin-modal">Cảm ơn quý khách hàng đã tin tưởng!</span></div>
                        <div>Số điện thoại: <span class="info-admin-modal">0975817230</span></div>
                        <div>Chủ tài khoản: <span class="info-admin-modal">LAI ANH MINH</span></div>
                        <div>Ngân hàng: <span class="info-admin-modal">MB - Ngân hàng TMCP Quân đội - 4401082000</span>
                        </div>
                        <div>Thẻ siêu rẻ: <span class="info-admin-modal">0888222093</span></div>
                        <div>Thời gian hoạt động: <span class="info-admin-modal">12h00-24h00</span></div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
