@extends('user.main')

@section('content')
    <div class="col-12">

        <br/>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="common-datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Mã giao dịch</th>
                        <th>Thời gian</th>
                        <th>Hết hạn</th>
                        <th>Mã tài khoản</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                        <th style="width:10%">Trạng thái</th>
                        <th style="width:10%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

@endsection
@section('lib')
    {{--datatable--}}
    <script src="/template/user/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/template/user/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/template/user/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/template/user/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/template/user/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/template/user/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

    <script src="/template/user/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/template/user/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/template/user/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="/template/admin/js/common.js"></script>

    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#common-datatable').DataTable({
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                processing: true,
                serverSide: true,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                aaSorting: [[1, 'desc']],
                "info": true,
                "autoWidth": false,
                "responsive": true,
                ajax: "{{url('/admin/bill-ajax')}}",
                columns: [
                    {"data": "bill_code"},
                    {"data": "bill_date"},
                    {"data": "expire_date"},
                    {"data": "id_game"},
                    {"data": "quantity"},
                    {
                        "data": "price", "render": function (data) {
                            return toMoney(+data)
                        }
                    },
                    {
                        "data": "total_price", "render": function (data) {
                            return toMoney(+data)
                        }
                    },
                    {
                        "data": "status", render: function (data) {
                            return statusBill(data);
                        }
                    },
                    {
                        data: function (data) {
                            return canHandleBill(data.status, data.id)
                        }
                    }
                ],
                language: {
                    url: "/template/language-datatable.json"
                },
            }).buttons().container().appendTo('#common-datatable_wrapper .col-md-6:eq(0)');

            setInterval(function () {
                let oTable = $('#common-datatable').dataTable()
                oTable.fnDraw(false);
            }, 300000);

        });
        $(document).on('click', '.btn-bill-status', function () {
            let billId = $(this).attr('data-id')
            let status = $(this).attr('data-status')
            let data = JSON.stringify({
                "status": status
            });
            $.ajax({
                type: "put",
                url: "/api/admin/bill/" + billId,
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
                            let oTable = $('#common-datatable').dataTable()
                            oTable.fnDraw(false);
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
    </script>
@endsection
