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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Laporan Akhir</h3>
              </div>
              <div class="card-body">
                <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createLaporanAkhirModal">Tambah Laporan Akhir</button>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Judul</th>
                      <th>Tanggal Upload</th>
                      <th>Jenis Laporan Akhir</th>
                      <th>Jenis</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($laporanAkhirs as $laporanAkhir)
                    <tr>
                      <td>{{ $laporanAkhir->judul }}</td>
                      <td>{{ $laporanAkhir->tanggal_upload }}</td>
                      <td>{{ $laporanAkhir->jenis_laporan_akhir }}</td>
                      <td>{{ $laporanAkhir->jenis }}</td>
                      <td>
                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#viewLaporanAkhirModal-{{ $laporanAkhir->id }}">Lihat</button>
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editLaporanAkhirModal-{{ $laporanAkhir->id }}">Edit</button>
                        <form action="{{ route('laporan_akhirs.destroy', $laporanAkhir->id) }}" method="POST" style="display: inline-block;">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Create Laporan Akhir Modal -->
<div class="modal fade" id="createLaporanAkhirModal" tabindex="-1" role="dialog" aria-labelledby="createLaporanAkhirModalLabel" aria-hidden="true">
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
            <label for="judul">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="jenis_laporan_akhir">Jenis Laporan Akhir</label>
            <select name="jenis_laporan_akhir" id="jenis_laporan_akhir" class="form-control" required>
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

<!-- View Laporan Akhir Modal -->
@foreach($laporanAkhirs as $laporanAkhir)
  <div class="modal fade" id="viewLaporanAkhirModal-{{ $laporanAkhir->id }}" tabindex="-1" role="dialog" aria-labelledby="viewLaporanAkhirModalLabel-{{ $laporanAkhir->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewLaporanAkhirModalLabel-{{ $laporanAkhir->id }}">Detail Laporan Akhir</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tr>
              <th>Judul</th>
              <td>{{ $laporanAkhir->judul }}</td>
            </tr>
            <tr>
              <th>Tanggal Upload</th>
              <td>{{ $laporanAkhir->tanggal_upload }}</td>
            </tr>
            <tr>
              <th>Jenis Laporan Akhir</th>
              <td>{{ $laporanAkhir->jenis_laporan_akhir }}</td>
            </tr>
            <tr>
              <th>Jenis</th>
              <td>{{ $laporanAkhir->jenis }}</td>
            </tr>
            <tr>
              <th>File</th>
              <td><a href="{{ asset('storage/'.$laporanAkhir->file) }}" target="_blank">Lihat File</a></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
@endforeach

<!-- Edit Laporan Akhir Modal -->
@foreach($laporanAkhirs as $laporanAkhir)
  <div class="modal fade" id="editLaporanAkhirModal-{{ $laporanAkhir->id }}" tabindex="-1" role="dialog" aria-labelledby="editLaporanAkhirModalLabel-{{ $laporanAkhir->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLaporanAkhirModalLabel-{{ $laporanAkhir->id }}">Edit Laporan Akhir</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('laporan_akhirs.update', $laporanAkhir->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="judul">Judul</label>
              <input type="text" name="judul" id="judul" class="form-control" value="{{ $laporanAkhir->judul }}" required>
            </div>
            <div class="form-group">
              <label for="jenis_laporan_akhir">Jenis Laporan Akhir</label>
              <select name="jenis_laporan_akhir" id="jenis_laporan_akhir" class="form-control" required>
                <option value="penelitian kualitatif" {{ $laporanAkhir->jenis_laporan_akhir == 'penelitian kualitatif' ? 'selected' : '' }}>Penelitian Kualitatif</option>
                <option value="penelitian pengembangan" {{ $laporanAkhir->jenis_laporan_akhir == 'penelitian pengembangan' ? 'selected' : '' }}>Penelitian Pengembangan</option>
                <option value="pengabdian masyarakat" {{ $laporanAkhir->jenis_laporan_akhir == 'pengabdian masyarakat' ? 'selected' : '' }}>Pengabdian Masyarakat</option>
              </select>
            </div>
            <div class="form-group">
              <label for="jenis">Jenis</label>
              <select name="jenis" id="jenis" class="form-control" required>
                <option value="penelitian" {{ $laporanAkhir->jenis == 'penelitian' ? 'selected' : '' }}>Penelitian</option>
                <option value="pengabdian" {{ $laporanAkhir->jenis == 'pengabdian' ? 'selected' : '' }}>Pengabdian</option>
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