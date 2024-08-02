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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Laporan Kemajuan</h3>
              </div>
              <div class="card-body">
                <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createLaporanKemajuanModal">Tambah Laporan Kemajuan</button>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Judul</th>
                      <th>Tanggal Upload</th>
                      <th>Jenis Laporan Kemajuan</th>
                      <th>Jenis</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($laporanKemajuans as $laporanKemajuan)
                    <tr>
                      <td>{{ $laporanKemajuan->judul }}</td>
                      <td>{{ $laporanKemajuan->tanggal_upload }}</td>
                      <td>{{ $laporanKemajuan->jenis_laporan_kemajuan }}</td>
                      <td>{{ $laporanKemajuan->jenis }}</td>
                      <td>
                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#viewLaporanKemajuanModal-{{ $laporanKemajuan->id }}">Lihat</button>
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editLaporanKemajuanModal-{{ $laporanKemajuan->id }}">Edit</button>
                        <form action="{{ route('laporan_kemajuans.destroy', $laporanKemajuan->id) }}" method="POST" style="display: inline-block;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
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

<!-- Create Laporan Kemajuan Modal -->
<div class="modal fade" id="createLaporanKemajuanModal" tabindex="-1" role="dialog" aria-labelledby="createLaporanKemajuanModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createLaporanKemajuanModalLabel">Tambah Laporan Kemajuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('laporan_kemajuans.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="jenis_laporan_kemajuan">Jenis Laporan Kemajuan</label>
            <select name="jenis_laporan_kemajuan" id="jenis_laporan_kemajuan" class="form-control" required>
              <option value="penelitian kualitatif">Penelitian Kualitatif</option>
              <option value="penelitian pengembangan">Penelitian Pengembangan</option>
              <option value="pengabdian masyarakat">Pengabdian Masyarakat</option>
            </select>
          </div>
          <div class="form-group">
            <label for="jenis">Jenis</label>
            <select name="jenis" id="jenis" class="form-control" required>
              <option value="penelitian">Penelitian</option>
              <option value="pengabdian">Pengabdian</option>
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

<!-- View Laporan Kemajuan Modal -->
@foreach($laporanKemajuans as $laporanKemajuan)
  <div class="modal fade" id="viewLaporanKemajuanModal-{{ $laporanKemajuan->id }}" tabindex="-1" role="dialog" aria-labelledby="viewLaporanKemajuanModalLabel-{{ $laporanKemajuan->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewLaporanKemajuanModalLabel-{{ $laporanKemajuan->id }}">Detail Laporan Kemajuan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tr>
              <th>Judul</th>
              <td>{{ $laporanKemajuan->judul }}</td>
            </tr>
            <tr>
              <th>Tanggal Upload</th>
              <td>{{ $laporanKemajuan->tanggal_upload }}</td>
            </tr>
            <tr>
              <th>Jenis Laporan Kemajuan</th>
              <td>{{ $laporanKemajuan->jenis_laporan_kemajuan }}</td>
            </tr>
            <tr>
              <th>Jenis</th>
              <td>{{ $laporanKemajuan->jenis }}</td>
            </tr>
            <tr>
              <th>File</th>
              <td><a href="{{ asset('storage/'.$laporanKemajuan->file) }}" target="_blank">Lihat File</a></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
@endforeach

<!-- Edit Laporan Kemajuan Modal -->
@foreach($laporanKemajuans as $laporanKemajuan)
  <div class="modal fade" id="editLaporanKemajuanModal-{{ $laporanKemajuan->id }}" tabindex="-1" role="dialog" aria-labelledby="editLaporanKemajuanModalLabel-{{ $laporanKemajuan->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLaporanKemajuanModalLabel-{{ $laporanKemajuan->id }}">Edit Laporan Kemajuan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('laporan_kemajuans.update', $laporanKemajuan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="judul">Judul</label>
              <input type="text" name="judul" id="judul" class="form-control" value="{{ $laporanKemajuan->judul }}" required>
            </div>
            <div class="form-group">
              <label for="jenis_laporan_kemajuan">Jenis Laporan Kemajuan</label>
              <select name="jenis_laporan_kemajuan" id="jenis_laporan_kemajuan" class="form-control" required>
                <option value="penelitian kualitatif" {{ $laporanKemajuan->jenis_laporan_kemajuan == 'penelitian kualitatif' ? 'selected' : '' }}>Penelitian Kualitatif</option>
                <option value="penelitian pengembangan" {{ $laporanKemajuan->jenis_laporan_kemajuan == 'penelitian pengembangan' ? 'selected' : '' }}>Penelitian Pengembangan</option>
                <option value="pengabdian masyarakat" {{ $laporanKemajuan->jenis_laporan_kemajuan == 'pengabdian masyarakat' ? 'selected' : '' }}>Pengabdian Masyarakat</option>
              </select>
            </div>
            <div class="form-group">
              <label for="jenis">Jenis</label>
              <select name="jenis" id="jenis" class="form-control" required>
                <option value="penelitian" {{ $laporanKemajuan->jenis == 'penelitian' ? 'selected' : '' }}>Penelitian</option>
                <option value="pengabdian" {{ $laporanKemajuan->jenis == 'pengabdian' ? 'selected' : '' }}>Pengabdian</option>
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