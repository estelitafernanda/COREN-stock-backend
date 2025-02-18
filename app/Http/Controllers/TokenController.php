<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Middleware\AuthenticateWithKeycloak;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;

class TokenController extends Controller
{

    public function redirect(){
        return Socialite::driver('keycloak')->redirect();
    }

    public function callback(){
        $user = Socialite::driver('keycloak')->user();
        dd($user);
    }

    
    public function showTokenForm()
    {
        return view('token-insert');
    }

    public function validateToken(Request $request)
    {
        $token = $request->input('token');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('http://127.0.0.1:8000/showDepartments');

        if ($response->successful()) {
            return redirect()->route('token.form')->with('success', 'Token validado com sucesso!');
        } else {
            return redirect()->route('token.form')->with('error', 'Token inválido.');
        }
    }

}
