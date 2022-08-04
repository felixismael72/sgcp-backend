<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\PsychologistMiddleware;
use App\Http\Middleware\PatientMiddleware;
use App\Http\Middleware\AuthenticatedMiddleware;


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

Route::post("/register", [AuthController::class, 'register']);
Route::post("/login", [AuthController::class, 'login']);

Route::get('/post/{postID}', [PostController::class, 'fetchByID']);
Route::get('/post', [PostController::class, 'fetchAll']);

Route::middleware([PsychologistMiddleware::class])->group(function () {
    Route::post('/post/new', [PostController::class, 'create']);
    Route::put('/post/{postID}/edit', [PostController::class, 'edit']);
    Route::delete('/post/{postID}/remove', [PostController::class, 'remove']);
    
    Route::post('/schedule/new', [ScheduleController::class, 'create']); 
    Route::put('/schedule/{scheduleID}/edit', [ScheduleController::class, 'edit']);
    Route::delete('/schedule/{scheduleID}/remove', [ScheduleController::class, 'remove']);

    Route::patch('/appointment/{appointmentID}/finish', [AppointmentController::class, 'markAsDone']);
});

Route::middleware([PatientMiddleware::class])->group(function () {
    Route::post('/appointment/new', [AppointmentController::class, 'create']);
    Route::get('/appointment/mine', [AppointmentController::class, 'fetchByPatientID']);
    Route::put('/appointment/{appointmentID}/edit', [AppointmentController::class, 'edit']);
});

Route::middleware([AuthenticatedMiddleware::class])->group(function () {
    Route::get('/schedule/{scheduleID}', [ScheduleController::class, 'fetchByID']);
    Route::get('/schedule', [ScheduleController::class, 'fetchAll']);
    
    Route::get('/appointment', [AppointmentController::class, 'fetchAllActive']);
    Route::get('/appointment/finished', [AppointmentController::class, 'fetchAllFinished']);
    Route::get('/appointment/inactive', [AppointmentController::class, 'fetchAllInactive']);
    Route::get('/appointment/{appointmentID}', [AppointmentController::class, 'fetchByID']);
    Route::patch('/appointment/{appointmentID}/cancel', [AppointmentController::class, 'cancel']);
    Route::delete('/appointment/{appointmentID}/remove', [AppointmentController::class, 'remove']);

    Route::get('/refresh', [AuthController::class, 'refresh']);
    Route::patch('/logout', [AuthController::class, 'logout']);
});