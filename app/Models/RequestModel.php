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
        'status',
        'responseData',
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

    public function calcularEstoque(){
        
        if($this->status === "aceito"){
            $product = $this->product;

            if($product){
                return $product->currentQuantity - $this->quantity; 
            }
        }
        return null; 
    }
    public function movement()
    {
        return $this->hasOne(Movement::class, 'idRequest');
    }

    public function criarMovimento(){
        if ($this->movement) {
            return; 
        }

        $movement = new Movement();
        $movement->idProduct = $this->idProduct;
        $movement->quantity = $this->quantity;
        $movement->movementDate = now();
        $movement->idUserRequest = $this->idUser;
        $movement->idUserResponse = $this->
        $movement->idDestinationSector = $this->user->id; 
        $movement->movementStatus = 'em espera'; 
        $movement->save();
    }
}
