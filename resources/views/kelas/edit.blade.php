<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('kelas.update', $item->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Kelas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Kelas</label>
            <input type="text" class="form-control" name="nama_kelas" value="{{ $item->nama_kelas }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategoriKelas_id" class="form-select" required>
              @foreach ($kategori as $kat)
                <option value="{{ $kat->id }}" {{ $item->kategoriKelas_id == $kat->id ? 'selected' : '' }}>
                  {{ $kat->nama_kategori }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
