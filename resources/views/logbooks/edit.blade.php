
<div class="container">
    <h1>Edit Logbook</h1>
    <form action="{{ route('logbooks.update', $logbook->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $logbook->tanggal }}" required>
        </div>
        <div class="form-group">
            <label for="kegiatan">Kegiatan</label>
            <textarea name="kegiatan" id="kegiatan" rows="5" class="form-control" required>{{ $logbook->kegiatan }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
