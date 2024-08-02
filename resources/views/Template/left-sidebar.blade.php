<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="https://telegra.ph/file/ee9ab3f53847aab318bf0.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Politeknik Jambi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="AdminLTE/dist/img/profile.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <!-- Display the name of the logged-in user -->
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Penelitian Section -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-flask"></i>
                        <p>
                            Penelitian
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('penelitian.proposals.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Proposals</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('penelitian.laporan_kemajuans.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Kemajuans</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('penelitian.laporan_akhirs.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Akhirs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logbooks.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Logbooks</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Pengabdian Section -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hand-holding-heart"></i>
                        <p>
                            Pengabdian
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pengabdian.proposals.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Proposals</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pengabdian.laporan_kemajuans.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Kemajuans</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pengabdian.laporan_akhirs.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Akhirs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logbooks.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Logbooks</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if(Auth::user()->role == 'admin')
                    <!-- Dosen Section -->
                    <li class="nav-item">
                        <a href="{{ route('dosens.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Dosens</p>
                        </a>
                    </li>

                    <!-- Users Section -->
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Users</p>
                        </a>
                    </li>
                @endif

                <!-- Logout Section -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
