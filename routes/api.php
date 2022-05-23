<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\CategoryController;

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    //User Profile Routes
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::delete('/user/destroy/{id}', [UserController::class, 'destroy']);

    //Post CRUD Routes
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/post/show/{id}', [PostController::class, 'show']);
    Route::post('/post/store', [PostController::class, 'store']);
    Route::post('/post/update/{id}', [PostController::class, 'update']);
    Route::delete('/post/destroy/{id}', [PostController::class, 'destroy']);

    //Tag CRUD Routes
    Route::get('/tags', [TagController::class, 'index']);
    Route::post('/tag/store', [TagController::class, 'store']);
    Route::post('/tag/update/{id}', [TagController::class, 'update']);
    Route::delete('/tag/destroy/{id}', [TagController::class, 'destroy']);

    //Category CRUD Routes
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/category/store', [CategoryController::class, 'store']);
    Route::post('/category/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/destroy/{id}', [CategoryController::class, 'destroy']);


    Route::post('/logout', [AuthController::class, 'logout']);
});
