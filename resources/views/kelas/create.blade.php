<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Nama Kelas -->
                    <div class="mb-3">
                        <label for="nama_kelas" class="form-label fw-semibold">Nama Kelas</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="fas fa-chalkboard"></i>
                            </span>
                            <input type="text" class="form-control" name="nama_kelas" id="nama_kelas"
                                placeholder="Masukkan nama kelas" required>
                        </div>
                    </div>


                    <!-- Kategori Kelas -->
                    <div class="mb-3">
                        <label for="kategoriKelas_id" class="form-label">Kategori</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-white border-end-0 rounded-start">
                                <i class="fas fa-tags"></i>
                            </span>
                            <select name="kategoriKelas_id" id="kategoriKelas_id"
                                class="form-select border-start-0 rounded-end" required>
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Kelas</label>
                        <input class="form-control" type="file" name="image" id="image" accept="image/*">
                    </div>
                </div>

                <!-- Modal footer -->
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
