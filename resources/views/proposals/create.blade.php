<!DOCTYPE html>
<html lang="en">
<head>
    @include('Template.head')
    <title>AdminLTE 3 | Tambah Proposal</title>
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
                <h3 class="card-title">Tambah Proposal</h3>
              </div>
              <div class="card-body">
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
      </div>
    </section>
  </div>

  @include('Template.footer')

</div>

@include('Template.script')
</body>
</html>
