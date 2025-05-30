<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';

    protected $fillable = [
        'nama',
        'nip',
        'email',
        'no_hp',
        'alamat',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'kategoriKelas_id',
        'kelas_id',
        'image',
    ];

    // Contoh relasi jika kamu punya model KategoriKelas dan Kelas
    public function kategoriKelas()
    {
        return $this->belongsTo(KategoriKelas::class, 'kategoriKelas_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
