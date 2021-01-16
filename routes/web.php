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
    Route::get('/', 'PersonController@index')->name('person.index');
    Route::get('/show/{uuid}', 'PersonController@show')->name('person.show');
    Route::get('/add', 'PersonController@add')->name('person.add');
    Route::post('/store', 'PersonController@store')->name('person.store');
    Route::get('/edit/{uuid}', 'PersonController@edit')->name('person.edit');
    Route::post('/update/{uuid}', 'PersonController@update')->name('person.update');
    Route::get('/delete/{uuid}', 'PersonController@delete')->name('person.delete');
});
