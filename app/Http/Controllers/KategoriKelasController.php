<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriKelasController extends Controller
{
    public function index()
    {
        $kategori = DB::table('kategori_kelas')->get();
        return view('kategori_kelas.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori_kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        DB::table('kategori_kelas')->insert([
            'nama_kategori' => $request->nama_kategori,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect()->route('kategori_kelas.index')->with('sweetalert', [
            'title'             => 'Kategori Kelas berhasil ditambahkan!',
            'icon'              => 'success',
            'position'          => 'top-end',
            'showConfirmButton' => false,
            'timer'             => 1500,
        ]);
    }

    public function show(string $id)
    {
        $kategori = DB::table('kategori_kelas')->where('id', $id)->first();
        abort_unless($kategori, 404);

        return view('kategori_kelas.show', compact('kategori'));
    }

    public function edit(string $id)
    {
        $kategori = DB::table('kategori_kelas')->where('id', $id)->first();
        abort_unless($kategori, 404);

        return view('kategori_kelas.edit', compact('kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $affected = DB::table('kategori_kelas')
            ->where('id', $id)
            ->update([
                'nama_kategori' => $request->nama_kategori,
                'updated_at'    => now(),
            ]);

        if (!$affected) {
            abort(404);
        }

        return redirect()->route('kategori_kelas.index')->with('sweetalert', [
            'title'             => 'Kategori Kelas berhasil diperbarui!',
            'icon'              => 'success',
            'position'          => 'top-end',
            'showConfirmButton' => false,
            'timer'             => 1500,
        ]);
    }

    public function destroy(string $id)
    {
        $deleted = DB::table('kategori_kelas')->where('id', $id)->delete();

        if (!$deleted) {
            abort(404);
        }

        return redirect()->back()->with('sweetalert', [
            'title'             => 'Berhasil!',
            'message'           => 'Kategori berhasil dihapus.',
            'icon'              => 'success',
            'timer'             => 1500,
            'showConfirmButton' => false,
        ]);
    }
}
