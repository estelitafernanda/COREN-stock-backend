<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
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
