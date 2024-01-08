$(document).on("click", ".custom-control-input", function () {
    let productCode = $(this).attr('id');
    let status = +$(this).val() == 1 ? 2 : 1

    callApiUpdateStatus(productCode, status)
});


function callApiUpdateStatus(productCode, status) {
    let data = JSON.stringify({
        "status": status
    });
    $.ajax({
        type: "put",
        url: "/api/admin/product/status",
        contentType: "application/json",
        dataType: 'Json',
        data: data,
        success: function (result) {
            Swal.fire(
                result.MESSAGES,
                '',
                'success'
            ).then((result) => {
                location.reload();

            })
        },
        error: function (error) {
            error = error.responseJSON;
            Swal.fire(
                error.MESSAGES,
                '',
                'error'
            ).then((result) => {
                location.reload();
            })
        }

    })
}
