
<div class="container">
    <h1>Tambah Laporan Kemajuan</h1>
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
