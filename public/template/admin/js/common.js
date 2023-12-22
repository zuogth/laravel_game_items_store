function statusBill(status) {
    if (status == 1) {
        return '<button name="status" class="btn btn-block btn-warning btn-sm">Đang thanh toán</button>';
    } else if (status == 2) {
        return '<button name="status" class="btn btn-block btn-info btn-sm">Xác minh</button>';
    } else if (status == 3) {
        return '<button name="status" class="btn btn-block btn-success btn-sm">Thành công</button>';
    } else if (status == -2) {
        return '<button name="status" class="btn btn-block btn-secondary btn-sm">Giao dịch hết hạn</button>';
    } else
        return '<button name="status" class="btn btn-block btn-danger btn-sm">Thất bại</button>';
}


function canHandleBill(status, id) {
    if (status == 1) {
        return '<button name="status" class="btn btn-block btn-warning btn-sm">Đang thanh toán</button>';
    } else if (status == 2) {
        return `<div><button name='status' class='btn btn-block btn-success btn-sm btn-bill-status' data-id='${id}' data-status='3'>Thành công</button>
        <button name='status' class='btn btn-block btn-danger btn-sm btn-bill-status' data-id='${id}' data-status='-1'>Thất bại</button></div>`;
    }
    return "";
}


function convertPayType(payType) {
    if (payType == 1) {
        return '<button name="status" class="btn btn-block btn-primary btn-sm">Ngân hàng</button>';
    } else if (payType == 2) {
        return '<button name="status" class="btn btn-block btn-info btn-sm">Thẻ siêu rẻ</button>';
    }
    return "";
}
