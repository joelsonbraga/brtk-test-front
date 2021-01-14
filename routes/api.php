<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('v1')->prefix('v1')->group(function () {
    Route::prefix('person')->group(function() {
        Route::get('/all', 'PersonController@index')->name('person.all');
        Route::get('/show/{uuid}', 'PersonController@show')->name('person.byId');
        Route::post('/add', 'PersonController@store')->name('person.store');
        Route::put('/update/{uuid}', 'PersonController@update')->name('person.edit');
        Route::delete('/delete/{uuid}', 'PersonController@delete')->name('person.delete');
    });
});


