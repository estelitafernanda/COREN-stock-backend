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
        'idSector',
        'name',
        'headSector',
    ];

    public function products(){

        return $this->hasMany(Product::class, 'idDepartment', 'id');
    }

    public function listProducts(){
        return $this->products()->get();
    }
    public function users(){

        return $this->hasMany(User::class, 'idSector'); 
    }
    public function targetProducts(){
        return $this->products()
            ->where('currentQuantity', '<', 'minQuantity') 
            ->orWhere('validity', '<', now()) 
            ->get();
    }
}
