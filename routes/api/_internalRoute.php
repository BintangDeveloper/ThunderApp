<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Helpers\Response\JsonResponseHelper;
use App\Models\BlogPost;
use App\Models\RedirectLinks;

// User Route
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// System Info Route
Route::get('/info', function (Request $request) {
    if (!$request->has('debug')) {
        return JsonResponseHelper::error('Debug parameter is required.', [], 403);
    }

    phpinfo();
    return JsonResponseHelper::success('PHP Info displayed successfully.', 200);
});

// Blog Routes
Route::prefix('/blog')->group(function () {
    // Fetch all blog posts
    Route::get('/posts', function () {
        $posts = BlogPost::all();

        if ($posts->isEmpty()) {
            return JsonResponseHelper::error('No blog posts found.', [], 404);
        }

        return JsonResponseHelper::success($posts, 200);
    });

    // Fetch specific blog posts by ID or name
    Route::get('/post/{id}', function ($id) {
        $posts = BlogPost::where('name', 'like', '%' . $id . '%')
            ->orWhere('id', $id)
            ->limit(10)
            ->get();

        if ($posts->isEmpty()) {
            return JsonResponseHelper::error('No matching blog posts found.', [], 404);
        }

        return JsonResponseHelper::success($posts, 200);
    });
});

Route::prefix('/redirect')->group(function () {
    // Fetch all blog posts
    Route::get('/links', function () {
        $posts = RedirectLinks::all();

        if ($posts->isEmpty()) {
            return JsonResponseHelper::error('No blog posts found.', [], 404);
        }

        return JsonResponseHelper::success($posts, 200);
    });

    // Fetch specific blog posts by ID or name
    Route::get('/link/{id}', function ($id) {
        $posts = RedirectLinks::where('key', 'like', '%' . $id . '%')
            ->orWhere('id', $id)
            ->limit(10)
            ->get();

        if ($posts->isEmpty()) {
            return JsonResponseHelper::error('No matching blog posts found.', [], 404);
        }

        return JsonResponseHelper::success($posts, 200);
    });
});

// Global Error Handling
Route::fallback(function () {
    return JsonResponseHelper::error('Route not found.', [], 404);
});
