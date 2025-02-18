<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierProduct extends Model
{
    use HasFactory;

  
    protected $table = 'supplier_product';
    
    protected $fillable = ['supplier_id', 'product_id'];
}
