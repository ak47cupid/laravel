<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PcController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------
------------------------------------------------------------------
*/


// Public routes (no auth)
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

// Protected routes (auth:sanctum)
Route::middleware('auth:sanctum')->group(function () {
    // User routes
    Route::get('/get-users', [UserController::class, 'getUsers']);
    Route::post('/add-user', [UserController::class, 'addUser']);
    Route::put('/edit-user/{id}', [UserController::class, 'editUser']);
    Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);
    Route::post('/logout', [AuthenticationController::class, 'logout']);

    // Transaction routes
    Route::get('/get-loan', [PcController::class, 'getLoan']);
    Route::post('/add-loan', [PcController::class, 'addLoan']);
    Route::put('/edit-loan/{id}', [PcController::class, 'editLoan']);
    Route::delete('/delete-loan/{id}', [PcController::class, 'deleteLoan']);
    
});
