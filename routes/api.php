<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

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

Route::get("/posts", [ PostController::class, 'index'])->middleware('auth:sanctum');
Route::get("/posts/{postId}", [ PostController::class, 'show'])->middleware('auth:sanctum');
Route::post("/posts", [ PostController::class, 'store']);
Route::put("/posts/{postId}", [ PostController::class, 'update']);
Route::delete("/posts/{postId}", [ PostController::class, 'destroy']);

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/register', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);