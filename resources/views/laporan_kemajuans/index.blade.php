<!DOCTYPE html>
<html lang="en">

<head>
    @include('Template.head')
    <title>AdminLTE 3 | Laporan Kemajuan</title>
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
                        <div class="btn-group justify-content-center col-md-12 mt-4">
                            <a href="{{ route('laporan_kemajuans.index') }}"
                                class="btn {!! Route::is('laporan_kemajuans.index') ? 'btn-primary' : 'btn-secondary' !!} col-md-5">Semua</a>
                            <a href="{{ route('penelitian.laporan_kemajuans.index') }}"
                                class="btn {!! Route::is('penelitian.laporan_kemajuans.index') ? 'btn-primary' : 'btn-secondary' !!} col-md-5">Penelitian</a>
                            <a href="{{ route('pengabdian.laporan_kemajuans.index') }}"
                                class="btn {!! Route::is('pengabdian.laporan_kemajuans.index') ? 'btn-primary' : 'btn-secondary' !!} col-md-5">Pengabdian</a>
                        </div>
                        <div class="col-12">
                            <div class="card mt-4">
                                <div class="card-header">
                                    @if (Route::is('penelitian.laporan_kemajuans.index'))
                                        Daftar Laporan Kemajuan Penelitian
                                    @elseif (Route::is('pengabdian.laporan_kemajuans.index'))
                                        Daftar Laporan Kemajuan Pengabdian
                                    @else
                                        Daftar Semua Laporan Kemajuan
                                    @endif
                                </div>
                                <div class="card-body">
                                    @if (auth()->user()->role == 'user' && !Route::is('laporan_kemajuans.index'))
                                        <button class="btn btn-primary mb-3" data-toggle="modal"
                                            data-target="#createLaporanKemajuanModal">Tambah Laporan Kemajuan</button>
                                    @endif
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                @if (auth()->user()->role == 'admin')
                                                    <th>Nama Dosen</th>
                                                @endif
                                                <th>Judul Proposal Terkait</th>
                                                <th>Tanggal Upload</th>
                                                <th>Jenis Laporan Kemajuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($laporanKemajuans as $laporanKemajuan)
                                                <tr>
                                                    @if (auth()->user()->role == 'admin')
                                                        <td>{{ $laporanKemajuan->user->name }}</td>
                                                    @endif
                                                    <td>{{ $laporanKemajuan->proposal->judul }}</td>
                                                    <td>{{ $laporanKemajuan->tanggal_upload }}</td>
                                                    <td>{{ $laporanKemajuan->proposal->jenis }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info" data-toggle="modal"
                                                            data-target="#viewLaporanKemajuanModal-{{ $laporanKemajuan->id }}">Lihat</button>
                                                        <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                            data-target="#editLaporanKemajuanModal-{{ $laporanKemajuan->id }}">Edit</button>
                                                        <form
                                                            action="{{ route('laporan_kemajuans.destroy', $laporanKemajuan->id) }}"
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

    @if (auth()->user()->role == 'user')

        <!-- Create Laporan Kemajuan Modal -->
        <div class="modal fade" id="createLaporanKemajuanModal" tabindex="-1" role="dialog"
            aria-labelledby="createLaporanKemajuanModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createLaporanKemajuanModalLabel">Tambah Laporan Kemajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('laporan_kemajuans.store') }}" method="POST"
                            enctype="multipart/form-data">
                            <input type="hidden" name="dosen_id" value="{{ auth()->user()->id }}"> @csrf
                            <div class="form-group">
                                <label for="id_proposal">Pilih Proposal</label>
                                <select name="id_proposal" id="id_proposal" class="form-control" required>
                                    <option selected disabled>-- Pilih Proposal --</option>
                                    @forelse ($proposals as $pro)
                                        <option value="{{ $pro->id }}">{{ $pro->judul }} | {{ $pro->jenis }}
                                        </option>
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
    @endif

    <!-- View Laporan Kemajuan Modal -->
    @foreach ($laporanKemajuans as $laporanKemajuan)
        <div class="modal fade" id="viewLaporanKemajuanModal-{{ $laporanKemajuan->id }}" tabindex="-1" role="dialog"
            aria-labelledby="viewLaporanKemajuanModalLabel-{{ $laporanKemajuan->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewLaporanKemajuanModalLabel-{{ $laporanKemajuan->id }}">Detail
                            Laporan Kemajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Judul Proposal Terkait</th>
                                <td>{{ $laporanKemajuan->proposal->judul }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Upload</th>
                                <td>{{ $laporanKemajuan->tanggal_upload }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Laporan Kemajuan</th>
                                <td>{{ $laporanKemajuan->proposal->jenis }}</td>
                            </tr>
                            <tr>
                                <th>File Laporan Kemajuan</th>
                                <td><a href="{{ asset('storage/' . $laporanKemajuan->file) }}" target="_blank">Lihat
                                        File</a></td>
                            </tr>
                            <tr>
                                <th>File Proposal</th>
                                <td><a href="{{ asset('storage/' . $laporanKemajuan->proposal->file) }}"
                                        target="_blank">Lihat
                                        File</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Edit Laporan Kemajuan Modal -->
    @foreach ($laporanKemajuans as $laporanKemajuan)
        <div class="modal fade" id="editLaporanKemajuanModal-{{ $laporanKemajuan->id }}" tabindex="-1"
            role="dialog" aria-labelledby="editLaporanKemajuanModalLabel-{{ $laporanKemajuan->id }}"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLaporanKemajuanModalLabel-{{ $laporanKemajuan->id }}">Edit
                            Laporan Kemajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('laporan_kemajuans.update', $laporanKemajuan->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="dosen_id" value="{{ auth()->user()->id }}"> @csrf
                            <div class="form-group">
                                <label for="id_proposal">Pilih Proposal</label>
                                <select name="id_proposal" id="id_proposal" class="form-control" required>
                                    <option selected disabled>-- Pilih Proposal --</option>
                                    @forelse ($proposals as $pro)
                                        <option value="{{ $pro->id }}"
                                            {{ $laporanKemajuan->proposal->id == $pro->id ? 'selected' : '' }}>
                                            {{ $pro->judul }} | {{ $pro->jenis }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="file">File (Biarkan kosong jika tidak ingin mengubah)</label>
                                <input type="file" name="file" id="file" class="form-control-file">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</body>

</html>
