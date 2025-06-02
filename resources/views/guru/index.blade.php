@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Daftar Guru</h4>
            <button class="btn btn-primary rounded-pill shadow" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fas fa-plus me-1"></i>Guru
            </button>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Guru</th>
                                <th>NIP</th>
                                <th>Email</th>
                                <th>Kategori Kelas</th>
                                <th>Kelas</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guru as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->nip ?? '-' }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->kategoriKelas->nama_kategori ?? '-' }}</td>
                                    <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton{{ $item->id }}" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu"
                                                aria-labelledby="dropdownMenuButton{{ $item->id }}">
                                                <li>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#showModal-{{ $item->id }}">
                                                        <i class="fas fa-eye me-1"></i> Lihat
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editModal-{{ $item->id }}">
                                                        <i class="fas fa-edit me-1"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item text-danger"
                                                        onclick="confirmDelete('delete-form-{{ $item->id }}')">
                                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                                    </button>
                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('guru.destroy', $item->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Modal Show --}}
                                <div class="modal fade" id="showModal-{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="showModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Tambahkan modal-lg agar lebar --}}
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="showModalLabel{{ $item->id }}">Detail Guru
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Nama</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-user"></i></span>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->nama }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">NIP</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-id-card"></i></span>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->nip ?? '-' }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Email</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-envelope"></i></span>
                                                            <input type="email" class="form-control"
                                                                value="{{ $item->email }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">No HP</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-phone"></i></span>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->no_hp ?? '-' }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label fw-semibold">Alamat</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-map-marker-alt"></i></span>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->alamat ?? '-' }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-venus-mars"></i></span>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}"
                                                                readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-calendar"></i></span>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->tanggal_lahir ?? '-' }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Tempat Lahir</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-map-pin"></i></span>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->tempat_lahir ?? '-' }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Kategori Kelas</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-layer-group"></i></span>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->kategoriKelas->nama_kategori ?? '-' }}"
                                                                readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Kelas</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-chalkboard"></i></span>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->kelas->nama_kelas ?? '-' }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Gambar</label>
                                                        <div>
                                                            @if ($item->image && file_exists(public_path('storage/' . $item->image)))
                                                                <img src="{{ asset('storage/' . $item->image) }}"
                                                                    alt="Gambar Guru" class="rounded shadow-sm mt-2"
                                                                    style="max-height: 200px; cursor: pointer;"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#imageModal-{{ $item->id }}">
                                                            @else
                                                                <p class="text-muted mt-2"><em>Tidak ada gambar
                                                                        tersedia.</em></p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Gambar --}}
                                @if ($item->image && file_exists(public_path('storage/' . $item->image)))
                                    <div class="modal fade" id="imageModal-{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content bg-transparent border-0">
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/' . $item->image) }}"
                                                        alt="Gambar Guru Besar" class="img-fluid rounded shadow">
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel-{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <form action="{{ route('guru.update', $item->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Guru</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        {{-- Nama --}}
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Nama</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-user"></i></span>
                                                                <input type="text" name="nama" class="form-control"
                                                                    value="{{ $item->nama }}" required>
                                                            </div>
                                                        </div>

                                                        {{-- NIP --}}
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">NIP</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-id-card"></i></span>
                                                                <input type="text" name="nip" class="form-control"
                                                                    value="{{ $item->nip }}">
                                                            </div>
                                                        </div>

                                                        {{-- Email --}}
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Email</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-envelope"></i></span>
                                                                <input type="email" name="email" class="form-control"
                                                                    value="{{ $item->email }}" required>
                                                            </div>
                                                        </div>

                                                        {{-- No HP --}}
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">No HP</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-phone"></i></span>
                                                                <input type="text" name="no_hp" class="form-control"
                                                                    value="{{ $item->no_hp }}">
                                                            </div>
                                                        </div>

                                                        {{-- Alamat --}}
                                                        <div class="col-md-12">
                                                            <label for="alamat"
                                                                class="form-label fw-semibold">Alamat</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-map-marker-alt"></i></span>
                                                                <textarea class="form-control" name="alamat" id="alamat-{{ $item->id }}" rows="4"
                                                                    placeholder="Masukkan alamat (optional)">{{ $item->alamat }}</textarea>

                                                            </div>
                                                        </div>
                                                        {{-- Jenis Kelamin --}}
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                                                            <select name="jenis_kelamin" class="form-select" required>
                                                                <option value="L"
                                                                    {{ $item->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                                    Laki-laki</option>
                                                                <option value="P"
                                                                    {{ $item->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                                    Perempuan</option>
                                                            </select>
                                                        </div>

                                                        {{-- Tanggal Lahir --}}
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-calendar-alt"></i></span>
                                                                <input type="date" name="tanggal_lahir"
                                                                    class="form-control"
                                                                    value="{{ $item->tanggal_lahir }}">
                                                            </div>
                                                        </div>

                                                        {{-- Tempat Lahir --}}
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Tempat Lahir</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-map-pin"></i></span>
                                                                <input type="text" name="tempat_lahir"
                                                                    class="form-control"
                                                                    value="{{ $item->tempat_lahir }}">
                                                            </div>
                                                        </div>

                                                        {{-- Kategori Kelas --}}
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Kategori Kelas</label>
                                                            <select name="kategoriKelas_id" class="form-select" required>
                                                                <option value="" disabled>-- Pilih Kategori --
                                                                </option>
                                                                @foreach ($kategori as $kat)
                                                                    <option value="{{ $kat->id }}"
                                                                        {{ $item->kategoriKelas_id == $kat->id ? 'selected' : '' }}>
                                                                        {{ $kat->nama_kategori }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        {{-- Kelas --}}
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Kelas</label>
                                                            <select name="kelas_id" class="form-select" required>
                                                                <option value="" disabled>-- Pilih Kelas --</option>
                                                                @foreach ($kelas as $k)
                                                                    <option value="{{ $k->id }}"
                                                                        {{ $item->kelas_id == $k->id ? 'selected' : '' }}>
                                                                        {{ $k->nama_kelas }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        {{-- Upload Gambar --}}
                                                        <div class="col-md-6">
                                                            <label class="form-label fw-semibold">Upload Gambar</label>
                                                            <input class="form-control" type="file" name="image"
                                                                accept="image/*">
                                                            @if ($item->image && file_exists(public_path('storage/' . $item->image)))
                                                                <div class="mt-2">
                                                                    <small class="text-muted">Gambar saat ini:</small><br>
                                                                    <img src="{{ asset('storage/' . $item->image) }}"
                                                                        alt="Preview Gambar"
                                                                        class="rounded shadow-sm mt-1"
                                                                        style="max-height: 150px;">
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div> {{-- row --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-round"
                                                        data-bs-dismiss="modal">
                                                        <i class="fas fa-times me-1"></i> Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-primary btn-round">
                                                        <i class="fas fa-save me-1"></i> Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('guru.create', ['kategori' => $kategori])

    @if (session('sweetalert'))
        <script>
            Swal.fire({
                title: {!! json_encode(session('sweetalert.title')) !!},
                icon: {!! json_encode(session('sweetalert.icon')) !!},
                position: {!! json_encode(session('sweetalert.position') ?? 'center') !!},
                showConfirmButton: {{ session('sweetalert.showConfirmButton') ? 'true' : 'false' }},
                timer: {{ session('sweetalert.timer') ?? 1500 }}
            });
        </script>
    @endif
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(formId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById(formId);
                if (form) {
                    form.submit();
                } else {
                    console.error("Form dengan ID '" + formId + "' tidak ditemukan.");
                }
            }
        })
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[id^="editModal-"]').forEach(function (modal) {
            modal.addEventListener('shown.bs.modal', function () {
                const idGuru = this.id.replace('editModal-', '');
                const textarea = document.querySelector(`#alamat-${idGuru}`);

                // Cek apakah sudah diinisialisasi editor
                if (textarea && !textarea.dataset.editorInitialized) {
                    ClassicEditor
                        .create(textarea)
                        .then(editor => {
                            textarea.dataset.editorInitialized = 'true';
                        })
                        .catch(error => console.error(error));
                }
            });
        });
    });
</script>


