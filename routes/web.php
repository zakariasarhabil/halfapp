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

Route::get('/dashbord', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function () {

Route::get('showoffice', 'Auth\UsersController@alloffice')->name('alloffice');
Route::get('showoffice/{id}', 'Auth\UsersController@showoffice')->name('showoffice');
Route::post('addofficeowner','Auth\UsersController@AddOfficeOwner')->name('addoffice');
Route::delete('destroyoffice/{id}','Auth\UsersController@destroyoffice')->name('deleteoffice');

Route::get('showadmin', 'Auth\UsersController@alladmin')->name('alladmin');
Route::post('addadmin','Auth\UsersController@AddAdmin')->name('addadmin');
Route::delete('deleteadmin/{id}','Auth\UsersController@destroyAdmin')->name('deleteadmin');

Route::post('search', 'Auth\UsersController@search')->name('search');


Route::put('activeoffice/{id}', 'Auth\UsersController@updateStatusOffice')->name('ChangeStatus');

});
