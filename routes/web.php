<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('Home',[HomeController::class,"home"])->name('home');

Route::get('/categories',[HomeController::class,"category"])->name('categories');

Route::get('/products/{category?}', function ($category = null) {
    return view('frontend.pages.products', [
        'category' => $category
    ]);
})->name('products');

//cart
Route::get('/cart', function () {
    return view('frontend.pages.cart');
})->name('cart');