     <!-- Sidebar -->
     <ul class="navbar-nav bg-gradient-white sidebar sidebar-primary accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
            <div class="sidebar-brand-icon block">
                <img src="{{ asset('assets/images/logo-banten2.png') }}" alt="" class="w-75">
            </div>
            <div class="sidebar-brand-text  mx-2">SiBanten <sup>App</sup></div>
        </a>

        <!-- Divider -->
        <hr class="dropdown-divider mx-3">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Request::is('dashboard') ? 'active':'' }}">
            <a class="nav-link" href="/dashboard">
                <i class="fa-solid fa-chart-line"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="dropdown-divider mx-3">

        <!-- Heading -->
        <div class="sidebar-heading">
            Fitur
        </div>

        <li class="nav-item {{ Request::is('dashboard/pencarian') ? 'active':'' }}">
            <a class="nav-link " href="/dashboard/pencarian">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span>Pencarian</span></a>
        </li>
        <li class="nav-item {{ Request::is('dashboard/penjelajahan') ? 'active':'' }}">
            <a class="nav-link" href="/dashboard/penjelajahan">
                <i class="fa-solid fa-earth-asia"></i>
                <span>Penjelajahan</span></a>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->

        <!-- Divider -->
        <hr class="dropdown-divider mx-3 d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle text-primary border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
