@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Daftar Guru</h4>
            <button class="btn btn-primary rounded-pill shadow" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fas fa-plus me-1"></i> Tambah Guru
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
                                            <button class="btn btn-sm btn-light shadow-sm border" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#showModal-{{ $item->id }}">
                                                        <i class="fas fa-eye me-1 text-info"></i> Lihat
                                                    </a></li>
                                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#editModal-{{ $item->id }}">
                                                        <i class="fas fa-edit me-1 text-warning"></i> Edit
                                                    </a></li>
                                                <li>
                                                    <button class="dropdown-item text-danger"
                                                        onclick="confirmDelete('delete-form-{{ $item->id }}')">
                                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                                    </button>

                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('guru.destroy', $item->id) }}" method="POST"
                                                        class="d-none">
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
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="showModalLabel{{ $item->id }}">Detail Guru
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Nama:</strong> {{ $item->nama }}</p>
                                                <p><strong>NIP:</strong> {{ $item->nip ?? '-' }}</p>
                                                <p><strong>Email:</strong> {{ $item->email }}</p>
                                                <p><strong>No HP:</strong> {{ $item->no_hp ?? '-' }}</p>
                                                <p><strong>Alamat:</strong> {{ $item->alamat ?? '-' }}</p>
                                                <p><strong>Jenis Kelamin:</strong>
                                                    {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                                <p><strong>Tanggal Lahir:</strong> {{ $item->tanggal_lahir ?? '-' }}</p>
                                                <p><strong>Tempat Lahir:</strong> {{ $item->tempat_lahir ?? '-' }}</p>
                                                <p><strong>Kategori Kelas:</strong>
                                                    {{ $item->kategoriKelas->nama_kategori ?? '-' }}</p>
                                                <p><strong>Kelas:</strong> {{ $item->kelas->nama_kelas ?? '-' }}</p>

                                                <div class="d-flex align-items-start mb-3">
                                                    <strong class="me-2">Gambar:</strong>
                                                    @if ($item->image && file_exists(public_path('storage/' . $item->image)))
                                                        <img src="{{ asset('storage/' . $item->image) }}" alt="Gambar Guru"
                                                            class="rounded shadow-sm"
                                                            style="max-height: 200px; cursor: pointer;"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#imageModal-{{ $item->id }}">
                                                    @else
                                                        <span class="text-muted"><em>Tidak ada gambar tersedia.</em></span>
                                                    @endif
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
                                    <div class="modal-dialog">
                                        <form action="{{ route('guru.update', $item->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel-{{ $item->id }}">Edit
                                                        Guru</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    {{-- Nama --}}
                                                    <div class="mb-3">
                                                        <label for="nama_{{ $item->id }}"
                                                            class="form-label">Nama</label>
                                                        <input type="text" class="form-control" name="nama"
                                                            id="nama_{{ $item->id }}" value="{{ $item->nama }}"
                                                            required>
                                                    </div>

                                                    {{-- NIP --}}
                                                    <div class="mb-3">
                                                        <label for="nip_{{ $item->id }}"
                                                            class="form-label">NIP</label>
                                                        <input type="text" class="form-control" name="nip"
                                                            id="nip_{{ $item->id }}" value="{{ $item->nip }}">
                                                    </div>

                                                    {{-- Email --}}
                                                    <div class="mb-3">
                                                        <label for="email_{{ $item->id }}"
                                                            class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="email"
                                                            id="email_{{ $item->id }}" value="{{ $item->email }}"
                                                            required>
                                                    </div>

                                                    {{-- No HP --}}
                                                    <div class="mb-3">
                                                        <label for="no_hp_{{ $item->id }}" class="form-label">No
                                                            HP</label>
                                                        <input type="text" class="form-control" name="no_hp"
                                                            id="no_hp_{{ $item->id }}" value="{{ $item->no_hp }}">
                                                    </div>

                                                    {{-- Alamat --}}
                                                    <div class="mb-3">
                                                        <label for="alamat_{{ $item->id }}"
                                                            class="form-label">Alamat</label>
                                                        <textarea class="form-control" name="alamat" id="alamat_{{ $item->id }}">{{ $item->alamat }}</textarea>
                                                    </div>

                                                    {{-- Jenis Kelamin --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Jenis Kelamin</label>
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
                                                    <div class="mb-3">
                                                        <label for="tanggal_lahir_{{ $item->id }}"
                                                            class="form-label">Tanggal Lahir</label>
                                                        <input type="date" class="form-control" name="tanggal_lahir"
                                                            id="tanggal_lahir_{{ $item->id }}"
                                                            value="{{ $item->tanggal_lahir }}">
                                                    </div>

                                                    {{-- Tempat Lahir --}}
                                                    <div class="mb-3">
                                                        <label for="tempat_lahir_{{ $item->id }}"
                                                            class="form-label">Tempat Lahir</label>
                                                        <input type="text" class="form-control" name="tempat_lahir"
                                                            id="tempat_lahir_{{ $item->id }}"
                                                            value="{{ $item->tempat_lahir }}">
                                                    </div>

                                                    {{-- Kategori Kelas --}}
                                                    <div class="mb-3">
                                                        <label for="kategoriKelas_id_{{ $item->id }}"
                                                            class="form-label">Kategori Kelas</label>
                                                        <select name="kategoriKelas_id"
                                                            id="kategoriKelas_id_{{ $item->id }}" class="form-select"
                                                            required>
                                                            <option value="" disabled>-- Pilih Kategori --</option>
                                                            @foreach ($kategori as $kat)
                                                                <option value="{{ $kat->id }}"
                                                                    {{ $item->kategoriKelas_id == $kat->id ? 'selected' : '' }}>
                                                                    {{ $kat->nama_kategori }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {{-- Kelas --}}
                                                    <div class="mb-3">
                                                        <label for="kelas_id_{{ $item->id }}"
                                                            class="form-label">Kelas</label>
                                                        <select name="kelas_id" id="kelas_id_{{ $item->id }}"
                                                            class="form-select" required>
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
                                                    <div class="mb-3">
                                                        <label for="image_{{ $item->id }}" class="form-label">Gambar
                                                            Guru</label>
                                                        <input class="form-control" type="file" name="image"
                                                            id="image_{{ $item->id }}" accept="image/*">
                                                        @if ($item->image && file_exists(public_path('storage/' . $item->image)))
                                                            <div class="mt-2">
                                                                <small class="text-muted">Gambar saat ini:</small><br>
                                                                <img src="{{ asset('storage/' . $item->image) }}"
                                                                    alt="Preview Gambar" style="max-height: 150px;"
                                                                    class="rounded shadow-sm mt-1">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
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

