<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'tb_konsultasi';
    protected $primaryKey = 'ID';

    protected $fillable = ['kode_indikator', 'jawaban'];
}
