<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="/template/user/dist/img/AdminLTELogo.png" alt="userLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">
                Lại Anh Minh
            </span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-2 mb-3">

            @if(\Illuminate\Support\Facades\Auth::user())
                <h5 class="sidebar-user mt-3">
                    Xin
                    Chào, {{\Illuminate\Support\Facades\Auth::user()->full_name ? \Illuminate\Support\Facades\Auth::user()->full_name : 'Chưa đăng nhập'}}</h5>
            @else
                <div class="d-flex justify-content-around">
                    <a href="/login" class="brand-link">
                        <span class="brand-text font-weight-light">Đăng nhâp</span>
                    </a>
                    <a href="/register" class="brand-link">
                        <span class="brand-text font-weight-light">Đăng ký</span>
                    </a>
                </div>
            @endif

        </div>
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Tìm kiếm"
                       aria-label="Search">
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
                    <a href="/category/UGPHONE" class="nav-link">
                        <i class="nav-icon far fa-gem"></i>
                        <p>
                            Ugphone
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
                @if(\Illuminate\Support\Facades\Auth::user())
                    @if (\Illuminate\Support\Facades\Auth::user()->role == 'QL')
                        <li class="nav-item">
                            <a href="/admin/bill" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Quản lý đơn hàng
                                </p>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="/history" class="nav-link">
                                <i class="nav-icon fas fa-history"></i>
                                <p>
                                    Lịch sử mua hàng
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/change-password" class="nav-link">
                                <i class="nav-icon fas fa-key"></i>
                                <p>
                                    Đổi mật khẩu
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/logout" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Đăng xuất
                                </p>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
