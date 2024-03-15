<?php

use App\Http\Controllers\Api\BankUser;
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

Route::get('/bankuser', [BankUser::class, 'index']);
Route::post('/bankuser', [BankUser::class, 'store']);
Route::put('/bankuser/{id}', [BankUser::class, 'update']);

Route::get('/hello', function () {
    return '<h1>hello</h1>';
});

