<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    use HasFactory;

    protected $table = 'request';
    protected $primaryKey = 'idRequest';
    public $timestamps = true;

    protected $fillable = [
        'describe',
        'idUser',
        'idProduct',
        'requestDate',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'idProduct');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    // public function supplier()
    // {
    //     return $this->belongsTo(Supplier::class, 'idSupplier', 'idSupplier');
    // }
}
