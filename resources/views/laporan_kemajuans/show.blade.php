
<div class="container">
    <h1>Detail Laporan Kemajuan</h1>
    <table class="table">
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
    <a href="{{ route('laporan_kemajuans.edit', $laporanKemajuan->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('laporan_kemajuans.index') }}" class="btn btn-secondary">Kembali</a>
</div>
