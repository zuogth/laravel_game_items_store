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
                                <p>SHB</p>
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
                                    <p id="accountNo">8803042000</p><i class="nav-icon far fa-copy" onclick="selectText('accountNo')"></i>
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
                                <p>DUONG TUAN HIEU</p>
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
                                 <p>10000</p>
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
                                    <p id="content-transfer">test</p><i class="nav-icon far fa-copy" onclick="selectText('content-transfer')"></i>
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
                <p><span style="color: red">NOTE:</span> Vui lòng thực hiện giao dịch trong 5 phút kể từ khi hóa đơn được tạo, sau 5 phút hệ thống sẽ tự hủy giao dịch.</p>
                <p id="countdown" style="color: red">Countdown</p>
                <p>Thực hiện chuyển tiền vào tài khoản ngân hàng theo thông tin bên hoặc quét mã QR để thanh toán</p>
                <p>Số tiền chuyển là</p>
                <p>Nội dung chuyển tiền</p>
                <p>Hệ thống sẽ xử lý giao dịch khi thực hiện chuyển tiền thành công</p>
                @if($qr->code != 'ERROR')
                    <img src="{{ $qr->data->qrDataURL }}" alt="" width=300 height=300>
                @else
                    <img src="" alt="QR không sẵn sàng, hãy chuyển tiền theo thông tin bên" width=300 height=300>
                @endif
                
            </div>
        </div>
        
    </div>
</div>

<script>
    // Set the target date and time (change as needed)
    // Get the current date and time
    var currentDate = new Date();

    // Add 5 minutes (5 * 60 * 1000 milliseconds) to the current date
    var targetDate = new Date(currentDate.getTime() + 5 * 60 * 1000);

    // Update the countdown every second
    var countdownInterval = setInterval(updateCountdown, 1000);

    // Function to update the countdown
    function updateCountdown() {
        var now = new Date().getTime();
        var timeDifference = targetDate - now;

        if (timeDifference > 0) {
            // Calculate days, hours, minutes, and seconds
            var days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            // Display the countdown
            document.getElementById('countdown').innerHTML = minutes + 'm ' + seconds + 's';
        } else {
            // Display a message when the countdown reaches zero
            document.getElementById('countdown').innerHTML = 'Hết hạn thanh toán';
            clearInterval(countdownInterval); // Stop the countdown
        }
    }
</script>

<script>
    // Hàm để chọn và sao chép nội dung của phần tử
    function selectText(id) {
        var range, selection;

        let element = document.getElementById(id);

        if (document.body.createTextRange) { // For IE
            range = document.body.createTextRange();
            range.moveToElementText(element);
            range.select();
        } else if (window.getSelection) { // For other browsers
            selection = window.getSelection();
            range = document.createRange();
            range.selectNodeContents(element);
            selection.removeAllRanges();
            selection.addRange(range);
        }

        // Sao chép nội dung đã chọn vào clipboard
        document.execCommand('copy');
        
        $('.alert-custom span').html('Sao chép thành công');
        $('.alert-custom').show();
        setTimeout(function(){
            $('.alert-custom').hide();
        }, 5000);
    }
</script>
@endsection
