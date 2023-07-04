<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;


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

Route::get('/', function () {
	// return Hash::make('12345678');
    return ProductController::class;
});

Route::prefix("admin")->group(function() {
Route::get('/greeting', [ProductController::class, 'index']);

Route::get('/new-greet', ["App\Http\Controllers\ProductController", 'index']);
Route::get('/product/{name}', [ProductController::class, 'show'])->name('product.show');
});

Route::get('/greeting/{name}', [ProductController::class, 'greet']);


Route::namespace('Admin')->group(function () {
    Route::get('/dashboard', function () {
        return 'Admin Dashboard';
    });
});

Route::get("/about", function() {
	return "About";
});

// Route::get('/login', [AuthController::class, 'index'])->name('login2');


