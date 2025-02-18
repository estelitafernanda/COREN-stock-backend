<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'idUser';
    public $timestamps = true;

    protected $fillable = [
        'nameUser',
        'idSector',
        'email',
        'role',
        'password',

    ];

    public function movements()
    {
        return $this->hasMany(Movement::class, 'idUserRequest', 'idUser');
    }
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'idSector'); 
    }
}
