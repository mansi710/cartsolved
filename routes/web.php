<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\extraController;
use App\Http\Controllers\productController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('users',[extraController::class,'index'])->name('data');

Route::get('productAdd',[productController::class,'index'])->name('productAdd');
Route::get('add/carts',[productController::class,'store_cart'])->name('add.carts');
Route::get('show/carts',[productController::class,'show_carts'])->name('show.carts');
Route::get('order/checkout',[productController::class,'checkout'])->name('order.checkout');
Route::get('remove/carts',[productController::class,'remove_cart'])->name('remove.carts');


require __DIR__.'/auth.php';
