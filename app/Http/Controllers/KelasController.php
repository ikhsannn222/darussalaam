<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KategoriKelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $kelas = Kelas::with('kategori')->get(); // Ambil semua data kelas dengan relasi kategori
    $kategori = KategoriKelas::all();        // Ambil semua kategori untuk dropdown/form

    return view('kelas.index', compact('kelas', 'kategori'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriKelas::all();
        return view('kelas.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas'        => 'required|string|max:255',
            'kategoriKelas_id'  => 'required|exists:kategori_kelas,id',
        ]);

        Kelas::create([
            'nama_kelas'       => $request->nama_kelas,
            'kategoriKelas_id' => $request->kategoriKelas_id,
        ]);

        return redirect()->route('kelas.index')->with('sweetalert', [
            'title'             => 'Kelas berhasil ditambahkan!',
            'icon'              => 'success',
            'position'          => 'top-end',
            'showConfirmButton' => false,
            'timer'             => 1500,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Kelas::with('kategori')->findOrFail($id);
        return view('kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kategori = KategoriKelas::all();
        return view('kelas.edit', compact('kelas', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas'        => 'required|string|max:255',
            'kategoriKelas_id'  => 'required|exists:kategori_kelas,id',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->nama_kelas       = $request->nama_kelas;
        $kelas->kategoriKelas_id = $request->kategoriKelas_id;
        $kelas->save();

        return redirect()->route('kelas.index')->with('sweetalert', [
            'title'             => 'Kelas berhasil diperbarui!',
            'icon'              => 'success',
            'position'          => 'top-end',
            'showConfirmButton' => false,
            'timer'             => 1500,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->back()->with('sweetalert', [
            'title'             => 'Berhasil!',
            'message'           => 'Kelas berhasil dihapus.',
            'icon'              => 'success',
            'timer'             => 1500,
            'showConfirmButton' => false,
        ]);
    }
}
