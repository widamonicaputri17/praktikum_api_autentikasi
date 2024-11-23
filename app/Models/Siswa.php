<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // Definisikan nama tabel jika berbeda dari konvensi Laravel (opsional)
    protected $table = 'siswas';

    // Tentukan atribut yang dapat diisi melalui mass assignment
    protected $fillable = ['nama', 'kelas', 'umur'];
}
