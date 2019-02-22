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

Route::prefix('user')->group(function () {
    Route::get('show', 'admin\adminController@show')->name('show');

    Route::get('add', 'admin\adminController@getAdd')->name('addMember');
    Route::post('add','admin\adminController@postAdd');

    Route::get('update/{id}','admin\adminController@getUpdate');
    Route::post('update/{id}','admin\adminController@postUpdate');

    Route::get('delete/{id}','admin\adminController@getDelete');

    Route::get('login','admin\adminController@getLogin')->name('loginReal');
    Route::post('login','admin\adminController@postLogin');

    Route::get('logout','admin\adminController@getLogout');

    Route::get('home','admin\adminController@getHome')->name('home');

    Route::get('register','admin\adminController@getRegister');
    Route::post('register','admin\adminController@postRegister');

    Route::get('change','admin\adminController@getChange')->name('change');
    Route::post('change','admin\adminController@postChange');
});
