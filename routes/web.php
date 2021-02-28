<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('invoice','InvoiceController');
Route::get('invoice','InvoiceController@edit');
Route::get('invoice/{id}/edit','InvoiceController@edit');
Route::put('invoice/{id}','InvoiceController@update');
Route::post('product/create','InvoiceController@create');
Route::delete('product/delete/{id}', 'InvoiceController@destroy');
