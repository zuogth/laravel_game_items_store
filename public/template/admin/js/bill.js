var table = $(function () {
    $('#common-datatable').DataTable({
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        aaSorting: [[1, 'desc']],
        "info": true,
        "autoWidth": false,
        "responsive": true,
        language: {
            url: "/template/language-datatable.json"
        }
    }).buttons().container().appendTo('#common-datatable_wrapper .col-md-6:eq(0)');
});


$.ajax({
    type: "get",
    url: "/api/bill",
    contentType: "application/json",
    dataType: 'Json',
    success: function (result) {
        console.log(result)
    },
    error: function (result) {
        console.log(result)
    }
})

$(document).on('click', '.btn-bill-status', function () {
    let billId = $(this).attr('data-id')
    let status = $(this).attr('data-status')
    let data = JSON.stringify({
        "status": status
    });
    $.ajax({
        type: "put",
        url: "/api/bill/" + billId,
        contentType: "application/json",
        dataType: 'Json',
        data: data,
        success: function (result) {
            Swal.fire(
                result.MESSAGES,
                '',
                'success'
            ).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/admin/bill";
                }
            })
        },
        error: function (error) {
            error = error.responseJSON;
            Swal.fire(
                error.MESSAGES,
                '',
                'error'
            ).then((result) => {
            })
        }

    })
})

setInterval(function () {
    console.log("Test")
    table.ajax.reload();
}, 60000);
