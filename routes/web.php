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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('person')->group(function() {
    Route::get('/', 'PersonController@index')->name('person.all');
    Route::get('/show/{uuid}', 'PersonController@show')->name('person.show');
    Route::get('/add', 'PersonController@add')->name('person.add');
    Route::post('/store', 'PersonController@store')->name('person.store');
    Route::get('/edit/{uuid}', 'PersonController@edit')->name('person.edit');
    Route::put('/update/{uuid}', 'PersonController@update')->name('person.edit');
    Route::delete('/delete/{uuid}', 'PersonController@delete')->name('person.delete');
});
