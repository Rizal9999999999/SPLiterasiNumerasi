<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_user', 'email', 'username', 'tanggal_lahir', 'umur', 'jk', 'password', 'level', 'status_user', 'foto', 'jabatan', 'alamat', 'no_ptuk', 'nama_sekolah',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function image()
    {
        if ($this->foto && file_exists(public_path('images/user/' . $this->foto)))
            return asset('images/user/' . $this->foto);
        else
            return asset('images/no_image.png');
    }

    function delete_image()
    {
        if ($this->foto && file_exists(public_path('images/user/' . $this->foto)))
            return unlink(public_path('images/user/' . $this->foto));
    }
}
