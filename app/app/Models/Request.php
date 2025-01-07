<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    use HasFactory;

    protected $table = 'requests';
    protected $primaryKey = 'idRequest';
    public $timestamps = false;

    protected $fillable = [
        'describe',
        'requestDate',
        'quantity',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'idSupplier', 'idSupplier');
    }
}
