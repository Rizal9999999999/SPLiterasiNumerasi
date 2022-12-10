<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;

    protected $table = 'tb_indikator';
    protected $primaryKey = 'kode_indikator';
    public $incrementing = false;

    protected $fillable = ['kode_indikator', 'kode_jenis', 'nama_indikator', 'nilai'];
}
