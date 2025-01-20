<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $primaryKey = 'idSupplier';
    public $timestamps = false;

    protected $fillable = [
        'corporateReason',
        'name',
        'address',
        'contact',
        'telephone',
        'email',
        'responsible',
        'cnpj',
    ];

    public function requests()
    {
        return $this->hasMany(Request::class, 'idSupplier', 'idSupplier');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'supplier_product', 'supplier_id', 'product_id');
    }
}
