
<div class="container">
    <h1>Detail Logbook</h1>
    <table class="table">
        <tr>
            <th>Tanggal</th>
            <td>{{ $logbook->tanggal }}</td>
        </tr>
        <tr>
            <th>Kegiatan</th>
            <td>{{ $logbook->kegiatan }}</td>
        </tr>
    </table>
    <a href="{{ route('logbooks.edit', $logbook->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('logbooks.index') }}" class="btn btn-secondary">Kembali</a>
</div>
