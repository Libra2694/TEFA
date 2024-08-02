
<div class="container">
    <h1>Edit Laporan Akhir</h1>
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
