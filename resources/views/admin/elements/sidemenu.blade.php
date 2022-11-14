<!-- Sidemenu -->
<div class="sticky">
    <div class="main-menu main-sidebar main-sidebar-sticky side-menu">
        <div class="main-sidebar-header main-container-1 active">
            <div class="sidemenu-logo">
                <a class="main-logo d-flex justify-content-center align-items-center text-uppercase text-light"
                    href="#">
                    {{ env('APP_NAME') }}
                </a>
            </div>
            <div class="main-sidebar-body main-body-1">
                <div class="slide-left disabled" id="slide-left"><i class="fe fe-chevron-left"></i></div>
                <ul class="menu-nav nav">
                    <li class="nav-item {{ request()->is('admin.dashboard') ? 'active' : false }}">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-home sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('admin.clients.*') ? 'active' : false }}">
                        <a class="nav-link" href="{{ route('admin.clients.index') }}">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-write sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">Clientes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.logout') }}">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-power-off sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">Sair</span>
                        </a>
                    </li>
                </ul>
                <div class="slide-right" id="slide-right"><i class="fe fe-chevron-right"></i></div>
            </div>
        </div>
    </div>
</div>
<!-- End Sidemenu -->
