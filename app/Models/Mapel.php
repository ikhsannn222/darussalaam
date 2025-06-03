<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapels';

    protected $fillable = [
        'nama_mapel',
        'deskripsi',
        'kategoriKelas_id',
        'kelas_id',
        'guru_id',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

     public function kategori()
    {
        return $this->belongsTo(KategoriKelas::class, 'kategoriKelas_id');
    }
}
