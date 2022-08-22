<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;

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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/product/{slug}', [HomeController::class, 'productDetails'])
    ->name('product_details');
Route::get('/login', [AuthenticationController::class, 
    'login'])->name('login');
Route::post('/login', [AuthenticationController::class, 
    'processLogin'])->name('processLogin');

Route::post('/add_cart', [HomeController::class, 'addCart'])->name('addCart');

Route::get('/view_cart', [HomeController::class, 'viewCart'])->name('viewCart');

Route::group(['middleware' => 'signined', 'prefix'=>'admin', 'as' => 'admin.'], function () {
    
    Route::group(['middleware' => 'foradmin'], function() {

        Route::get('/', [DashboardController::class, 'dashboard'])->name('index');

        Route::resource('/product', ProductController::class);
    }); 
    
});