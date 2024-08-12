
<div class="container">
    <h1>Edit Laporan Kemajuan</h1>
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
