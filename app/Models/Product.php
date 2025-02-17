<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'idProduct';
    public $timestamps = true;

    protected $fillable = [
        'idProduct',
        'nameProduct',
        'image',
        'idSector',
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
        return $this->belongsTo(Sector::class, 'idSector', 'idSector');
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'idProduct');
    }

    public function movements()
    {
        return $this->hasMany(Movement::class, 'idProduct', 'code');
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_product', 'product_id', 'supplier_id');
    }
}