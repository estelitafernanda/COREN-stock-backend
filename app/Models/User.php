<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'idUser';
    public $timestamps = true;

    protected $fillable = [
        'nameUser',
        'idSector',
        'email',
        'role',
        'unity',
        'password',

    ];

    public static function fetchFromKeycloak(){

        $tokenResponse = Http::asForm()->post('http://localhost:8080/realms/COREN/protocol/openid-connect/token', [
            'client_id' => 'COREN-stock-backend',
            'username' => 'augusto',
            'password' => '1234',
            'grant_type' => 'password',
            'client_secret' => '9NAXkeIszHqZYrfjw7GeFSOM7ye5zW8A',
        ]);
    
        if ($tokenResponse->successful()) {
            $token = $tokenResponse->json()['access_token'];
    
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('http://localhost:8080/admin/realms/COREN/users');

            dd($response->json());
    
            if ($response->successful()) {
                return collect($response->json())->map(function ($user) {
                    return [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $user['attributes']['role'][0],
                        'unity' => $user['attributes']['unity'][0] ,
                    ];
                })->toArray();
            }
        }
    
        return null;
    }

    public function movements()
    {
        return $this->hasMany(Movement::class, 'idUserRequest', 'idUser');
    }
    public function sector()
    {
        return $this->belongsTo(Sector::class, 'idSector'); 
    }
}