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

Route::group(['middleware' => ['auth'], 'prefix' => 'panel'], function () {
    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');

    Route::get('users', 'UserController@index')->name('user.index');
    Route::get('user/{user}', 'UserController@edit')->name('user.edit');
    Route::put('user/{user}', 'UserController@update')->name('user.update');
    Route::delete('user/{user}', 'UserController@destroy')->name('user.destroy');
});
