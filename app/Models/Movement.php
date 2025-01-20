<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $table = 'movements';
    protected $primaryKey = 'idMovement';
    public $timestamps = false;

    protected $fillable = [
        'idProduct',
        'quantity',
        'movementDate',
        'idUserRequest',
        'idUserResponse', 
        'idOriginSector',
        'idDestinationSector',
        'idRequest',
        'movementStatus',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'idProduct', 'idProduct');
    }
    
    public function responsible()
    {
        return $this->belongsTo(User::class, 'idResponsible', 'idUser');
    }

    public function originSector()
    {
        return $this->belongsTo(Sector::class, 'idOriginSector', 'idSector');
    }

    public function destinationSector()
    {
        return $this->belongsTo(Sector::class, 'idDestinationSector', 'idSector');
    }
    public function atualizarStatusMovimento($status)
    {
        if ($status === 'aceito') {
            $this->movementStatus = 'aceito';
        } elseif ($statusPedido === 'negado') {
            $this->movementStatus = 'negado';
        } elseif ($status === 'em espera') {
            $this->movementStatus = 'em espera';
        }

        $this->save();
    }
}
