<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKelas extends Model
{
    use HasFactory;

    protected $table = 'kategori_kelas';

    protected $fillable = ['nama_kategori'];

     public function kelas()
    {
        return $this->hasMany(Kelas::class, 'kategoriKelas_id');
    }

     public function guru()
    {
        return $this->hasMany(Guru::class, 'kategoriKelas_id');
    }
}
