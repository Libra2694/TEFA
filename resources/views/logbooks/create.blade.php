
<div class="container">
    <h1>Tambah Logbook</h1>
    <form action="{{ route('logbooks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="kegiatan">Kegiatan</label>
            <textarea name="kegiatan" id="kegiatan" rows="5" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
