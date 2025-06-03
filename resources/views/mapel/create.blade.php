<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('mapel.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Mapel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Nama Mapel --}}
                    <div class="mb-3">
                        <label for="nama_mapel" class="form-label fw-semibold">Nama Mapel</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="fas fa-book"></i>
                            </span>
                            <input type="text" class="form-control" name="nama_mapel" id="nama_mapel"
                                placeholder="Masukkan nama mapel" required>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <div class="mb-1">
                            <i class="fas fa-map-marker-alt me-1"></i>
                            <small class="text-muted">Masukkan deskripsi mapel</small>
                        </div>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" placeholder="Masukkan deskripsi">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- Kategori Kelas --}}
                    <div class="mb-3">
                        <label for="kategoriKelasSelect" class="form-label fw-semibold">Kategori Kelas</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                            <select class="form-select" name="kategoriKelas_id" id="kategoriKelasSelect" required>
                                <option disabled selected>-- Pilih Kategori Kelas --</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Kelas --}}
                    <div class="mb-3">
                        <label for="kelasSelect" class="form-label fw-semibold">Kelas</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-chalkboard-teacher"></i></span>
                            <select class="form-select" name="kelas_id" id="kelasSelect" required>
                                <option disabled selected>-- Pilih Kelas --</option>
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->id }}" data-kategori="{{ $kls->kategoriKelas_id }}">
                                        {{ $kls->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Guru --}}
                    <div class="mb-3">
                        <label for="guruSelect" class="form-label fw-semibold">Guru</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                            <select class="form-select" name="guru_id" id="guruSelect" required>
                                <option disabled selected>-- Pilih Guru --</option>
                                @foreach ($guru as $g)
                                    <option value="{{ $g->id }}" data-kategori="{{ $g->kategoriKelas_id }}">
                                        {{ $g->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Modal Footer --}}
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        ClassicEditor
            .create(document.querySelector('#deskripsi'))
            .catch(error => {
                console.error(error);
            });

        const kategoriSelect = document.getElementById('kategoriKelas_id');
        const kelasSelect = document.getElementById('kelas_id');
        const guruSelect = document.getElementById('guru_id');

        const kelasOptions = Array.from(kelasSelect.options);
        const guruOptions = Array.from(guruSelect.options);

        kategoriSelect.addEventListener('change', function() {
            const selectedKategori = this.value;

            // Filter Kelas
            kelasSelect.innerHTML = '<option disabled selected>-- Pilih Kelas --</option>';
            kelasOptions.forEach(option => {
                if (option.dataset.kategori == selectedKategori) {
                    kelasSelect.appendChild(option);
                }
            });

            // Filter Guru
            guruSelect.innerHTML = '<option disabled selected>-- Pilih Guru --</option>';
            guruOptions.forEach(option => {
                if (option.dataset.kategori == selectedKategori) {
                    guruSelect.appendChild(option);
                }
            });
        });
    });
</script>
