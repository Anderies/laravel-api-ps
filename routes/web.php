<?php

use App\Http\Controllers\Api\BankUser;
use App\Http\Controllers\Api\BankUserController;
use App\Http\Controllers\PassportAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routes
Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [PassportAuthController::class, 'register']);
Route::post('/login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(function() {
    Route::get('/bankuser', [BankUserController::class, 'index']);
    Route::post('/bankuser', [BankUserController::class, 'store']);
    Route::put('/bankuser/{id}', [BankUserController::class, 'update']);
    Route::delete('/bankuser/{id}', [BankUserController::class, 'destroy']);
});

Route::get('/hello', function () {
    return '<h1>hello</h1>';
});

