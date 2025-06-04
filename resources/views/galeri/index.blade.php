@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body p-0">

                {{-- Header dan tombol tambah --}}
                <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                    <h5 class="mb-0">Galeri</h5>
                    <a href="#" class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fas fa-plus me-1"></i> Tambah Gambar
                    </a>
                </div>

                {{-- Grid Galeri --}}
                <div class="row p-3">
                    @foreach ($galeri as $item)
                        <div class="col-6 col-md-3 mb-4">
                            <div class="card shadow-sm">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $item->id }}">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="gambar"
                                        class="card-img-top img-thumbnail" style="height: 180px; object-fit: cover;">
                                </a>
                                <div class="card-body pt-2 pb-1 text-center">
                                    <h6 class="fw-bold mb-1">{{ $item->judul }}</h6>
                                    <p class="text-muted small mb-2" style="min-height: 40px;">{{ $item->deskripsi }}</p>

                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-warning dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{ $item->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item->id }}">
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
                                                        action="{{ route('galeri.destroy', $item->id) }}" method="POST"
                                                        class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Edit --}}
                        <div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('galeri.update', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Galeri</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="judul" class="form-label">Judul</label>
                                                <input type="text" class="form-control" name="judul"
                                                    value="{{ $item->judul }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <textarea class="form-control" name="deskripsi" rows="3" required>{{ $item->deskripsi }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Ganti Gambar</label>
                                                <input type="file" class="form-control" name="image" accept="image/*">
                                                <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Modal Gambar Besar --}}
                        @if ($item->image && file_exists(public_path('storage/' . $item->image)))
                            <div class="modal fade" id="imageModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content bg-transparent border-0">
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="Gambar Galeri"
                                                class="rounded shadow" style="max-height: 400px; width: auto; max-width: 100%;">
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    @include('galeri.create')

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
