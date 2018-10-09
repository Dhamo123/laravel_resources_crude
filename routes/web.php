<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/prodict/{{id}}', 'HomeController@get_product');
//Route::get('datatable', 'HomeController@datatable');
// Get Data
Route::get('datatable/getdata', 'HomeController@getPosts')->name('getdata');



Route::resource('product', 'ProductController',
                array('use' => array('create', 'store', 'update', 'destroy','edit')));