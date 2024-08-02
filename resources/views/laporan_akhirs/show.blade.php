
<div class="container">
    <h1>Detail Laporan Akhir</h1>
    <table class="table">
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
    <a href="{{ route('laporan_akhirs.edit', $laporanAkhir->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('laporan_akhirs.index') }}" class="btn btn-secondary">Kembali</a>
</div>
