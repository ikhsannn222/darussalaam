@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body p-0">

            {{-- Header dan tombol tambah --}}
            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                <h5 class="mb-0">Daftar Mata Pelajaran</h5>
                <a href="#" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="fas fa-plus me-1"></i> Mapel
                </a>
            </div>

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Mapel</th>
                            <th>Deskripsi</th>
                            <th>Kategori Kelas</th> {{-- Tambahan kolom --}}
                            <th>Kelas</th>
                            <th>Guru</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mapel as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_mapel }}</td>
                                <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                                <td>{{ $item->kategori->nama_kategori ?? '-' }}</td> {{-- Tampilkan kategori --}}
                                <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $item->guru->nama ?? '-' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#showModal-{{ $item->id }}">
                                                    <i class="fas fa-eye me-1"></i> Lihat
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal-{{ $item->id }}">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-danger" onclick="confirmDelete({{ $item->id }})">
                                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                                </button>
                                                <form id="delete-form-{{ $item->id }}" action="{{ route('mapel.destroy', $item->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal Show --}}
                            <div class="modal fade" id="showModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Mapel</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Nama Mapel:</strong> {{ $item->nama_mapel }}</p>
                                            <p><strong>Deskripsi:</strong> {{ $item->deskripsi }}</p>
                                            <p><strong>Kategori Kelas:</strong> {{ $item->kategori->nama_kategori ?? '-' }}</p> {{-- Tampilkan kategori --}}
                                            <p><strong>Kelas:</strong> {{ $item->kelas->nama_kelas ?? '-' }}</p>
                                            <p><strong>Guru:</strong> {{ $item->guru->nama ?? '-' }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Edit --}}
                            <div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('mapel.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Mapel</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Mapel</label>
                                                    <input type="text" name="nama_mapel" class="form-control" value="{{ $item->nama_mapel }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control" rows="3">{{ $item->deskripsi }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Kategori Kelas</label>
                                                    <select name="kategoriKelas_id" class="form-select" required>
                                                        <option value="">-- Pilih Kategori Kelas --</option>
                                                        @foreach ($kategori as $kat)
                                                            <option value="{{ $kat->id }}" {{ $item->kategoriKelas_id == $kat->id ? 'selected' : '' }}>
                                                                {{ $kat->nama_kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Kelas</label>
                                                    <select name="kelas_id" class="form-select" required>
                                                        <option value="">-- Pilih Kelas --</option>
                                                        @foreach ($kelas as $k)
                                                            <option value="{{ $k->id }}" {{ $item->kelas_id == $k->id ? 'selected' : '' }}>
                                                                {{ $k->nama_kelas }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Guru</label>
                                                    <select name="guru_id" class="form-select" required>
                                                        <option value="">-- Pilih Guru --</option>
                                                        @foreach ($guru as $g)
                                                            <option value="{{ $g->id }}" {{ $item->guru_id == $g->id ? 'selected' : '' }}>
                                                                {{ $g->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button class="btn btn-primary" type="submit">Update</button>
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

{{-- Modal Tambah --}}
@include('mapel.create', ['kelas' => $kelas, 'guru' => $guru, 'kategori' => $kategori])

{{-- Sweetalert --}}
@if (session('sweetalert'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Yakin ingin menghapus?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
