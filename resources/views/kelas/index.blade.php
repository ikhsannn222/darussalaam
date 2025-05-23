@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body p-0">

            {{-- Header dan tombol tambah --}}
            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                <h5 class="mb-0">Daftar Kelas</h5>
                <a href="#" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="fas fa-plus me-1"></i> Kelas
                </a>
            </div>

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Kelas</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_kelas }}</td>
                                <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{ $item->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item->id }}">
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
                                                    onclick="confirmDelete({{ $item->id }})">
                                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                                </button>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('kelas.destroy', $item->id) }}" method="POST"
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
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Kelas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Nama Kelas:</strong> {{ $item->nama_kelas }}</p>
                                            <p><strong>Kategori:</strong> {{ $item->kategori->nama_kategori ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Edit --}}
                            <div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('kelas.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Kelas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nama_kelas_{{ $item->id }}" class="form-label">Nama Kelas</label>
                                                    <input type="text" class="form-control" name="nama_kelas"
                                                        id="nama_kelas_{{ $item->id }}" value="{{ $item->nama_kelas }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kategoriKelas_id_{{ $item->id }}" class="form-label">Kategori</label>
                                                    <select name="kategoriKelas_id" id="kategoriKelas_id_{{ $item->id }}"
                                                        class="form-select" required>
                                                        @foreach ($kategori as $kat)
                                                            <option value="{{ $kat->id }}"
                                                                {{ $item->kategoriKelas_id == $kat->id ? 'selected' : '' }}>
                                                                {{ $kat->nama_kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
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
@include('kelas.create', ['kategori' => $kategori])

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
