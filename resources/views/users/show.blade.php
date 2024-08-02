@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Pengguna</h2>
    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Role</th>
            <td>{{ $user->role }}</td>
        </tr>
        @if($user->dosen)
        <tr>
            <th>NIDN</th>
            <td>{{ $user->dosen->nidn }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $user->dosen->kelamin }}</td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td>{{ $user->dosen->tempat_lahir }}, {{ $user->dosen->tanggal_lahir }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $user->dosen->alamat }}</td>
        </tr>
        <tr>
            <th>Nomor Telepon</th>
            <td>{{ $user->dosen->nomor_telepon }}</td>
        </tr>
        <tr>
            <th>Program Studi</th>
            <td>{{ $user->dosen->prodi }}</td>
        </tr>
        <tr>
            <th>Jabatan</th>
            <td>{{ $user->dosen->jabatan }}</td>
        </tr>
        <tr>
            <th>Pangkat</th>
            <td>{{ $user->dosen->pangkat }}</td>
        </tr>
        @endif
    </table>
    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection