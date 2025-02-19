<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Http;

class AuthenticateWithKeycloak
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken(); // PEGA O TOKEN DO CABEÇALHO AUTHORIZATION

        // VALIDA SE EXISTE
        if (!$token) {
            return response()->json(['error' => 'Token não fornecido'], 401);
        }

        try {
            // PEGA A CHAVE PÚBLICA
            $publicKey = $this->getKeycloakPublicKey();
            // DECODIFICANDO O TOKEN
            $decoded = JWT::decode($token, new Key($publicKey, 'RS256'));

            // ADD DADOS DO USUARIO
            $request->attributes->add(['user' => $decoded]);

            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido ou expirado'], 401);
        }
    }

    private function getKeycloakPublicKey(): string
    {
        $keycloakBaseUrl = env('KEYCLOAK_BASE_URL');
        $realm = env('KEYCLOAK_REALM');
    
        $response = Http::get("$keycloakBaseUrl/realms/$realm/protocol/openid-connect/certs");

        if ($response->failed()) {
            throw new \Exception('Erro ao obter a chave pública do Keycloak');
        }
    
        $keys = collect($response->json()['keys'])->firstWhere('use', 'sig')['x5c'][0] ?? null;
    
        if (!$keys) {
            throw new \Exception('Nenhuma chave pública encontrada no Keycloak para assinatura');
        }
    
        return "-----BEGIN CERTIFICATE-----\n" . wordwrap($keys, 64, "\n", true) . "\n-----END CERTIFICATE-----";
    }
}
