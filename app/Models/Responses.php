<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $table = 'responses';
    protected $primaryKey = 'idResponse';
    public $timestamps = false;

    protected $fillable = [
        'response',
    ];

    public function movements()
    {
        return $this->hasMany(Movement::class, 'idResponse', 'idResponse');
    }
}
