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
    
        public function userRequest()
        {
            return $this->belongsTo(User::class, 'idUserRequest', 'idUser');
        }
    
        public function userResponse()
        {
            return $this->belongsTo(User::class, 'idUserResponse', 'idUser');
        }
    
        public function originSector()
        {
            return $this->belongsTo(Sector::class, 'idOriginSector', 'idSector');
        }
    
        public function destinationSector()
        {
            return $this->belongsTo(Sector::class, 'idDestinationSector', 'idSector');
        }
    
        public function request()
        {
            return $this->belongsTo(RequestModel::class, 'idRequest', 'idRequest');
        }

        public function atualizarQuantidadeProduto()
        {
            if ($this->movementStatus === 'entregue') {
                $produto = $this->product;
                $produto->currentQuantity -= $this->quantity;
                $produto->save();
            }
        }


    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'idProduct', 'idProduct');
    // }
    
    // public function responsible()
    // {
    //     return $this->belongsTo(User::class, 'idResponsible', 'idUser');
    // }

    // public function originSector()
    // {
    //     return $this->belongsTo(Sector::class, 'idOriginSector', 'idSector');
    // }

    // public function destinationSector()
    // {
    //     return $this->belongsTo(Sector::class, 'idDestinationSector', 'idSector');
    // }
    // public function atualizarStatusMovimento($status)
    // {
    //     if ($status === 'aceito') {
    //         $this->movementStatus = 'aceito';
    //     } elseif ($status === 'negado') {
    //         $this->movementStatus = 'negado';
    //     } elseif ($status === 'em espera') {
    //         $this->movementStatus = 'em espera';
    //     }

    //     $this->save();
    // }
}
