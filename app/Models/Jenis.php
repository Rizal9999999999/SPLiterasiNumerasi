<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;

    protected $table = 'tb_jenis';
    protected $primaryKey = 'kode_jenis';
    public $incrementing = false;

    protected $fillable = ['kode_jenis', 'nama_jenis'];
}