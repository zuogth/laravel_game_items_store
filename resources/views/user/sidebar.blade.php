<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/user" class="brand-link">
        <img src="/template/user/dist/img/AdminLTELogo.png" alt="userLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Lại anh minh</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            {{--            <div class="image">--}}
            {{--                <img src="/template/user/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">--}}
            {{--            </div>--}}
            {{--            @if (\Illuminate\Support\Facades\Auth::user())--}}
            {{--                <div class="info">--}}
            {{--                    <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->full_name}}</a>--}}
            {{--                </div>--}}
            {{--                <div class="info">--}}
            {{--                    <a href="/logout" class="d-block" style="text-decoration: underline"><i--}}
            {{--                            class="fas fa-sign-out-alt"></i></a>--}}
            {{--                </div>--}}
            {{--            @else--}}
            {{--                <div class="info">--}}
            {{--                    <a href="/login" class="d-block">Đăng nhập</a>--}}
            {{--                </div>--}}
            {{--            @endif--}}
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Category -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Trang chủ
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/category/DIAMOND" class="nav-link">
                        <i class="nav-icon far fa-gem"></i>
                        <p>
                            Kim cương
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/category/CARD" class="nav-link">
                        <i class="nav-icon far fa-credit-card"></i>
                        <p>
                            Thẻ game
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/category/USERCARD" class="nav-link">
                        <i class="nav-icon fas fa-id-card"></i>
                        <p>
                            Tài khoản game
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/information" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Quản trị viên
                        </p>
                    </a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->role == 'QL')
                    <li class="nav-item">
                        <a href="/admin/bill" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Quản lý đơn hàng
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
