<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/cashier',[App\Http\Controllers\orderController::class,'cashier']);
Route::get('/getKategoriProduk',[App\Http\Controllers\kategoriprodukController::class,'getKategoriProduk'])->name('getKategoriProduk');
Route::get('/getProduk',[App\Http\Controllers\produkController::class,'getProduk'])->name('getProduk');
Route::put('masters/kategoriproduk/{kategoriproduk}', [App\Http\Controllers\kategoriprodukController::class,'update'])->name('kategoriproduks.update');
Route::post('masters/produk/{produk}', [App\Http\Controllers\produkController::class,'update'])->name('produks.update');
Route::get('/getMeja',[App\Http\Controllers\mejaController::class,'getMeja'])->name('getMeja');
Route::put('masters/meja/{meja}', [App\Http\Controllers\mejaController::class,'update'])->name('mejas.update');
Route::get('/getOrder',[App\Http\Controllers\orderController::class,'getOrder'])->name('getOrder');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');

Route::resource('/master/kategoriproduk', \App\Http\Controllers\kategoriprodukController::class);
Route::resource('/master/produk', \App\Http\Controllers\produkController::class);
Route::resource('/master/meja', \App\Http\Controllers\mejaController::class);
Route::resource('/order', \App\Http\Controllers\orderController::class);

Route::get('/listmenu', [App\Http\Controllers\pelangganController::class, 'index'])->name('listmenu');

Route::get('cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('cart/add/{product}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('cart/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');

Route::post('pembayaran', [App\Http\Controllers\pembayaranController::class, 'store'])->name('pembayaran.store');
Route::put('updateProduk', [App\Http\Controllers\produkController::class, 'update'])->name('updateProduk');
Route::get('/index', [App\Http\Controllers\pembayaranController::class, 'index'])->name('pembayaran.index');
Route::post('completeOrder/{id}', [App\Http\Controllers\HomeController::class, 'completeOrder'])->name('completeOrder');
Route::post('customerLeft/{id}', [App\Http\Controllers\HomeController::class, 'customerLeft'])->name('customerLeft');
Route::get('/order/detail/{invoice_number}', [App\Http\Controllers\OrderController::class, 'getOrderDetail'])->name('getOrderDetail');
