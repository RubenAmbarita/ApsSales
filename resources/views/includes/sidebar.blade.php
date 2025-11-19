<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon d-flex align-items-center justify-content-center" style="transform: none;">
                    <img src="{{ asset('frontend/images/logo-djki.png') }}" alt="Logo DJKI" style="height: 36px; width: auto; display: block;">
                </div>
                <div class="sidebar-brand-text mx-2">SIMANTAP</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ (request()->is('admin')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            @if(Auth::user()->roles == "ADMIN")
            <li class="nav-item {{ (request()->is('admin/network*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.network.index') }}">
                    <i class="fas fa-network-wired"></i>
                    <span>Network</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/lisensi*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.lisensi.index') }}">
                    <i class="fas fa-key"></i>
                    <span>Lisensi</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/server*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.server.index') }}">
                    <i class="fas fa-server"></i>
                    <span>Server</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/riwayatperawatan*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.riwayatperawatan.index') }}">
                    <i class="fas fa-tools"></i>
                    <span>Riwayat Perawatan</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/sop*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.sop.index') }}">
                    <i class="fas fa-file-alt"></i>
                    <span>SOP</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/announcement*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.announcement.index') }}">
                    <i class="fas fa-bullhorn"></i>
                    <span>Pengumuman</span></a>
            </li>
            @endif
            @if(in_array(Auth::user()->roles, ["KATIMJA","STAFF"]))
            <li class="nav-item {{ (request()->is('admin/network*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.network.index') }}">
                    <i class="fas fa-network-wired"></i>
                    <span>Network</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/lisensi*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.lisensi.index') }}">
                    <i class="fas fa-key"></i>
                    <span>Lisensi</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/server*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.server.index') }}">
                    <i class="fas fa-server"></i>
                    <span>Server</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/riwayatperawatan*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.riwayatperawatan.index') }}">
                    <i class="fas fa-tools"></i>
                    <span>Riwayat Perawatan</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/sop*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.sop.index') }}">
                    <i class="fas fa-file-alt"></i>
                    <span>SOP</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/announcement*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.announcement.index') }}">
                    <i class="fas fa-bullhorn"></i>
                    <span>Pengumuman</span></a>
            </li>
            @endif
            {{--
            @if(Auth::user()->roles == "ADMIN" || Auth::user()->roles == "SALES")
                <li class="nav-item {{ (request()->is('admin/proses*')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.proses.index') }}">
                        <i class="fas fa-fw fa-recycle"></i>
                        <span>Booking Unit</span>
                    </a>
                </li>
            @endif

            @if(Auth::user()->roles == "ADMIN" || Auth::user()->roles == "MANAGER")
                <li class="nav-item {{ (request()->is('admin/approve*')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.approve.index') }}">
                        <i class="fas fa-fw fa-rss"></i>
                        <span>Approve Unit</span>
                    </a>
                </li>
            @endif
            --}}
            <hr class="sidebar-divider">

            @if(Auth::user()->roles == "ADMIN")
            <div class="sidebar-heading">Master Data</div>
            <li class="nav-item {{ (request()->is('admin/location*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.location.index') }}">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>Location</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/vendor*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.vendor.index') }}">
                    <i class="fas fa-handshake"></i>
                    <span>Vendor</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/departemen*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.departemen.index') }}">
                    <i class="fas fa-landmark"></i>
                    <span>Direktorat</span></a>
            </li>
            <li class="nav-item {{ (request()->is('admin/user*')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.user.index') }}">
                    <i class="fas fa-user-cog"></i>
                    <span>User</span></a>
            </li>
            @endif
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->