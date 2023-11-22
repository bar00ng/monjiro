<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="/assets/dist/img/monjiro.png" alt="AdminLTE Logo" class="brand-image " style="height:25px">
        <br>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/assets/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-gauge-high"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.product.index')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-box"></i>
                        <p>
                            Barang
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="log-out ml-3" href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-power-off" style="color: red;"></i>
                        Logout
                        <form action="{{ route('logout') }}" method="POST" id="logging-out">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
