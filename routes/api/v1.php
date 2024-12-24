<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\v1\StorageController;

Route::prefix('storage')
  ->controller(StorageController::class)
  ->group(function () {
    
    Route::get(
      '/list', 'listBucket'
    );
    
    Route::get(
      '/{BUCKET_ID}/list', 'listFiles'
    );
    
    Route::get(
      '/{BUCKET_ID}/info/{FILE_ID}', 'getFileInfo'
    );
    
    Route::get(
      '/{BUCKET_ID}/download/{FILE_ID}', 'getFileDownload'
    );
    
    Route::get(
      '/{BUCKET_ID}/view/{FILE_ID}', 'getFileView'
    );
    
    Route::get(
      '/{BUCKET_ID}/preview/{FILE_ID}', 'getFilePreview'
    );
    
    Route::post(
      '/{BUCKET_ID}/upload', 'uploadFile'
    );
});