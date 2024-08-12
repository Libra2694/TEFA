<!DOCTYPE html>
<html lang="en">
<head>
    @include('Template.head')
    <title>AdminLTE 3 | Show Proposal</title>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('Template.navbar')
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('home') }}" class="brand-link">
    <img src="AdminLTE/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
        <!-- Penelitian Menu -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Penelitian
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('proposals.index') }}" class="nav-link">
                <i class="fas fa-file nav-icon"></i>
                <p>Proposal</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('laporan_kemajuans.index') }}" class="nav-link">
                <i class="fas fa-chart-line nav-icon"></i>
                <p>Laporan Kemajuan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('laporan_akhirs.index') }}" class="nav-link">
                <i class="fas fa-check-circle nav-icon"></i>
                <p>Laporan Akhir</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('logbooks.index') }}" class="nav-link">
                <i class="fas fa-book nav-icon"></i>
                <p>Logbook</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Pengabdian Menu -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-graduation-cap"></i>
            <p>
              Pengabdian
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('proposals.index') }}" class="nav-link">
                <i class="fas fa-file nav-icon"></i>
                <p>Proposal</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('laporan_kemajuans.index') }}" class="nav-link">
                <i class="fas fa-chart-line nav-icon"></i>
                <p>Laporan Kemajuan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('laporan_akhirs.index') }}" class="nav-link">
                <i class="fas fa-check-circle nav-icon"></i>
                <p>Laporan Akhir</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('logbooks.index') }}" class="nav-link">
                <i class="fas fa-book nav-icon"></i>
                <p>Logbook</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Data User Menu -->
        <li class="nav-item">
          <a href="{{ route('users.index') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Data User</p>
          </a>
        </li>

        <!-- Data Dosen Menu -->
        <li class="nav-item">
          <a href="{{ route('dosens.index') }}" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>Data Dosen</p>
          </a>
        </li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="nav-ic" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </button>
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>


  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Detail Proposal</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Judul</th>
                        <td>{{ $proposal->judul }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Upload</th>
                        <td>{{ $proposal->tanggal_upload }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Proposal</th>
                        <td>{{ $proposal->jenis_proposal }}</td>
                    </tr>
                    <tr>
                        <th>Jenis</th>
                        <td>{{ $proposal->jenis }}</td>
                    </tr>
                    <tr>
                        <th>File</th>
                        <td><a href="{{ asset('storage/'.$proposal->file) }}" target="_blank">Lihat File</a></td>
                    </tr>
                </table>
                <a href="{{ route('proposals.edit', $proposal->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('proposals.index') }}" class="btn btn-secondary">Kembali</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  @include('Template.footer')

</div>

@include('Template.script')
</body>
</html>
