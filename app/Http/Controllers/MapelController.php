<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KategoriKelas; // Tambahkan ini
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = Mapel::with(['guru', 'kelas', 'kategori'])->get();
        $guru  = Guru::all();
        $kelas = Kelas::all();
        $kategori = KategoriKelas::all(); // Tambahkan ini

        return view('mapel.index', compact('mapel', 'guru', 'kelas', 'kategori'));
    }

    public function create()
    {
        $guru = Guru::all();
        $kelas = Kelas::all();
        $kategori = KategoriKelas::all(); // Tambahkan ini

        return view('mapel.create', compact('guru', 'kelas', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel'        => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'kategoriKelas_id'  => 'required|exists:kategori_kelas,id',
            'kelas_id'          => 'required|exists:kelas,id',
            'guru_id'           => 'required|exists:guru,id',
        ]);

        Mapel::create($request->all());

        return redirect()->route('mapel.index')->with('sweetalert', [
            'title'             => 'Mata pelajaran berhasil ditambahkan!',
            'icon'              => 'success',
            'position'          => 'top-end',
            'showConfirmButton' => false,
            'timer'             => 1500,
        ]);
    }

    public function show(string $id)
    {
        $mapel = Mapel::with(['guru', 'kelas', 'kategori'])->find($id);

        if (! $mapel) {
            abort(404);
        }

        return view('mapel.show', compact('mapel'));
    }

    public function edit(string $id)
    {
        $mapel = Mapel::find($id);
        if (! $mapel) {
            abort(404);
        }

        $guru = Guru::all();
        $kelas = Kelas::all();
        $kategori = KategoriKelas::all(); // Tambahkan ini

        return view('mapel.edit', compact('mapel', 'guru', 'kelas', 'kategori'));
    }

    public function update(Request $request, string $id)
    {
        $mapel = Mapel::findOrFail($id);

        $request->validate([
            'nama_mapel'        => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'kategoriKelas_id'  => 'required|exists:kategori_kelas,id',
            'kelas_id'          => 'required|exists:kelas,id',
            'guru_id'           => 'required|exists:gurus,id',
        ]);

        $mapel->update($request->all());

        return redirect()->route('mapel.index')->with('sweetalert', [
            'title'             => 'Mata pelajaran berhasil diperbarui!',
            'icon'              => 'success',
            'position'          => 'top-end',
            'showConfirmButton' => false,
            'timer'             => 1500,
        ]);
    }

    public function destroy(string $id)
    {
        $mapel = Mapel::find($id);

        if (! $mapel) {
            abort(404);
        }

        $mapel->delete();

        return redirect()->back()->with('sweetalert', [
            'title'             => 'Berhasil!',
            'message'           => 'Mata pelajaran berhasil dihapus.',
            'icon'              => 'success',
            'timer'             => 1500,
            'showConfirmButton' => false,
        ]);
    }
}
