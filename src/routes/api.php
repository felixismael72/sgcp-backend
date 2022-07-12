<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/", function () {
    return phpinfo();
});

Route::get('/post/{postID}', [PostController::class, 'getByID']);

Route::get('/post', [PostController::class, 'get']);

Route::post('/post/new', [PostController::class, 'post']);

Route::put('/post/{postID}/edit', [PostController::class, 'put']);

Route:: delete('/post/{postID}/remove', [PostController::class, 'delete']);