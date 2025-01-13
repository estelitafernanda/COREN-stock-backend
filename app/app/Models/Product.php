<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
<<<<<<< HEAD
    protected $primaryKey = 'code';
    public $timestamps = false;

    protected $fillable = [
        'nameProduct',
        'idDepartment',
        'describe',
=======
    protected $primaryKey = 'idProduct';
    public $timestamps = false;

    protected $fillable = [
        'idProduct',
        'nameProduct',
        'image',
        'idDepartment',
        'code',
        'describe',
        'category',
>>>>>>> 7203ce1aa315dcb84ce7fe741d69c3138bd2e9ec
        'minQuantity',
        'currentQuantity',
        'location',
        'validity',
        'unitPrice',
    ];

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'idDepartment', 'idSector');
    }

    public function movements()
    {
        return $this->hasMany(Movement::class, 'idProduct', 'code');
    }
}
