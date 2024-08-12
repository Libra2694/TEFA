@include('Template.head')
<div class="container">
    <h1>Tambah Dosen</h1>
    <form action="{{ route('dosens.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nidn">NIDN</label>
            <input type="text" name="nidn" id="nidn" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="kelamin">Jenis Kelamin</label>
            <select name="kelamin" id="kelamin" class="form-control" required>
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="nomor_telepon">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="prodi">Program Studi</label>
            <select name="prodi" id="prodi" class="form-control" required>
                <option value="TE">Teknik Elektronika</option>
                <option value="TL">Teknik Listrik</option>
                <option value="TM">Teknik Mesin</option>
                <option value="AK">Akuntansi Perpajakan</option>
                <option value="TRPL">Teknologi Rekayasa Perangkat Lunak</option>
                <option value="BD">Bisnis Digital</option>
                <option value="TRAB">Teknologi Rekayasa Alat Berat</option>
                <option value="TRL">Teknologi Rekayasa Logistik</option>
            </select>
        </div>
        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="pangkat">Pangkat</label>
            <input type="text" name="pangkat" id="pangkat" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
