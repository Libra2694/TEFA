@include('Template.head')
<div class="container">
    <h1>Detail Dosen</h1>
    <table class="table">
        <tr>
            <th>Nama</th>
            <td>{{ $dosen->user->name }}</td>
        </tr>
        <tr>
            <th>NIDN</th>
            <td>{{ $dosen->nidn }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ ucfirst($dosen->kelamin) }}</td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td>{{ $dosen->tempat_lahir }}, {{ $dosen->tanggal_lahir }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $dosen->alamat }}</td>
        </tr>
        <tr>
            <th>Nomor Telepon</th>
            <td>{{ $dosen->nomor_telepon }}</td>
        </tr>
        <tr>
            <th>Program Studi</th>
            <td>{{ $dosen->prodi }}</td>
        </tr>
        <tr>
            <th>Jabatan</th>
            <td>{{ $dosen->jabatan }}</td>
        </tr>
        <tr>
            <th>Pangkat</th>
            <td>{{ $dosen->pangkat }}</td>
        </tr>
    </table>
    <a href="{{ route('dosens.edit', $dosen->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('dosens.index') }}" class="btn btn-secondary">Kembali</a>
</div>
