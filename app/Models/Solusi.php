<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solusi extends Model
{
    use HasFactory;

    protected $table = 'tb_solusi';
    protected $primaryKey = 'kode_solusi';
    public $incrementing = false;

    protected $fillable = ['kode_solusi', 'nama_solusi', 'detail_solusi', 'min_nilai', 'max_nilai', 'warna'];
}
