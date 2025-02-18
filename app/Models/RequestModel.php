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
        'status',
        'responseData',
        'idProduct',
        'quantity',
        'type', 
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'idProduct');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function movement()
    {
        return $this->hasOne(Movement::class, 'idRequest');
    }

    public static function boot()
    {
        parent::boot();
        static::updated(function ($request) {
            if ($request->getOriginal('status') !== 'aceito' && $request->status === 'aceito') {
                $request->criarMovimento();
            }
        });
    }

    public function criarMovimento()
    {
        if ($this->movement()->exists()) {
            return;
        }

        $movement = new Movement();
        $movement->idProduct = $this->idProduct;
        $movement->idResponsible = $this->user->idUser;
        $movement->quantity = $this->quantity;
        $movement->movementDate = now(); 
        $movement->idUserRequest = $this->idUser;
        $movement->idOriginSector = $this->user->sector->idSector;
        $movement->idDestinationSector = $this->user->sector->idSector; 
        $movement->type = $this->type;
        $movement->movementStatus = 'Em Espera';
        $movement->idRequest = $this->idRequest;
        $movement->save();

        $this->sendNotification("Um novo movimento foi criado para a requisição {$this->idRequest}.");
    }   

    public function sendNotification($message){
        Notification::create([
            'message' => $message,
            'idRequest' => $this->idRequest,
        ]);
    }

}