<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\AuthController;


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

Route::post("/register", [AuthController::class, 'register']);
Route::post("/login", [AuthController::class, 'login']);

Route::get('/post/{postID}', [PostController::class, 'getByID']);
Route::get('/post', [PostController::class, 'get']);
Route::post('/post/new', [PostController::class, 'post']);
Route::put('/post/{postID}/edit', [PostController::class, 'put']);
Route::delete('/post/{postID}/remove', [PostController::class, 'delete']);

Route::get('/schedule/{scheduleID}', [ScheduleController::class, 'getByID']);
Route::get('/schedule', [ScheduleController::class, 'get']);
Route::post('/schedule/new', [ScheduleController::class, 'post']); 
Route::put('/schedule/{scheduleID}/edit', [ScheduleController::class, 'put']);
Route::delete('/schedule/{scheduleID}/remove', [ScheduleController::class, 'delete']);

Route::get('/specialty/{specialtyID}', [SpecialtyController::class, 'getByID']);
Route::get('/specialty', [SpecialtyController::class, 'get']);
Route::post('/specialty/new', [SpecialtyController::class, 'post']); 
Route::put('/specialty/{specialtyID}/edit', [SpecialtyController::class, 'put']);
Route::delete('/specialty/{specialtyID}/remove', [SpecialtyController::class, 'delete']);