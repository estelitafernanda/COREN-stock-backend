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

            // Converte as chaves para um array associativo
            $keys = json_decode($keys, true);

            // Converte para um formato utilizável pelo Firebase JWT
            $parsedKeys = JWK::parseKeySet($keys);

            // Decodifica o token diretamente sem precisar buscar a chave manualmente
            $decoded = JWT::decode($token, $parsedKeys);

            // Adiciona os dados do usuário na requisição
            $request->attributes->set('user', $decoded);

            return $next($request);
        } catch (Exception $e) {
            Log::error('Erro ao autenticar com Keycloak: ' . $e->getMessage());
            return response()->json(['error' => 'Token inválido ou expirado', 'details' => $e->getMessage()], 401);
        }
    }
}
