<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'tb_guru';
    protected $primaryKey = 'nip';
    public $incrementing = false;

    protected $fillable = ['nip', 'nama_guru', 'id_user'];
}
