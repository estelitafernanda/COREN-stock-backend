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
        'idSupplier',
        'corporateReason',
        'name',
        'address',
        'contact',
    ];

    public function requests()
    {
        return $this->hasMany(Request::class, 'idSupplier', 'idSupplier');
    }
}
