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

Route::group(['middlevare'=>'web'], function () {
    Route::match(['get','post'],'/',['uses'=>'IndexController@execute','as'=>'home']);
    Route::get('/form/{id}', 'IndexController@forms')->name('form');
    Route::post('/form_check', 'IndexController@form_check')->name('form_check');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    //Route::auth();
});




Route::group(['prefix'=>'admin','middlevare'=>'auth'], function () {

      //Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
      Route::resource('/formats', 'FormatController', ['as'=>'admin']);
  		Route::get('/formats/{format}/delete', 'FormatController@destroy')->name('admin.formats.delete');

      Route::post('/setting/{setting}/update', 'settingController@update')->name('admin.setting.update');
      Route::get('/setting', 'settingController@execute')->name('admin.settings');

      Route::post('/administrators/create', 'AdminController@create')->name('admin.administrator.create');
      Route::post('/administrators/{user}/update', 'AdminController@update')->name('admin.administrator.update');
      Route::post('/administrators/{user}/delete', 'AdminController@destroy')->name('admin.administrator.delete');
      Route::get('/administrators', 'AdminController@execute')->name('admin.administrators');
});



Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
