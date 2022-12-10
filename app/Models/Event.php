<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'tb_event';
    protected $primaryKey = 'id_event';

    protected $fillable = ['nama_event', 'start', 'end'];
}
