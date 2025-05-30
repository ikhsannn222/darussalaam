<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="createModalLabel">Tambah Guru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Nama Guru --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">Nama Guru</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" name="nama" id="nama"
                                placeholder="Masukkan nama guru" required>
                        </div>
                    </div>

                    {{-- NIP --}}
                    <div class="mb-3">
                        <label for="nip" class="form-label fw-semibold">NIP</label>
                        <input type="text" class="form-control" name="nip" id="nip"
                            placeholder="Masukkan NIP (optional)">
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Masukkan email" required>
                    </div>

                    {{-- No HP --}}
                    <div class="mb-3">
                        <label for="no_hp" class="form-label fw-semibold">No. HP</label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp"
                            placeholder="Masukkan nomor HP (optional)">
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-semibold">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="2" placeholder="Masukkan alamat (optional)"></textarea>
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" required>
                            <option disabled selected>-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir">
                    </div>

                    {{-- Tempat Lahir --}}
                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label fw-semibold">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                            placeholder="Masukkan tempat lahir (optional)">
                    </div>

                    {{-- Kategori Kelas --}}
                    <div class="mb-3">
                        <label for="kategoriKelas_id" class="form-label fw-semibold">Kategori Kelas</label>
                        <select class="form-select" name="kategoriKelas_id" id="kategoriKelas_id" required>
                            <option disabled selected>-- Pilih Kategori Kelas --</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kelas --}}
                    <select class="form-select" name="kelas_id" id="kelas" required>
                        <option disabled selected>-- Pilih Kelas --</option>
                        @foreach ($kelas as $kel)
                            <option value="{{ $kel->id }}">{{ $kel->nama_kelas }}</option>
                        @endforeach
                    </select>
                    {{-- Upload Gambar --}}
                    <div class="mb-3">
                        <label for="image" class="form-label fw-semibold">Foto Guru</label>
                        <input class="form-control" type="file" name="image" id="image" accept="image/*">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
