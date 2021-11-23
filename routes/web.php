<?php

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

// index
Route::get('/', function () {
    return view('index');
})-> name('index');

Route::get('/products/create', 'ProductController@create')-> name('product.new');  
Route::post('/products/create', 'ProductController@store')-> name('product.store');  
Route::get('/products/all', 'ProductController@viewProducts')-> name('product.all');
Route::get('/products/detail/{product_id}', 'ProductController@detailProduct')-> name('product.details');
Route::get('/products/edit/{product_id}', 'ProductController@editProduct')-> name('product.edit');
Route::post('/products/edit/save/{product_id}', 'ProductController@saveChanges')-> name('product.save');
Route::delete('/products/{product_id}', 'ProductController@delete')-> name('product.delete');

Route::get('signup', 'AuthController@signUp')-> name('auth.signUp');
Route::get('ajaxPassword/{cek}', 'AuthController@ajaxPassword');
Route::get('ajaxUsername/{cek}', 'AuthController@ajaxUsername');
Route::post('auth/signup', 'AuthController@register')-> name('auth.register');
Route::get('/login', 'AuthController@logIn')-> name('auth.logIn')->middleware('guest');
Route::post('auth/login', 'AuthController@loginAuthenticate')-> name('auth.loginAuthenticate');
Route::post('/logout', 'AuthController@logout')-> name('auth.logout');