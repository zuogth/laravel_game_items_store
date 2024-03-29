@extends('user.main')
@section('head')
    <link rel="stylesheet" href="/template/user/dist/css/payment.css">
@endsection
@section('content')
    <div class="alert-noti alert alert-custom">
        <i class="fas fa-times close-alert"></i>
        <span></span>
    </div>
    <div class="main" style="width:100%">
        <div class="container model-pay">
            <div class="row">
                <div class="col-sm-4">
                    <ul class="nav nav-pills nav-sidebar flex-column">
                        <li class="nav-item">
                            <div class="info-pay">
                                <i class="nav-icon fas fa-university"></i>
                                <div>
                                    <p>
                                        Ngân hàng
                                    </p>
                                    <p>{{$bankName}}</p>
                                </div>

                            </div>

                        </li>
                        <li class="nav-item">
                            <div class="info-pay">
                                <i class="nav-icon fas fa-money-check"></i>
                                <div>
                                    <p>
                                        Số tài khoản
                                    </p>
                                    <div class="copy-text">
                                        <p id="accountNo">{{$accountNo}}</p><i class="nav-icon far fa-copy"
                                                                               onclick="selectText('accountNo')"></i>
                                    </div>

                                </div>
                            </div>

                        </li>
                        <li class="nav-item">
                            <div class="info-pay">
                                <i class="nav-icon fas fa-user"></i>
                                <div>
                                    <p>
                                        Chủ tài khoản
                                    </p>
                                    <p>{{$accountName}}</p>
                                </div>
                            </div>

                        </li>
                        <li class="nav-item">
                            <div class="info-pay">
                                <i class="nav-icon fas fa-money-bill"></i>
                                <div>
                                    <p>
                                        Số tiền cần thanh toán
                                    </p>
                                    <p>{{\App\Helpers\Helper::price($amount)}}</p>
                                </div>
                            </div>

                        </li>
                        <li class="nav-item">
                            <div class="info-pay">
                                <i class="nav-icon fas fa-comment"></i>
                                <div>
                                    <p>
                                        Nội dung chuyển khoản
                                    </p>
                                    <div class="copy-text">
                                        <p id="content-transfer">{{$content}}</p><i class="nav-icon far fa-copy"
                                                                                    onclick="selectText('content-transfer')"></i>
                                    </div>

                                </div>
                            </div>

                        </li>
                        <li class="nav-item">
                            <div class="info-pay">
                                <i class="nav-icon fas fa-spinner"></i>
                                <div>
                                    <p>
                                        Trạng thái
                                    </p>
                                    <p>Chờ thanh toán</p>
                                </div>
                            </div>

                        </li>
                    </ul>
                </div>
                <div class="col-sm-8 info-pay-qr">
                    <h3>Thông tin thanh toán</h3>
                    <p><span style="color: red">NOTE:</span> Vui lòng thực hiện giao dịch trong 5 phút kể từ khi hóa đơn
                        được tạo, sau 5 phút hệ thống sẽ tự hủy giao dịch.</p>
                    <p id="countdown" style="color: red">Countdown</p>
                    <p>Thực hiện chuyển tiền vào tài khoản ngân hàng theo thông tin bên hoặc quét mã QR để thanh
                        toán</p>
                    <p>Hệ thống sẽ xử lý giao dịch khi thực hiện chuyển tiền thành công</p>
                    @if($qr->code == '00')
                        <img src="{{ $qr->data->qrDataURL }}" alt="" width=300 height=300>
                    @else
                        <img src="" alt="QR không sẵn sàng, hãy chuyển tiền theo thông tin bên" width=300 height=300>
                    @endif
                    <div class="l-list-button-page">
                        <div class="l-button-confirm-pay">
                            <a href="{{'/payment/confirm/'.$bill_code}}" type="button" id="confirm-pay"
                               class="btn btn-sm btn-primary">Xác nhận thanh toán</a>
                        </div>
                        <div>
                        </div>
                    </div>

                </div>
            </div>
            <input type="text" id="expire_date" value="{{$expireDate}}" hidden>

@endsection
@section('lib')
                <script src="/template/user/js/bill.js"></script>
@endsection
