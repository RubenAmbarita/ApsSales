<!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information (Refined Compact Corporate Chip) -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle user-chip" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="user-chip__avatar" aria-hidden="true">
                                    <i class="fas fa-user"></i>
                                </span>
                                <span class="user-chip__name d-none d-md-inline">{{ Auth::user()->name }}</span>
                                <span class="user-chip__role-badge d-none d-lg-inline">{{ strtoupper(Auth::user()->roles) }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item logout-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-power-off fa-sm fa-fw"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
