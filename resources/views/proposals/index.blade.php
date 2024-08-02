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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Proposal</h3>
              </div>
              <div class="card-body">
                <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createProposalModal">Tambah Proposal</button>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Judul</th>
                      <th>Tanggal Upload</th>
                      <th>Jenis Proposal</th>
                      <th>Jenis</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($proposals as $proposal)
                    <tr>
                      <td>{{ $proposal->judul }}</td>
                      <td>{{ $proposal->tanggal_upload }}</td>
                      <td>{{ $proposal->jenis_proposal }}</td>
                      <td>{{ $proposal->jenis }}</td>
                      <td>
                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#viewProposalModal-{{ $proposal->id }}">Lihat</button>
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editProposalModal-{{ $proposal->id }}">Edit</button>
                        <form action="{{ route('proposals.destroy', $proposal->id) }}" method="POST" style="display: inline-block;">
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

<!-- Create Proposal Modal -->
<div class="modal fade" id="createProposalModal" tabindex="-1" role="dialog" aria-labelledby="createProposalModalLabel" aria-hidden="true">
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
          <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="jenis_proposal">Jenis Proposal</label>
            <select name="jenis_proposal" id="jenis_proposal" class="form-control" required>
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

<!-- View Proposal Modal -->
@foreach($proposals as $proposal)
  <div class="modal fade" id="viewProposalModal-{{ $proposal->id }}" tabindex="-1" role="dialog" aria-labelledby="viewProposalModalLabel-{{ $proposal->id }}" aria-hidden="true">
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
        </div>
      </div>
    </div>
  </div>
@endforeach

<!-- Edit Proposal Modal -->
@foreach($proposals as $proposal)
  <div class="modal fade" id="editProposalModal-{{ $proposal->id }}" tabindex="-1" role="dialog" aria-labelledby="editProposalModalLabel-{{ $proposal->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProposalModalLabel-{{ $proposal->id }}">Edit Proposal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('proposals.update', $proposal->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="judul">Judul</label>
              <input type="text" name="judul" id="judul" class="form-control" value="{{ $proposal->judul }}" required>
            </div>
            <div class="form-group">
              <label for="jenis_proposal">Jenis Proposal</label>
              <select name="jenis_proposal" id="jenis_proposal" class="form-control" required>
                <option value="penelitian kualitatif" {{ $proposal->jenis_proposal == 'penelitian kualitatif' ? 'selected' : '' }}>Penelitian Kualitatif</option>
                <option value="penelitian pengembangan" {{ $proposal->jenis_proposal == 'penelitian pengembangan' ? 'selected' : '' }}>Penelitian Pengembangan</option>
                <option value="pengabdian masyarakat" {{ $proposal->jenis_proposal == 'pengabdian masyarakat' ? 'selected' : '' }}>Pengabdian Masyarakat</option>
              </select>
            </div>
            <div class="form-group">
              <label for="jenis">Jenis</label>
              <select name="jenis" id="jenis" class="form-control" required>
                <option value="penelitian" {{ $proposal->jenis == 'penelitian' ? 'selected' : '' }}>Penelitian</option>
                <option value="pengabdian" {{ $proposal->jenis == 'pengabdian' ? 'selected' : '' }}>Pengabdian</option>
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

<!-- Include Bootstrap CSS and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>