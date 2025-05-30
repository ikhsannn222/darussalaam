<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'kategoriKelas_id',
        'image',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriKelas::class, 'kategoriKelas_id');
    }

    public function guru()
    {
        return $this->hasMany(Guru::class, 'kelas');
    }
}
