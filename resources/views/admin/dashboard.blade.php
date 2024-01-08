@extends('user.main')

@section('content')
    <div class="col-12">
        <br/>
        <div class="card card-primary">
            <div class="card-header">
                <div>
                    <h3 class="card-title">{{$title}}</h3>
                </div>
            </div>
            <div class="card-body">
                <section class="content">
                    <div class="container-fluid">
                        <!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{$productInfo->total}}</h3>

                                        <p>Sản phẩm</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>

                                    @if($productInfo->active > 0)
                                        <div class="custom-control custom-switch small-box-footer hover">
                                            <input type="checkbox" class="custom-control-input" id="control-active"
                                                   value="2">
                                            <label class="custom-control-label" for="control-active">Tắt hoạt
                                                động</label>
                                        </div>
                                    @else
                                        <div class="custom-control custom-switch small-box-footer hover">
                                            <input type="checkbox" class="custom-control-input" id="control-active"
                                                   value="1" checked>
                                            <label class="custom-control-label" for="control-active">Đang hoạt
                                                động</label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        @endsection
        @section('lib')
            <script src="/template/admin/js/dashboard.js"></script>
@endsection
