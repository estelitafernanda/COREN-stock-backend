<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierProduct extends Model
{
    use HasFactory;

    // A tabela `supplier_product` já está automaticamente associada ao modelo
    protected $table = 'supplier_product';
    
    // Defina os campos que podem ser atribuídos em massa
    protected $fillable = ['supplier_id', 'product_id'];
}
