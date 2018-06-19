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



Route::group([ 'prefix' => 'dashboard', 'namespace' => 'Dashboard'], function(){
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('user', 'UserController');
    Route::resource('post', 'PostController');
    Route::resource('permission', 'PermissionController');
    Route::resource('role', 'RoleController');
});



Route::get('/home', 'HomeController@index')->name('home');

Route::get('/debug', 'HomeController@debug');
