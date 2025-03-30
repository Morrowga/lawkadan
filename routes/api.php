<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\System\Auth\API\AuthController;
use App\Http\Controllers\System\Post\API\PostController;
use App\Http\Controllers\System\Category\API\CategoryController;
use App\Http\Controllers\System\Location\API\LocationController;
use App\Http\Controllers\System\Announcement\API\AnnouncementController;

Route::prefix('api/sys')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::resource('categories', CategoryController::class)->only(['index']);
        Route::resource('posts', PostController::class)->only(['index', 'store', 'update']);
        Route::post('posts/help-count/{post}', [PostController::class, 'helpCount']);
        Route::get('posts/activities', [PostController::class, 'activities']);
        Route::resource('announcements', AnnouncementController::class)->only(['index', 'store']);
    });

    Route::get('/locations', [LocationController::class, 'getLocations']);
});

