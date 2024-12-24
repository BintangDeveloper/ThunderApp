<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
);

//Route::prefix('database')->group(base_path('routes/api/name.php'));