<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/getProducts', [ProductController::class, 'getProducts'])->name('getProducts');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/addToCart/{product}', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('/cartContent', [CartController::class, 'getCartContent'])->name('getCartContent');
    Route::get('/incrementCart/{rowId}', [CartController::class, 'incrementCart'])->name('incrementCart');
    Route::get('/decrementCart/{rowId}', [CartController::class, 'decrementCart'])->name('decrementCart');
    Route::get('/getCartTotal', [CartController::class, 'getCartTotal'])->name('getCartTotal');
    Route::get('/removeItemFromCart/{rowId}', [CartController::class, 'removeItemFromCart'])->name('removeItemFromCart');

    Route::get('/checkout',[OrderController::class,'checkout'])->name('checkOut');
    Route::post('/orderDone',[OrderController::class,'orderDone'])->name('orderDone');
});
Route::get('/cart', function () {
    return view('cart.index');
})->name('cart');
Route::get('/thankYou', function () {
    return view('thankYou.index');
});
require __DIR__ . '/auth.php';
