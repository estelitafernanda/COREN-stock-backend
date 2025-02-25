<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        
        $user = $request->attributes->get('role');

        
        if (!in_array($user, $roles)) {
            return response()->json(['error' => 'Acesso negado. Permissão insuficiente'], 403);
        }
    
        return $next($request);
    }
}
