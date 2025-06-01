<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        {{-- Nama Guru --}}
                        <div class="col-md-6">
                            <label for="nama" class="form-label fw-semibold">Nama Guru</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    placeholder="Masukkan nama guru" required>
                            </div>
                        </div>

                        {{-- NIP --}}
                        <div class="col-md-6">
                            <label for="nip" class="form-label fw-semibold">NIP</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-id-card"></i></span>
                                <input type="text" class="form-control" name="nip" id="nip"
                                    placeholder="Masukkan NIP (optional)">
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Masukkan email" required>
                            </div>
                        </div>

                        {{-- No HP --}}
                        <div class="col-md-6">
                            <label for="no_hp" class="form-label fw-semibold">No. HP</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control" name="no_hp" id="no_hp"
                                    placeholder="Masukkan nomor HP (optional)">
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="col-md-12">
                            <label for="alamat" class="form-label fw-semibold">Alamat</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                <textarea class="form-control" name="alamat" id="alamat1" rows="4" placeholder="Masukkan alamat (optional)"></textarea>
                            </div>
                        </div>


                        {{-- Jenis Kelamin --}}
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-venus-mars"></i></span>
                                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" required>
                                    <option disabled selected>-- Pilih Jenis Kelamin --</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir">
                            </div>
                        </div>

                        {{-- Tempat Lahir --}}
                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label fw-semibold">Tempat Lahir</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                                    placeholder="Masukkan tempat lahir (optional)">
                            </div>
                        </div>

                        {{-- Kategori Kelas --}}
                        <div class="col-md-6">
                            <label for="kategoriKelas_id" class="form-label fw-semibold">Kategori Kelas</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-layer-group"></i></span>
                                <select class="form-select" name="kategoriKelas_id" id="kategoriKelas_id" required>
                                    <option disabled selected>-- Pilih Kategori Kelas --</option>
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="kelas" class="form-label fw-semibold">Kelas</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i
                                        class="fas fa-chalkboard-teacher"></i></span>
                                <select class="form-select" name="kelas_id" id="kelas" required>
                                    <option disabled selected>-- Pilih Kelas --</option>
                                    @foreach ($kelas as $kel)
                                        <option value="{{ $kel->id }}" data-kategori="{{ $kel->kategori->id }}">
                                            {{ $kel->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Upload Gambar --}}
                        <div class="col-md-6">
                            <label for="image" class="form-label fw-semibold">Foto Guru</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-image"></i></span>
                                <input class="form-control" type="file" name="image" id="image"
                                    accept="image/*">
                            </div>
                        </div>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kategoriSelect = document.getElementById('kategoriKelas_id');
        const kelasSelect = document.getElementById('kelas');
        const allKelasOptions = Array.from(kelasSelect.options).slice(1); // exclude the first default option

        kategoriSelect.addEventListener('change', function() {
            const selectedKategori = this.value;

            // clear current kelas options (except first)
            kelasSelect.innerHTML = '<option disabled selected>-- Pilih Kelas --</option>';

            // append filtered kelas options
            allKelasOptions.forEach(option => {
                if (option.getAttribute('data-kategori') === selectedKategori) {
                    kelasSelect.appendChild(option);
                }
            });
        });
    });
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#alamat1'))
            .catch(error => {
                console.error(error);
            });
    });
</script>

