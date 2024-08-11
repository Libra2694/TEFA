<!DOCTYPE html>
<html lang="en">

<head>
    @include('Template.head')
    <title>AdminLTE 3 | Daftar Dosen</title>
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
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Daftar Dosen</h3>
                                </div>
                                <div class="card-body">
                                    <button class="btn btn-primary mb-3" data-toggle="modal"
                                        data-target="#createDosenModal">Tambah Dosen</button>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>NIDN</th>
                                                <th>Prodi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dosens as $dosen)
                                                <tr>
                                                    <td>{{ $dosen->user->name }}</td>
                                                    <td>{{ $dosen->nidn }}</td>
                                                    <td>{{ $dosen->prodi }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info" data-toggle="modal"
                                                            data-target="#viewDosenModal-{{ $dosen->id }}">Lihat</button>
                                                        <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                            data-target="#editDosenModal-{{ $dosen->id }}">Edit</button>
                                                        <form action="{{ route('dosens.destroy', $dosen->id) }}"
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

    <!-- Create Dosen Modal -->
    <div class="modal fade" id="createDosenModal" tabindex="-1" role="dialog" aria-labelledby="createDosenModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDosenModalLabel">Tambah Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dosens.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="user_id">Akun Dosen</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option selected disabled>-- Pilih Akun --</option>
                                @forelse ($users as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nidn">NIDN</label>
                            <input type="text" name="nidn" id="nidn" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="prodi">Prodi</label>
                            <select name="prodi" id="prodi" class="form-control" required>
                                <option selected disabled>-- Pilih Prodi -- </option>
                                <option value="TE">Teknik Elektronika</option>
                                <option value="TL">Teknik Listrik</option>
                                <option value="TM">Teknik Mesin</option>
                                <option value="AK">Akuntansi Perpajakan</option>
                                <option value="TRPL">Teknologi Rekayasa Perangkat Lunak</option>
                                <option value="BD">Bisnis Digital</option>
                                <option value="TRAB">Teknologi Rekayasa Alat Berat</option>
                                <option value="TRL">Teknologi Rekayasa Logistik</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelamin">Jenis Kelamin</label>
                            <select name="kelamin" id="kelamin" class="form-control" required>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nomor_telepon">Nomor Telepon</label>
                            <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="pangkat">Pangkat</label>
                            <input type="text" name="pangkat" id="pangkat" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View Dosen Modal -->
    @foreach ($dosens as $dosen)
        <div class="modal fade" id="viewDosenModal-{{ $dosen->id }}" tabindex="-1" role="dialog"
            aria-labelledby="viewDosenModalLabel-{{ $dosen->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewDosenModalLabel-{{ $dosen->id }}">Detail Dosen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $dosen->user->name }}</td>
                            </tr>
                            <tr>
                                <th>NIDN</th>
                                <td>{{ $dosen->nidn }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ ucfirst($dosen->kelamin) }}</td>
                            </tr>
                            <tr>
                                <th>Tempat, Tanggal Lahir</th>
                                <td>{{ $dosen->tempat_lahir }}, {{ $dosen->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $dosen->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Telepon</th>
                                <td>{{ $dosen->nomor_telepon }}</td>
                            </tr>
                            <tr>
                                <th>Program Studi</th>
                                <td>{{ $dosen->prodi }}</td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td>{{ $dosen->jabatan }}</td>
                            </tr>
                            <tr>
                                <th>Pangkat</th>
                                <td>{{ $dosen->pangkat }}</td>
                            </tr>
                        </table>
                        <a href="{{ route('dosens.edit', $dosen->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('dosens.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Edit Dosen Modal -->
    @foreach ($dosens as $dosen)
        <div class="modal fade" id="editDosenModal-{{ $dosen->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editDosenModalLabel-{{ $dosen->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDosenModalLabel-{{ $dosen->id }}">Edit Dosen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dosens.update', $dosen->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="user_id">Akun Dosen</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    <option selected disabled>-- Pilih Akun --</option>
                                    @forelse ($users as $u)
                                        <option value="{{ $u->id }}"
                                            {{ $u->id == $dosen->user_id ? 'selected' : '' }}>{{ $u->name }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nidn">NIDN</label>
                                <input type="text" name="nidn" id="nidn" class="form-control"
                                    value="{{ $dosen->nidn }}" required>
                            </div>
                            <div class="form-group">
                                <label for="prodi">Prodi</label>
                                <input type="text" name="prodi" id="prodi" class="form-control"
                                    value="{{ $dosen->prodi }}" required>
                            </div>
                            <div class="form-group">
                                <label for="kelamin">Jenis Kelamin</label>
                                <select name="kelamin" id="kelamin" class="form-control" required>
                                    <option value="laki-laki" {{ $dosen->kelamin == 'laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="perempuan" {{ $dosen->kelamin == 'perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                    value="{{ $dosen->tempat_lahir }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                    value="{{ $dosen->tanggal_lahir }}" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" required>{{ $dosen->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="nomor_telepon">Nomor Telepon</label>
                                <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control"
                                    value="{{ $dosen->nomor_telepon }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" class="form-control"
                                    value="{{ $dosen->jabatan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="pangkat">Pangkat</label>
                                <input type="text" name="pangkat" id="pangkat" class="form-control"
                                    value="{{ $dosen->pangkat }}" required>
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
