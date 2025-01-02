<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $table = 'sectors';
    protected $primaryKey = 'idSector';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'headSector',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'idDepartment', 'idSector');
    }
}
