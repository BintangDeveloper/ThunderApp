<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Helpers\Response\JsonResponseHelper;
use App\Models\BlogPost;
  
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
  
Route::get('/info', function (Request $request) {
  if (!$request->has('debug')) {
    return JsonResponseHelper::error('false', [], 403);
  }

  phpinfo();

  return JsonResponseHelper::success('true', 200);
});
  
Route::get('/blog/posts', function (Request $request) {
  return JsonResponseHelper::success(BlogPost::all(), 200);
});
  
Route::get('/blog/post/{ID}', function (Request $request, $ID) {
  return JsonResponseHelper::success(
    BlogPost::where('name', 'like', '%' . $ID . '%')
                    ->orWhere('id', $ID)
                    ->limit(10)
                    ->get()
                    
  );
}); 

Route::delete('/blog/post/{ID}', function (Request $request) {
  
}); 

Route::post('/blog/new', function (Request $request) {
  
}); 
  