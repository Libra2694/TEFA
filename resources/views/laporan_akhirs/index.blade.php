<!DOCTYPE html>
<html lang="en">

<head>
    @include('Template.head')
    <title>AdminLTE 3 | Laporan Akhir</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('Template.navbar')
        @include('Template.left-sidebar')

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="btn-group justify-content-center col-md-12 mt-4">
                            <a href="{{ route('laporan_akhirs.index') }}"
                                class="btn {!! Route::is('laporan_akhirs.index') ? 'btn-primary' : 'btn-secondary' !!} col-md-5">Semua</a>
                            <a href="{{ route('penelitian.laporan_akhirs.index') }}"
                                class="btn {!! Route::is('penelitian.laporan_akhirs.index') ? 'btn-primary' : 'btn-secondary' !!} col-md-5">Penelitian</a>
                            <a href="{{ route('pengabdian.laporan_akhirs.index') }}"
                                class="btn {!! Route::is('pengabdian.laporan_akhirs.index') ? 'btn-primary' : 'btn-secondary' !!} col-md-5">Pengabdian</a>
                        </div>
                        <div class="col-12">
                            <div class="card mt-4">
                                <div class="card-header">
                                    @if (Route::is('penelitian.laporan_akhirs.index'))
                                        Daftar Laporan Akhir Jenis Penelitian
                                    @elseif (Route::is('pengabdian.laporan_akhirs.index'))
                                        Daftar Laporan Akhir Jenis Pengabdian
                                    @else
                                        Daftar Semua Laporan Akhir
                                    @endif
                                </div>
                                <div class="card-body">
                                    @if (auth()->user()->role == 'user' && !Route::is('laporan_akhirs.index'))
                                        <button class="btn btn-primary mb-3" data-toggle="modal"
                                            data-target="#createLaporanAkhirModal">Tambah Laporan Akhir</button>
                                    @endif
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                @if (auth()->user()->role == 'admin')
                                                    <th>Nama Dosen</th>
                                                @endif
                                                <th>Judul Proposal Terkait</th>
                                                <th>Tanggal Upload</th>
                                                <th>Jenis Laporan Akhir</th>
                                                <th>Jenis</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($laporanAkhirs as $laporanAkhir)
                                                <tr>
                                                    @if (auth()->user()->role == 'admin')
                                                        <td>{{ $laporanAkhir->user->name }}</td>
                                                    @endif
                                                    <td>{{ $laporanAkhir->laporanKemajuan->proposal->judul }}</td>
                                                    <td>{{ $laporanAkhir->created_at }}</td>
                                                    <td>{{ $laporanAkhir->laporanKemajuan->proposal->jenis_proposal }}
                                                    </td>
                                                    <td>{{ $laporanAkhir->laporanKemajuan->proposal->jenis }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info" data-toggle="modal"
                                                            data-target="#viewLaporanAkhirModal-{{ $laporanAkhir->id }}">Lihat</button>
                                                        <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                            data-target="#editLaporanAkhirModal-{{ $laporanAkhir->id }}">Edit</button>
                                                        <form
                                                            action="{{ route('laporan_akhirs.destroy', $laporanAkhir->id) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Create Laporan Akhir Modal -->
    <div class="modal fade" id="createLaporanAkhirModal" tabindex="-1" role="dialog"
        aria-labelledby="createLaporanAkhirModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLaporanAkhirModalLabel">Tambah Laporan Akhir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('laporan_akhirs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="laporan_kemajuan_id">Laporan Kemajuan Terkait</label>
                            <select name="laporan_kemajuan_id" id="laporan_kemajuan_id" class="form-control" required>
                                <option selected disabled>-- Pilih Laporan Kemajuan --</option>
                                @forelse ($laporanKemajuan as $lk)
                                    <option value="{{ $lk->id }}">{{ $lk->proposal->judul }} |
                                        {{ $lk->proposal->jenis_proposal }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" name="file" id="file" class="form-control-file" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View Laporan Akhir Modal -->
    @foreach ($laporanAkhirs as $laporanAkhir)
        <div class="modal fade" id="viewLaporanAkhirModal-{{ $laporanAkhir->id }}" tabindex="-1" role="dialog"
            aria-labelledby="viewLaporanAkhirModalLabel-{{ $laporanAkhir->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewLaporanAkhirModalLabel-{{ $laporanAkhir->id }}">Detail Laporan
                            Akhir</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Judul Proposal Terkait</th>
                                <td>{{ $laporanAkhir->laporanKemajuan->proposal->judul }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Upload</th>
                                <td>{{ $laporanAkhir->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Laporan Akhir</th>
                                <td>{{ $laporanAkhir->laporanKemajuan->proposal->jenis_proposal }}</td>
                            </tr>
                            <tr>
                                <th>Jenis</th>
                                <td>{{ $laporanAkhir->laporanKemajuan->proposal->jenis }}</td>
                            </tr>
                            <tr>
                                <th>File Laporan Akhir</th>
                                <td><a href="{{ asset('storage/' . $laporanAkhir->file) }}" target="_blank">Lihat
                                        File</a></td>
                            </tr>
                            <tr>
                                <th>File Laporan Kemajuan Terkait</th>
                                <td><a href="{{ asset('storage/' . $laporanAkhir->laporanKemajuan->file) }}"
                                        target="_blank">Lihat
                                        File</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Edit Laporan Akhir Modal -->
    @foreach ($laporanAkhirs as $laporanAkhir)
        <div class="modal fade" id="editLaporanAkhirModal-{{ $laporanAkhir->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editLaporanAkhirModalLabel-{{ $laporanAkhir->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLaporanAkhirModalLabel-{{ $laporanAkhir->id }}">Edit Laporan
                            Akhir</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('laporan_akhirs.update', $laporanAkhir->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="laporan_kemajuan_id">Laporan Kemajuan Terkait</label>
                                <select name="laporan_kemajuan_id" id="laporan_kemajuan_id" class="form-control"
                                    required>
                                    <option selected disabled>-- Pilih Laporan Kemajuan --</option>
                                    @forelse ($laporanKemajuan as $lk)
                                        <option value="{{ $lk->id }}"
                                            {{ $laporanAkhir->laporan_kemajuan_id == $lk->id ? 'selected' : '' }}>
                                            {{ $lk->proposal->judul }} |
                                            {{ $lk->proposal->jenis_proposal }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="file">File</label>
                                <input type="file" name="file" id="file" class="form-control-file"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</body>

</html>
