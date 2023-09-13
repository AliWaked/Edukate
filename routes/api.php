<?php

use App\Http\Controllers\Api\AccessTokenController;
use App\Http\Controllers\Api\Front\CategoriesController;
use App\Http\Controllers\Api\Front\CommentController;
use App\Http\Controllers\Api\Front\CoursesController;
use App\Http\Controllers\Api\Front\HomeController;
use App\Http\Controllers\Api\Front\SectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/about', [HomeController::class, 'index']);
Route::get('/courses', [CoursesController::class, 'index']);
Route::get('/courses/sections', [SectionController::class, 'index']);
Route::get('/courses/comments', [CommentController::class, 'index']);
Route::get('/courses/{course}', [CoursesController::class, 'show']);
Route::get('/categories', [CategoriesController::class, 'index']);
Route::post('/categories', [CategoriesController::class, 'store']);
Route::delete('/categories/{category}/destroy', [CategoriesController::class, 'destroy']);
Route::put('/categories/{category}/update', [CategoriesController::class, 'update']);
Route::get('/categories/{category}', [CategoriesController::class, 'show']);

// authentication
Route::post('/auth/access-token', [AccessTokenController::class, 'store']);
Route::delete('/auth/access-token/{token?}', [AccessTokenController::class, 'destroy']);
