<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    use HasFactory;

    protected $table = 'request';
    protected $primaryKey = 'idRequest';
    public $timestamps = false;

    protected $fillable = [
        'describe',
        'idUser',
        'requestDate',
        'quantity',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'idSupplier', 'idSupplier');
    }
}
