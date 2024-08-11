<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="https://telegra.ph/file/ee9ab3f53847aab318bf0.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Politeknik Jambi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('AdminLTE/dist/img/profile.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <!-- Display the name of the logged-in user -->
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Penelitian Section -->
                <li
                    class="nav-item has-treeview {{ Request::is('proposals*') || Request::is('pengabdian*') || Request::is('penelitian*') || Request::is('laporan_kemajuans*') || Request::is('laporan_akhirs*') || Request::is('logbooks*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-flask"></i>
                        <p>
                            Penelitian & Pengabdian
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('proposals.index') }}"
                                class="nav-link {{ Route::is('*proposals.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Proposal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan_kemajuans.index') }}"
                                class="nav-link {{ Route::is('*laporan_kemajuans.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Kemajuan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan_akhirs.index') }}"
                                class="nav-link {{ Route::is('*laporan_akhirs.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Akhir</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logbooks.index') }}"
                                class="nav-link {{ Route::is('logbooks.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Logbook</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if (Auth::user()->role == 'admin')
                    <!-- Dosen Section -->
                    <li class="nav-item">
                        <a href="{{ route('dosens.index') }}"
                            class="nav-link {{ Route::is('dosens.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Dosen</p>
                        </a>
                    </li>

                    <!-- Users Section -->
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                            class="nav-link {{ Route::is('users.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Users</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('templates.index') }}"
                        class="nav-link {{ Route::is('templates.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>List Template</p>
                    </a>
                </li>

                <!-- Logout Section -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
