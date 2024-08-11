<!DOCTYPE html>
<html lang="en">

<head>
    @include('Template.head')
    <title>AdminLTE 3 | Index</title>
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
                            <a href="{{ route('proposals.index') }}"
                                class="btn {!! Route::is('proposals.index') ? 'btn-primary' : 'btn-secondary' !!} col-md-5">Semua</a>
                            <a href="{{ route('penelitian.proposals.index') }}"
                                class="btn {!! Route::is('penelitian.proposals.index') ? 'btn-primary' : 'btn-secondary' !!} col-md-5">Penelitian</a>
                            <a href="{{ route('pengabdian.proposals.index') }}"
                                class="btn {!! Route::is('pengabdian.proposals.index') ? 'btn-primary' : 'btn-secondary' !!} col-md-5">Pengabdian</a>
                        </div>
                        <div class="col-12">

                            <div class="card mt-4">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        @if (Route::is('penelitian.proposals.index'))
                                            Daftar Proposal Penelitian
                                        @elseif (Route::is('pengabdian.proposals.index'))
                                            Daftar Proposal Pengabdian
                                        @else
                                            Daftar Semua Proposal
                                        @endif
                                    </h3>
                                </div>
                                <div class="card-body">
                                    @if (auth()->user()->role == 'user' && !Route::is('proposals.index'))
                                        <button class="btn btn-primary mb-3" data-toggle="modal"
                                            data-target="#createProposalModal">Tambah Proposal</button>
                                    @else
                                    @endif
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                @if (auth()->user()->role == 'admin')
                                                    <th>Nama Dosen</th>
                                                @endif
                                                <th>Judul</th>
                                                <th>Tanggal Upload</th>
                                                <th>Jenis Proposal</th>
                                                <th>Jenis</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($proposals as $proposal)
                                                <tr>
                                                    @if (auth()->user()->role == 'admin')
                                                        <td>{{ $proposal->user->name }}</td>
                                                    @endif
                                                    <td>{{ $proposal->judul }}</td>
                                                    <td>{{ $proposal->created_at }}</td>
                                                    <td>{{ $proposal->jenis_proposal }}</td>
                                                    <td>{{ $proposal->jenis }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info" data-toggle="modal"
                                                            data-target="#viewProposalModal-{{ $proposal->id }}">Lihat</button>
                                                        <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                            data-target="#editProposalModal-{{ $proposal->id }}">Edit</button>
                                                        <form action="{{ route('proposals.destroy', $proposal->id) }}"
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

    <!-- Create Proposal Modal -->
    <div class="modal fade" id="createProposalModal" tabindex="-1" role="dialog"
        aria-labelledby="createProposalModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProposalModalLabel">Tambah Proposal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('proposals.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="jenis"
                            value="{{ Route::is('penelitian.proposals.index') ? 'penelitian' : 'pengabdian' }}">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control"
                                placeholder="Judul?" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_proposal">Jenis Proposal</label>
                                    <select name="jenis_proposal" id="jenis_proposal" class="form-control" required>
                                        <option value="penelitian kualitatif">Penelitian Kualitatif</option>
                                        <option value="penelitian pengembangan">Penelitian Pengembangan</option>
                                        <option value="pengabdian masyarakat">Pengabdian Masyarakat</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_proposal">Tahun</label>
                                    <input type="text" name="tahun" id="tahun" class="form-control"
                                        placeholder="2024/2025 atau 2024 Bisa" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis">Jangka Waktu</label>
                                    <input type="text" name="jangka_waktu" id="jangka_waktu" class="form-control"
                                        placeholder="1 Minggu? 1 Tahun 2 Bulan?" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis">Biaya</label>
                                    <input type="text" name="biaya" id="biaya" class="form-control"
                                        placeholder="10.000" oninput="formatRupiah(this)" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_proposal">Sumber Biaya</label>
                            <input type="text" name="sumber_biaya" id="sumber_biaya"
                                placeholder="LLDIKTI? Kampus? Kementrian?" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Anggota</label>
                            <textarea name="anggota" id="anggota" class="form-control" placeholder="Fulan, Abdul, Usman, .."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" name="file" id="file" class="form-control-file" required>
                        </div>
                        <button type="submit" class="btn btn-primary col-md-12">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View Proposal Modal -->
    @foreach ($proposals as $proposal)
        <div class="modal fade" id="viewProposalModal-{{ $proposal->id }}" tabindex="-1" role="dialog"
            aria-labelledby="viewProposalModalLabel-{{ $proposal->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewProposalModalLabel-{{ $proposal->id }}">Detail Proposal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Judul</th>
                                <td>{{ $proposal->judul }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Upload</th>
                                <td>{{ $proposal->created_at }}</td>
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
                                <th>Tahun</th>
                                <td>{{ $proposal->tahun }}</td>
                            </tr>
                            <tr>
                                <th>Jangka Waktu</th>
                                <td>{{ $proposal->jangka_waktu }}</td>
                            </tr>
                            <tr>
                                <th>Biaya</th>
                                <td>Rp. {{ $proposal->biaya }}</td>
                            </tr>
                            <tr>
                                <th>Sumber Biaya</th>
                                <td>{{ $proposal->sumber_biaya }}</td>
                            </tr>
                            <tr>
                                <th>Anggota</th>
                                <td>{{ $proposal->anggota }}</td>
                            </tr>
                            <tr>
                                <th>File</th>
                                <td><a href="{{ url('storage/' . $proposal->file_path) }}" target="_blank">Lihat
                                        File</a></td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

    <!-- Edit Proposal Modal -->
    @foreach ($proposals as $proposal)
        <div class="modal fade" id="editProposalModal-{{ $proposal->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editProposalModalLabel-{{ $proposal->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProposalModalLabel-{{ $proposal->id }}">Edit Proposal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('proposals.update', $proposal->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="jenis" value="{{ $proposal->jenis }}">

                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control"
                                    value="{{ old('judul', $proposal->judul) }}" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_proposal">Jenis Proposal</label>
                                        <select name="jenis_proposal" id="jenis_proposal" class="form-control"
                                            required>
                                            <option value="penelitian kualitatif"
                                                {{ $proposal->jenis_proposal == 'penelitian kualitatif' ? 'selected' : '' }}>
                                                Penelitian Kualitatif
                                            </option>
                                            <option value="penelitian pengembangan"
                                                {{ $proposal->jenis_proposal == 'penelitian pengembangan' ? 'selected' : '' }}>
                                                Penelitian Pengembangan
                                            </option>
                                            <option value="pengabdian masyarakat"
                                                {{ $proposal->jenis_proposal == 'pengabdian masyarakat' ? 'selected' : '' }}>
                                                Pengabdian Masyarakat
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tahun">Tahun</label>
                                        <input type="text" name="tahun" id="tahun" class="form-control"
                                            value="{{ old('tahun', $proposal->tahun) }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jangka_waktu">Jangka Waktu</label>
                                        <input type="text" name="jangka_waktu" id="jangka_waktu"
                                            class="form-control"
                                            value="{{ old('jangka_waktu', $proposal->jangka_waktu) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="biaya">Biaya</label>
                                        <input type="text" name="biaya" id="biaya" class="form-control"
                                            value="{{ old('biaya', $proposal->biaya) }}" oninput="formatRupiah(this)"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sumber_biaya">Sumber Biaya</label>
                                <input type="text" name="sumber_biaya" id="sumber_biaya" class="form-control"
                                    value="{{ old('sumber_biaya', $proposal->sumber_biaya) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="anggota">Anggota</label>
                                <textarea name="anggota" id="anggota" class="form-control">{{ old('anggota', $proposal->anggota) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="file">File (Biarkan kosong jika tidak ingin mengubah)</label>
                                <input type="file" name="file" id="file" class="form-control-file">
                            </div>

                            <button type="submit" class="btn btn-primary col-md-12">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        function formatRupiah(input) {
            let value = input.value.replace(/\D/g, '');
            value = new Intl.NumberFormat('id-ID').format(value);
            input.value = value;
        }
    </script>

    <!-- Include Bootstrap CSS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
