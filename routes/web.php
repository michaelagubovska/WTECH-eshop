<?php

use App\Http\Controllers\AdminNewProductController;
use App\Http\Controllers\AdminProductDetailController;
use App\Http\Controllers\AdminProductListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;


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
Route::get('/',[IndexController::class,'index'])->name('home');
Route::get('/admin',[AdminLoginController::class,'index']);
Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin/product_list', [AdminProductListController::class, 'index'])->name('admin_product_list_view');
    Route::get('/admin/new_product',[AdminNewProductController::class,'index']);
    Route::post('/admin/new_product/',[AdminNewProductController::class,'create']);
    Route::get('/admin/product_detail/{product_id}',[AdminProductDetailController::class,'index']);
    Route::post('/admin/product_detail/{product_id}/',[AdminProductDetailController::class,'create']);
});

Route::get('/cart', [CartController::class,'index']);
Route::post('/cart/', [CartController::class,'update_quantity_delete']);
Route::get('/product_detail', [ProductDetailController::class,'index']);
Route::post('/product_detail/', [ProductDetailController::class,'add_to_cart']);
Route::get('/search', [SearchController::class,'index']);

require __DIR__.'/auth.php';
Route::get('/{category_id}', [CategoryController::class,'index']);
