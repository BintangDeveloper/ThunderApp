<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiToken;
use Carbon\Carbon;
use App\Helpers\Response\JsonResponseHelper;

class ApiTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Retrieve the token from the Authorization header or query string
        $authHeader = $request->header('Authorization');
        $key = $authHeader ? $this->parseTokenFromHeader($authHeader) : $request->query('token');

        if (empty($key)) {
            return $this->errorResponse('API key is missing', 401);
        }

        // Find the token in the database
        $token = ApiToken::where('token', $key)->first();

        if (!$token) {
            return $this->errorResponse('Invalid API key', 403);
        }

        // Check if the token has expired
        if ($token->expires_at) {
            $expiresAt = Carbon::createFromTimestamp($token->expires_at); 
            
            if (Carbon::now()->greaterThan($expiresAt)) {
                return $this->errorResponse('Token has expired', 401); 
            }
        }


        // Optional: Check permissions (uncomment if needed)
        /*
        if ($request->route()->getName() && !in_array($request->route()->getName(), $token->permissions)) {
            return $this->errorResponse('Insufficient permissions', 403);
        }
        */

        // Attach token details to the request for further use
        $request->merge(['api_token' => $token]);

        return $next($request);
    }

    /**
     * Parse the token from the Authorization header.
     *
     * @param string $authHeader
     * @return string|null
     */
    private function parseTokenFromHeader(string $authHeader): ?string
    {
        if (str_starts_with($authHeader, 'Bearer ')) {
            return substr($authHeader, 7);
        }
        return $authHeader;
    }

    /**
     * Generate a standardized error response.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    private function errorResponse(string $message, int $statusCode)
    {
        return JsonResponseHelper::error($message, [], $statusCode);
    }
}
