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

            $keys = Cache::remember('keycloak_jwks', 3600, function () {

                $jwks = json_decode(file_get_contents('http://localhost:8080/realms/COREN/protocol/openid-connect/certs'), true);
                return json_encode($jwks);
            });

            $keys = json_decode($keys, true);
            $parsedKeys = JWK::parseKeySet($keys);

            $header = JWT::decode($token, null, false);
            $key = null;

            foreach ($parsedKeys as $parsedKey) {
                if ($parsedKey['kid'] === $header->kid) {
                    $key = $parsedKey;
                    break;
                }
            }

            if (!$key) {
                return response()->json(['error' => 'Chave pública não encontrada'], 401);
            }

            $decoded = JWT::decode($token, $key, ['RS256']);

            $request->attributes->set('user', $decoded);

            return $next($request);
        } catch (Exception $e) {
            Log::error('Erro ao autenticar com Keycloak: ' . $e->getMessage());
            return response()->json(['error' => 'Token inválido ou expirado', 'details' => $e->getMessage()], 401);
        }
    }
}
