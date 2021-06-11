<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('users',UserController::class);
Route::resource('products',ProductController::class);
Route::resource('categories',CategoryController::class);
Route::patch('/products/plus_quantity/{id}', [ProductController::class, 'quantityPlus'])->name('product.plus');
Route::patch('/products/minus_quantity/{id}', [ProductController::class, 'quantityMinus'])->name('product.minus');




