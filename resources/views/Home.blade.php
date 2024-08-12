<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <title>AdminLTE 3 | Starter</title>
    @include('Template.head')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('Template.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('Template.left-sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $total_proposal }}</h3>
                                    <p>Proposal</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <a href="{{ route('proposals.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $total_laporan_kemajuan }}</h3>
                                    <p>Laporan Kemajuan</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <a href="{{ route('laporan_kemajuans.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $total_laporan_akhir }}</h3>
                                    <p>Laporan Akhir</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <a href="{{ route('laporan_akhirs.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $total_logbook }}</h3>
                                    <p>Logbook</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                <a href="{{ route('logbooks.index') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Proposal Terbaru</h3>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach ($latest_proposal as $proposal)
                                            <li class="list-group-item">
                                                @if (auth()->user()->role == 'admin')
                                                    <div class="btn btn-sm btn-dark">{{ $proposal->user->name }}</div>
                                                    |
                                                @endif
                                                {{ $proposal->judul }}
                                                <span class="float-right">
                                                    {{ $proposal->created_at ? $proposal->created_at->format('d/m/Y') : 'Tanggal tidak tersedia' }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Laporan Akhir Terbaru</h3>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach ($latest_laporan_akhir as $laporanAkhir)
                                            <li class="list-group-item">
                                                @if (auth()->user()->role == 'admin')
                                                    <div class="btn btn-sm btn-dark">{{ $laporanAkhir->user->name }}
                                                    </div>
                                                    |
                                                @endif
                                                {{ $laporanAkhir->laporanKemajuan->proposal->judul }}
                                                <span class="float-right">
                                                    {{ $laporanAkhir->created_at ? $laporanAkhir->created_at->format('d/m/Y') : 'Tanggal tidak tersedia' }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content-header -->

            <!-- Main content -->

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('Template.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    @include('Template.script')
</body>

</html>
