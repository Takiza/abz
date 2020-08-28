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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware:admin'], function () {
    Route::get('employees', 'EmployeeController@index')->name('employees');
    Route::get('employees/add', 'EmployeeController@add')->name('employees.add');
    Route::post('employees/store', 'EmployeeController@store')->name('employees.store');
    Route::get('employees/{id}/edit', 'EmployeeController@edit')->name('employees.edit');
    Route::put('employees/{id}/update', 'EmployeeController@update')->name('employees.update');
    Route::delete('employees/{id}/delete', 'EmployeeController@delete')->name('employees.delete');

    Route::get('positions', 'PositionController@index')->name('positions');
    Route::get('positions/add', 'PositionController@add')->name('positions.add');
    Route::post('positions/store', 'PositionController@store')->name('positions.store');
    Route::get('positions/{id}/edit', 'PositionController@edit')->name('positions.edit');
    Route::put('positions/{id}/update', 'PositionController@update')->name('positions.update');
    Route::delete('positions/{id}/delete', 'PositionController@delete')->name('positions.delete');
});
