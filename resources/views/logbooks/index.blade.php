<!DOCTYPE html>
<html lang="en">

<head>
    @include('Template.head')
    <title>AdminLTE 3 | Logbook</title>
    <!-- Include Bootstrap CSS -->
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
                        <div class="col-12">
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h3 class="card-title">Daftar Logbook</h3>
                                </div>
                                <div class="card-body">
                                    @if (auth()->user()->role == 'user')
                                        <button class="btn btn-primary mb-3" data-toggle="modal"
                                            data-target="#createLogbookModal">Tambah Logbook</button>
                                    @endif
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                @if (auth()->user()->role == 'admin')
                                                    <th>Nama Dosen</th>
                                                @endif
                                                <th>Tanggal</th>
                                                <th>Kegiatan</th>
                                                <th>Laporan Akhir Terkait</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($logbooks as $logbook)
                                                <tr>
                                                    @if (auth()->user()->role == 'admin')
                                                        <td>{{ $logbook->laporanAkhir->user->name }}</td>
                                                    @endif
                                                    <td>{{ $logbook->tanggal }}</td>
                                                    <td>{{ Str::limit($logbook->kegiatan, 50) }}</td>
                                                    <td>{{ $logbook->laporanAkhir->laporanKemajuan->proposal->judul }}
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info" data-toggle="modal"
                                                            data-target="#viewLogbookModal-{{ $logbook->id }}">Lihat</button>
                                                        <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                            data-target="#editLogbookModal-{{ $logbook->id }}">Edit</button>
                                                        <form action="{{ route('logbooks.destroy', $logbook->id) }}"
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

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Create Logbook Modal -->
    <div class="modal fade" id="createLogbookModal" tabindex="-1" role="dialog"
        aria-labelledby="createLogbookModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLogbookModalLabel">Tambah Logbook</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('logbooks.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="kegiatan">Kegiatan</label>
                            <textarea name="kegiatan" id="kegiatan" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="laporan_akhir">Terkait Laporan Akhir</label>
                            <select name="laporan_akhirs_id" id="laporan_akhirs_id" class="form-control" required>
                                <option selected disabled>-- Pilih Laporan Akhir --</option>
                                @forelse ($laporan_akhir as $la)
                                    <option value="{{ $la->id }}">
                                        {{ $la->laporanKemajuan->proposal->judul }} |
                                        {{ $la->laporanKemajuan->proposal->jenis_proposal }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View Logbook Modal -->
    @foreach ($logbooks as $logbook)
        <div class="modal fade" id="viewLogbookModal-{{ $logbook->id }}" tabindex="-1" role="dialog"
            aria-labelledby="viewLogbookModalLabel-{{ $logbook->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewLogbookModalLabel-{{ $logbook->id }}">Detail Logbook</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ $logbook->tanggal }}</td>
                            </tr>
                            <tr>
                                <th>Kegiatan</th>
                                <td>{{ $logbook->kegiatan }}</td>
                            </tr>
                            <tr>
                                <th>Laporan Akhir Terkait</th>
                                <td>{{ $logbook->laporanAkhir->laporanKemajuan->proposal->judul }}</td>
                            </tr>
                            <tr>
                                <th>File Laporan Akhir Terkait</th>
                                <td><a href="{{ asset('storage/' . $logbook->laporanAkhir->file) }}" target="_blank"
                                        download>Lihat
                                        File</a></td>
                            </tr>
                            <tr>
                                <th>File Laporan Kemajuan Terkait</th>
                                <td><a href="{{ asset('storage/' . $logbook->laporanAkhir->laporanKemajuan->file) }}"
                                        target="_blank" download>Lihat
                                        File</a></td>
                            </tr>
                            <tr>
                                <th>File Proposal Terkait</th>
                                <td><a href="{{ asset('storage/' . $logbook->laporanAkhir->laporanKemajuan->proposal->file) }}"
                                        target="_blank" download>Lihat
                                        File</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Edit Logbook Modal -->
    @foreach ($logbooks as $logbook)
        <div class="modal fade" id="editLogbookModal-{{ $logbook->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editLogbookModalLabel-{{ $logbook->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLogbookModalLabel-{{ $logbook->id }}">Edit Logbook</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('logbooks.update', $logbook->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control"
                                    value="{{ $logbook->tanggal }}" required>
                            </div>
                            <div class="form-group">
                                <label for="kegiatan">Kegiatan</label>
                                <textarea name="kegiatan" id="kegiatan" class="form-control" rows="3" required>{{ $logbook->kegiatan }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="laporan_akhir">Terkait Laporan Akhir</label>
                                <select name="laporan_akhirs_id" id="laporan_akhirs_id" class="form-control"
                                    required>
                                    <option selected disabled>-- Pilih Laporan Akhir --</option>
                                    @forelse ($laporan_akhir as $la)
                                        <option value="{{ $la->id }}">
                                            {{ $la->laporanKemajuan->proposal->judul }} |
                                            {{ $la->laporanKemajuan->proposal->jenis_proposal }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
