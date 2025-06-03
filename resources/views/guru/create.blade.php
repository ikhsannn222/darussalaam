<!-- Modal Tambah Guru -->
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

                        {{-- Nama --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Guru</label>
                            <div class="input-group">
                                <span class="input-group-text"> <i class="fas fa-user-tie"></i></span>
                                <input type="text" class="form-control" name="nama" placeholder="Masukkan nama guru"
                                    value="{{ old('nama') }}" required>
                            </div>
                            @error('nama')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NIP --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIP</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                <input type="text" class="form-control" name="nip" placeholder="Masukkan NIP"
                                    value="{{ old('nip') }}">
                            </div>
                            @error('nip')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" name="email" placeholder="Masukkan email"
                                    value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- No HP --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. HP</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control" name="no_hp" placeholder="Masukkan no. HP"
                                    value="{{ old('no_hp') }}">
                            </div>
                            @error('no_hp')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Alamat</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                <textarea class="form-control" name="alamat" id="alamat1" rows="4" placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>
                            </div>
                            @error('alamat')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                <select class="form-select" name="jenis_kelamin" required>
                                    <option disabled selected>-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            @error('jenis_kelamin')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" class="form-control" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir') }}">
                            </div>
                            @error('tanggal_lahir')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tempat Lahir --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tempat Lahir</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                <input type="text" class="form-control" name="tempat_lahir" placeholder="Masukkan tempat lahir"
                                    value="{{ old('tempat_lahir') }}">
                            </div>
                            @error('tempat_lahir')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kategori Kelas --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kategori Kelas</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                <select class="form-select" name="kategoriKelas_id" id="kategoriKelasSelect" required>
                                    <option disabled selected>-- Pilih Kategori Kelas --</option>
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat->id }}" {{ old('kategoriKelas_id') == $kat->id ? 'selected' : '' }}>
                                            {{ $kat->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('kategoriKelas_id')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kelas --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kelas</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-chalkboard-teacher"></i></span>
                                <select class="form-select" name="kelas_id" id="kelasSelect" required>
                                    <option disabled selected>-- Pilih Kelas --</option>
                                    @foreach ($kelas as $kel)
                                        @if ($kel->kategori)
                                            <option value="{{ $kel->id }}" data-kategori="{{ $kel->kategori->id }}"
                                                {{ old('kelas_id') == $kel->id ? 'selected' : '' }}>
                                                {{ $kel->nama_kelas }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @error('kelas_id')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Gambar --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Foto Guru</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                                <input type="file" class="form-control" name="image" accept="image/*">
                            </div>
                            @error('image')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
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
    function filterKelas() {
        const selectedKategori = document.getElementById('kategoriKelasSelect').value;
        const kelasOptions = document.querySelectorAll('#kelasSelect option');

        kelasOptions.forEach(option => {
            const kategoriId = option.getAttribute('data-kategori');
            if (!kategoriId || selectedKategori === '' || kategoriId === selectedKategori) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        filterKelas();
        document.getElementById('kategoriKelasSelect').addEventListener('change', filterKelas);

        @if ($errors->any())
            new bootstrap.Modal(document.getElementById('createModal')).show();
        @endif
    });
</script>

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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#alamat1'))
            .catch(error => {
                console.error(error);
            });
    });
</script>

