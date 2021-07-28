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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return redirect(route('login'));
});




Auth::routes();
Route::get('/file/{id}', 'SuratmasukController@getfilesurat');
Route::resource('/suratmasuk', 'SuratmasukController');
Route::resource('/disposisi', 'DisposisiController');
Route::resource('/berkas', 'Filecontroller');
Route::get('/disposisi/dispose/{id}', 'DisposisiController@disposisike');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/loginnew', 'HomeController@loginnew')->name('login_new');

Route::get('/beranda', 'HomeController@beranda')->name('beranda');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
