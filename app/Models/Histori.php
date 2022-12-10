<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
    use HasFactory;

    const CREATED_AT = 'histori_created_at';

    protected $table = 'tb_histori';
    protected $primaryKey = 'id_histori';

    protected $fillable = ['id_user', 'kode_jenis', 'periode', 'cf', 'kode_solusi', 'detail'];
}
