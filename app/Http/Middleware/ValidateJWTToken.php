<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateJWTToken
{
    /**
     * The secret key used to encode/decode the JWT token.
     *
     * @var string
     */
    private $secretKey = 'your-secret-key';

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the JWT token is provided in the Authorization header
        if (! $request->header('Authorization')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Extract the token from the Authorization header
        $token = explode(' ', $request->header('Authorization'))[1];

        try {
            // Decode the token and verify its signature
            $decoded = JWT::decode($token, $this->secretKey, ['HS256']);

            // Check if the user has the 'admin' role
            if ($decoded->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // Add the decoded token to the request object for further use
            $request->merge(['decoded_jwt' => $decoded]);

            // Proceed to the next middleware or the controller
            return $next($request);
        } catch (\Exception $e) {
            // If the token is invalid or expired, return an error response
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
