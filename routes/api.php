<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiTokenMiddleware;
use App\Helpers\Response\JsonResponseHelper;

/* Unused
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
*/

Route::prefix('_internal')->group(
  base_path('routes/api/_internalRoute.php')
);

Route::prefix('v1')->group(
  base_path('routes/api/v1.php')
)->middleware(ApiTokenMiddleware::class);

Route::fallback(function () {
    $currentRoute = request()->path(); // Get the current requested endpoint
    $method = request()->method(); // Get the HTTP method (GET, POST, etc.)
    
    return JsonResponseHelper::error(
        'Endpoint not found.',
        [
          [
            'message' => 'The requested endpoint does not exist on this server.',
            'endpoint' => $currentRoute,
            'method' => $method,
            'suggestion' => 'Check the API documentation for available endpoints or verify the URL and HTTP method.'
          ], 
          [ random_int(8, 99) . '2zxGBhtxdx' => md5(now()) . ":" . md5('me?') ]
        ],
        404
    );
});


//Route::prefix('database')->group(base_path('routes/api/name.php'));