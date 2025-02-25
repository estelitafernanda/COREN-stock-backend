<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Firebase\JWT\JWT;
use Firebase\JWT\JWK;
use Exception;
use Illuminate\Support\Facades\Cache;

class AuthenticateWithKeycloak
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->expectsJson()) {
            return response()->json(['error' => 'Apenas requisições JSON são permitidas'], 406);
        }

        $token = $request->bearerToken();
        Log::info('Token recebido: ' . ($token ?? 'Nenhum token recebido'));

        if (!$token) {
            return response()->json(['error' => 'Token não encontrado'], 401);
        }

        try {
            // PEGA A CHAVE PUBLICA E ARMAZENA EM CACHE MELHORANDO A PERFORMANCE
            $keys = Cache::remember('keycloak_jwks', 3600, function () {
                $jwks = file_get_contents('http://localhost:8080/realms/COREN/protocol/openid-connect/certs');
                return $jwks ?: '{}';
            });

            // CONVERSÃO DA CHAVE PARA ARRAY DE ADIÇÃO
            $keys = json_decode($keys, true);

            // CONVERTE PARA TIPOS DE DADOS ACEITOS PELO Firebase JWT
            $parsedKeys = JWK::parseKeySet($keys);

            // DECODIFICAÇÃO DO TOKEN
            $decoded = JWT::decode($token, $parsedKeys);

            // Pegando a role do usuário
            $roles = $decoded->role; 

            // ADIÇÃO DE DADOS DO USUÁRIO
            $request->attributes->set('user', $decoded);
            $request->attributes->set('role', $roles);

            Log::info('Keycloak Authentication');


            return $next($request);
        } catch (Exception $e) {
            Log::error('Erro ao autenticar com Keycloak: ' . $e->getMessage());
            return response()->json(['error' => 'Token inválido ou expirado', 'details' => $e->getMessage()], 401);
        }
    }
}