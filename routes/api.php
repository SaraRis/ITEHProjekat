<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user_id}', [UserController::class, 'show']);

Route::resource('/posts', PostController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () { //ovo su zasticene rute
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    Route::resource('posts', PostController::class)->only(['update','store','destroy']);

    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout']);
});
//ako je poslat token validan, onda ce moci da se pristupi stranicama na ove 3 rute, a u suprotnom, nece moci da se pristupi

