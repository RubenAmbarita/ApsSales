<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ (request()->is('admin')) ? 'active' : '' }}">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            @if(Auth::user()->roles == "ADMIN" || Auth::user()->roles == "SALES")
                <li class="nav-item {{ (request()->is('admin/proses*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{route('proses.index')}}">
                    <i class="fas fa-fw fa-recycle"></i>
                    <span>Booking Unit</span></a>
                </li>
            @endif
            
            @if(Auth::user()->roles == "ADMIN" || Auth::user()->roles == "MANAGER")
            <li class="nav-item {{ (request()->is('admin/approve*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{route('approve.index')}}">
                    <i class="fas fa-fw fa-rss"></i>
                    <span>Approve Unit</span></a>
            </li>
            @endif
            <hr class="sidebar-divider">

            @if(Auth::user()->roles == "ADMIN")
            <li class="nav-item ml-3"><span style="color:#FFFFFF; font-size: 16px">Master Data</span></li>
            <li class="nav-item {{ (request()->is('admin/tower*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{route('tower.index')}}">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Tower</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/stock*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{route('stock.index')}}">
                    <i class="fas fa-fw fa-bars"></i>
                    <span>Stock Unit</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/user*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{route('user.index')}}">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>User</span></a>
            </li>
            @endif
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->