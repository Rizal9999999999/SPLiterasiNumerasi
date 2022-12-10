<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'tb_siswa';
    protected $primaryKey = 'nisn';
    public $incrementing = false;

    protected $fillable = ['nisn', 'kode_kelas', 'nama_siswa', 'status_siswa', 'id_user'];
}
