<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KategoriKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('kategori')->get();
        $kategori = KategoriKelas::all();
        return view('kelas.index', compact('kelas', 'kategori'));
    }

    public function create()
    {
        $kategori = DB::table('kategori_kelas')->get();
        return view('kelas.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas'       => 'required|string|max:255',
            'kategoriKelas_id' => 'required|exists:kategori_kelas,id',
            'image'            => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('kelas', 'public');
        }

        DB::table('kelas')->insert([
            'nama_kelas'       => $request->nama_kelas,
            'kategoriKelas_id' => $request->kategoriKelas_id,
            'image'            => $imagePath,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        return redirect()->route('kelas.index')->with('sweetalert', [
            'title'             => 'Kelas berhasil ditambahkan!',
            'icon'              => 'success',
            'position'          => 'top-end',
            'showConfirmButton' => false,
            'timer'             => 1500,
        ]);
    }

    public function show(string $id)
    {
        $kelas = DB::table('kelas')
            ->join('kategori_kelas', 'kelas.kategoriKelas_id', '=', 'kategori_kelas.id')
            ->select('kelas.*', 'kategori_kelas.nama_kategori as nama_kategori')
            ->where('kelas.id', $id)
            ->first();

        if (! $kelas) {
            abort(404);
        }

        return view('kelas.show', compact('kelas'));
    }

    public function edit(string $id)
    {
        $kelas = DB::table('kelas')->where('id', $id)->first();
        if (! $kelas) {
            abort(404);
        }

        $kategori = DB::table('kategori_kelas')->get();
        return view('kelas.edit', compact('kelas', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas'       => 'required|string|max:255',
            'kategoriKelas_id' => 'required|exists:kategori_kelas,id',
            'image'            => 'nullable|image|max:2048',
        ]);

        $kelas = Kelas::findOrFail($id);

        // Jika ada gambar baru, hapus gambar lama dan upload baru
        if ($request->hasFile('image')) {
            if ($kelas->image && Storage::disk('public')->exists($kelas->image)) {
                Storage::disk('public')->delete($kelas->image);
            }

            $kelas->image = $request->file('image')->store('kelas', 'public');
        }

        $kelas->nama_kelas = $request->nama_kelas;
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

    public function destroy(string $id)
    {
        $kelas = Kelas::find($id);

        if (! $kelas) {
            abort(404);
        }

        if ($kelas->image && Storage::disk('public')->exists($kelas->image)) {
            Storage::disk('public')->delete($kelas->image);
        }

        DB::table('kelas')->where('id', $id)->delete();

        return redirect()->back()->with('sweetalert', [
            'title'             => 'Berhasil!',
            'message'           => 'Kelas berhasil dihapus.',
            'icon'              => 'success',
            'timer'             => 1500,
            'showConfirmButton' => false,
        ]);
    }
}
