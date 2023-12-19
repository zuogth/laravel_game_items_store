<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/user" class="brand-link">
      <img src="/template/user/dist/img/AdminLTELogo.png" alt="userLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminH3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/template/user/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        @if (\Illuminate\Support\Facades\Auth::user())
        <div class="info">
            <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->full_name}}</a>
          </div>
            <div class="info">
                <a href="/logout" class="d-block" style="text-decoration: underline"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        @else
        <div class="info">
            <a href="/login" class="d-block">Đăng nhập</a>
          </div>
        @endif
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
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="/user/user/list" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Tài khoản
                    </p>
                </a>
            </li>
            <li class="nav-item">
            <a href="/user/category/list" class="nav-link">
                <i class="nav-icon fas fa-bars"></i>
              <p>
                Thể loại
              </p>
            </a>
          </li>
            <li class="nav-item">
                <a href="/user/speciality/list" class="nav-link">
                    <i class="fab fa-product-hunt nav-icon"></i>
                    <p>
                        Đặc tính
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/user/product/list" class="nav-link">
                    <i class="nav-icon fas fa-store"></i>
                    <p>
                        Sản phẩm
                    </p>
                    <i class="right fas fa-angle-left"></i>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/user/product/list/ti-vi" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ti vi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/user/product/list/tu-lanh" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tủ lạnh</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/user/product/list/dieu-hoa" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Điều hòa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/user/product/list/may-giat" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Máy giặt</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="/user/comment/list" class="nav-link">
                    <i class="fas fa-comment nav-icon"></i>
                    <p>
                        Đánh giá
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/user/bill/list" class="nav-link">
                    <i class="fas fa-money-bill nav-icon"></i>
                    <p>
                        Hóa đơn bán
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/user/receipt/list" class="nav-link">
                    <i class="fas fa-receipt nav-icon"></i>
                    <p>
                        Hóa đơn nhập
                    </p>
                </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-category -->
    </div>
    <!-- /.sidebar -->
  </aside>