$(document).on("click", ".custom-control-input", function () {
    let productCode = $(this).attr('id');
    let status = $(this).val() == 1 ? 0 : 1


    callApiUpdateStatus(productCode, status, $(this).val(status))
    console.log($(this).val())
});


function callApiUpdateStatus(productCode, status, afterCallApiSuccess) {
    let data = JSON.stringify({
        "status": status
    });
    $.ajax({
        type: "put",
        url: "/api/admin/product/" + productCode,
        contentType: "application/json",
        dataType: 'Json',
        data: data,
        success: function (result) {
            Swal.fire(
                result.MESSAGES,
                '',
                'success'
            ).then((result) => {
                afterCallApiSuccess;

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
