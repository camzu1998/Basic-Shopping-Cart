<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\CartController;

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

//Product URIs
Route::get('/products', [ProductController::class, 'index']); //list all products in the catalog as a paginated list with at most 3 products per page

Route::get('/product', [ProductController::class, 'create']); //form to add product to the catalog
Route::post('/product', [ProductController::class, 'store']); //add product to the catalog

Route::get('/product/{product_id}', [ProductController::class, 'edit']); //form to update product name / update product price
Route::put('/product/{product_id}', [ProductController::class, 'update']); //update product name / update product price
Route::delete('/product/{product_id}', [ProductController::class, 'destroy']); //remove product from the catalog
//Cart Product URIs
Route::get('/cart', [CartController::class, 'index']); //list all products in the cart
Route::delete('/cart/{product_id}', [CartController::class, 'destroy']); //remove product from the cart
