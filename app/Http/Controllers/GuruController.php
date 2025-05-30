<?php
namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\KategoriKelas;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index()
    {
        $guru     = Guru::with(['kategoriKelas', 'kelas'])->get();
        $kelas    = Kelas::with('kategori')->get();
        $kategori = KategoriKelas::all();
        return view('guru.index', compact('guru', 'kelas', 'kategori'));
    }

    public function create()
    {
        $kategori = KategoriKelas::all();
        $kelas    = Kelas::all();
        return view('guru.create', compact('kategori', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'             => 'required|string|max:255',
            'nip'              => 'nullable|string|unique:guru,nip',
            'email'            => 'required|email|unique:guru,email',
            'no_hp'            => 'nullable|string|max:20',
            'alamat'           => 'nullable|string',
            'jenis_kelamin'    => 'required|in:L,P',
            'tanggal_lahir'    => 'nullable|date',
            'tempat_lahir'     => 'nullable|string|max:255',
            'kategoriKelas_id' => 'required|exists:kategori_kelas,id',
            'kelas_id'         => 'required|exists:kelas,id',
            'image'            => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('guru', 'public');
        }

        Guru::create([
            'nama'             => $request->nama,
            'nip'              => $request->nip,
            'email'            => $request->email,
            'no_hp'            => $request->no_hp,
            'alamat'           => $request->alamat,
            'jenis_kelamin'    => $request->jenis_kelamin,
            'tanggal_lahir'    => $request->tanggal_lahir,
            'tempat_lahir'     => $request->tempat_lahir,
            'kategoriKelas_id' => $request->kategoriKelas_id,
            'kelas_id'         => $request->kelas_id,
            'image'            => $imagePath,
        ]);

        return redirect()->route('guru.index')->with('sweetalert', [
            'title'             => 'Guru berhasil ditambahkan!',
            'icon'              => 'success',
            'position'          => 'top-end',
            'showConfirmButton' => false,
            'timer'             => 1500,
        ]);
    }

    public function show(string $id)
    {
        $guru = Guru::with(['kategoriKelas', 'kelas'])->find($id);

        if (! $guru) {
            abort(404);
        }

        return view('guru.show', compact('guru'));
    }

    public function edit(string $id)
    {
        $guru = Guru::find($id);
        if (! $guru) {
            abort(404);
        }

        $kategori = KategoriKelas::all();
        $kelas    = Kelas::all();

        return view('guru.edit', compact('guru', 'kategori', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nama'             => 'required|string|max:255',
            'nip'              => 'nullable|string|unique:guru,nip,' . $id,
            'email'            => 'required|email|unique:guru,email,' . $id,
            'no_hp'            => 'nullable|string|max:20',
            'alamat'           => 'nullable|string',
            'jenis_kelamin'    => 'required|in:L,P',
            'tanggal_lahir'    => 'nullable|date',
            'tempat_lahir'     => 'nullable|string|max:255',
            'kategoriKelas_id' => 'required|exists:kategori_kelas,id',
            'kelas_id'         => 'required|exists:kelas,id',
            'image'            => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($guru->image && Storage::disk('public')->exists($guru->image)) {
                Storage::disk('public')->delete($guru->image);
            }
            $guru->image = $request->file('image')->store('guru', 'public');
        }

        $guru->nama             = $request->nama;
        $guru->nip              = $request->nip;
        $guru->email            = $request->email;
        $guru->no_hp            = $request->no_hp;
        $guru->alamat           = $request->alamat;
        $guru->jenis_kelamin    = $request->jenis_kelamin;
        $guru->tanggal_lahir    = $request->tanggal_lahir;
        $guru->tempat_lahir     = $request->tempat_lahir;
        $guru->kategoriKelas_id = $request->kategoriKelas_id;
        $guru->kelas_id         = $request->kelas_id; // <- Pastikan pakai 'kelas_id' sesuai name di form

        $guru->save();

        return redirect()->route('guru.index')->with('sweetalert', [
            'title'             => 'Guru berhasil diperbarui!',
            'icon'              => 'success',
            'position'          => 'top-end',
            'showConfirmButton' => false,
            'timer'             => 1500,
        ]);
    }

    public function destroy(string $id)
    {
        $guru = Guru::find($id);

        if (! $guru) {
            abort(404);
        }

        if ($guru->image && Storage::disk('public')->exists($guru->image)) {
            Storage::disk('public')->delete($guru->image);
        }

        $guru->delete();

        return redirect()->back()->with('sweetalert', [
            'title'             => 'Berhasil!',
            'message'           => 'Guru berhasil dihapus.',
            'icon'              => 'success',
            'timer'             => 1500,
            'showConfirmButton' => false,
        ]);
    }
}
