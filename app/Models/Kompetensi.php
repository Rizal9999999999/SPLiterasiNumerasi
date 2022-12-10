<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kompetensi extends Model
{
    use HasFactory;

    protected $table = 'tb_kompetensi';
    protected $primaryKey = 'kode_kompetensi';
    public $incrementing = false;

    protected $fillable = ['kode_kompetensi', 'kode_jenis', 'nama_kompetensi'];
}
