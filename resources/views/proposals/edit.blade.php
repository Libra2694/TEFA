<!DOCTYPE html>
<html lang="en">
<head>
    <title>AdminLTE 3 | Edit Proposal</title>
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
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Proposal</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
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
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
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
