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
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                        <th style="width:10%">Trạng thái</th>
                        <th style="width:10%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bills as $bill)
                        <tr>
                            <td>{{$bill->bill_code}}</td>
                            <td>{{$bill->bill_date}}</td>
                            <td>{{$bill->expire_date}}</td>
                            <td>{{$bill->quantity}}</td>
                            <td>{!! \App\Helpers\Helper::price($bill->price) !!}</td>
                            <td>{!! \App\Helpers\Helper::price($bill->total_price) !!}</td>
                            <td>{!! \App\Helpers\Helper::statusBill($bill->status) !!}</td>
                            <td>{!! \App\Helpers\Helper::canHandleBill($bill->status,$bill->id) !!}</td>
                        </tr>
                    @endforeach
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
    <script src="/template/admin/js/bill.js"></script>
@endsection
