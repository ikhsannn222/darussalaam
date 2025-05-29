<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('kategori_kelas.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Tambah Kategori Kelas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <!-- Nama Kategori -->
          <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <div class="input-group input-group-lg">
              <span class="input-group-text bg-white border-end-0 rounded-start">
                <i class="fas fa-tags"></i>
              </span>
              <input type="text" class="form-control border-start-0 rounded-end"
                     placeholder="Masukkan nama kategori" name="nama_kategori" id="nama_kategori" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-round" data-bs-dismiss="modal">
            <i class="fas fa-times me-1"></i> Batal
          </button>
          <button type="submit" class="btn btn-primary btn-round">
            <i class="fas fa-save me-1"></i> Simpan
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
