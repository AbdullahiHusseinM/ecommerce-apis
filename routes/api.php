<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Authentication routes

Route::post('/register', [RegisterController::class, 'registerApi']);
Route::post('/login', [LoginController::class, 'token']);

//CategoryRoutes

Route::get('categories', [CategoryController::class, 'index']);
Route::post('category', [CategoryController::class, 'store']);
Route::get('category/{category}', [CategoryController::class, 'show']);
Route::post('category/{category}', [CategoryController::class, 'update']);
Route::delete('category/{category}', [CategoryController::class, 'destroy']);

//BrandRoutes

Route::post('brand', [BrandController::class, 'store']);
Route::delete('brand/{brand}', [BrandController::class, 'destroy']);
Route::post('brand/{brand}', [BrandController::class, 'update']);
Route::get('brands', [BrandController::class, 'index']);


//SubcategorryRoutes

Route::get('subcategories', [SubCategoryController::class, 'index']);
Route::post('subcategory', [SubCategoryController::class, 'store']);
Route::delete('subcategory/{subcategory}', [SubcategoryController::class, 'destroy']);
Route::post('subcategory/{subcategory}', [SubCategoryController::class, 'update']);



Route::get('products', [ProductController::class, 'index']);
Route::post('product', [ProductController::class, 'store']);
Route::post('product/{product}', [ProductController::class, 'update']);
Route::delete('product/{product}', [ProductController::class, 'destroy']);


//CartRoutes

Route::post('addcart/{id}', [ShoppingController::class, 'add_to_cart']);