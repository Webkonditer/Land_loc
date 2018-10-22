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
    Route::get('/success_url', 'ResultController@success')->name('result');
    Route::post('/result_url', 'ResultController@result')->name('result');
    Route::get('/fail_url', function () {return view('site.fail');});
    Route::get('/unsubscribe', function () {return view('site.unsubscribe');});
    Route::post('/unsubscribe', 'RecurringController@unsubscribe')->name('unsubscribe');
    Route::get('/unsubscribe/{email}/{key}', 'RecurringController@unsubscribe_after_email');
    Route::get('/cron_recurring', 'RecurringController@cron_script')->name('cron_script');
    Route::get('/courses/{nic}', 'CoursePaymentsController@forms')->name('courses_form');
    Route::post('/courses/{nic}', 'CoursePaymentsController@form_check');
    Route::get('/bs', function () {return redirect()->route('courses_form','bs');});
    //Route::auth();
});




Route::group(['prefix'=>'admin','middlevare'=>'auth'], function () {

      //Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
      Route::resource('/formats', 'FormatController', ['as'=>'admin']);
  		Route::get('/formats/{format}/delete', 'FormatController@destroy')->name('admin.formats.delete');

      Route::post('/setting/{setting}/update', 'settingController@update')->name('admin.setting.update');
      Route::get('/setting', 'settingController@execute')->name('admin.settings');

      Route::get('/administrators', 'AdminController@execute')->name('admin.administrators');
      Route::post('/administrators/create', 'AdminController@create')->name('admin.administrator.create');
      Route::post('/administrators/{user}/update', 'AdminController@update')->name('admin.administrator.update');
      Route::post('/administrators/{user}/delete', 'AdminController@destroy')->name('admin.administrator.delete');

      Route::get('/donators/{sort}', 'DonatorsController@execute_sort')->name('admin.donators.sort');
      Route::get('/donators/monthly/{sort}', 'DonatorsController@execute_monthly')->name('admin.donators.sort.monthly');
      Route::get('/donators/one_time/{sort}', 'DonatorsController@execute_one_time')->name('admin.donators.sort.one_time');
      Route::get('/donators', 'DonatorsController@execute')->name('admin.donators');
      Route::post('/donators/create', 'DonatorsController@create')->name('admin.donator.create');
      Route::post('/donators/{donator}/update', 'DonatorsController@update')->name('admin.donator.edit');
      Route::get('/donators/{donator}/delete', 'DonatorsController@destroy')->name('admin.donator.delete');
      Route::post('/donators/search', 'DonatorsController@search')->name('admin.donators.search');

      Route::get('/payments', 'PaymentsController@execute')->name('admin.payments');
      Route::get('/payments/{sort}', 'PaymentsController@execute_sort')->name('admin.payments.sort');
      Route::get('/payments/id/{id}', 'PaymentsController@execute_id')->name('admin.payments.id');
      Route::get('/payments/{payment}/delete', 'PaymentsController@destroy')->name('admin.payment.delete');

      Route::get('/recurrings', 'RecurringController@execute')->name('admin.recurrings');
      Route::get('/recurrings/{recurring}/delete', 'RecurringController@destroy')->name('admin.recurring.delete');

      Route::get('/courses/payments', 'CoursePaymentsController@payments')->name('admin.courses.payments');
      Route::get('/courses/payments/delete/{payment}', 'CoursePaymentsController@destroy')->name('admin.courses.payments.delete');
      Route::resource('/courses', 'CoursesController', ['as'=>'admin']);
      Route::get('/courses/{course}/delete', 'CoursesController@destroy')->name('admin.courses.delete');
      Route::get('/course/passwords', 'CoursePassController@execute')->name('admin.courses.passwords');
      Route::post('/course/passwords', 'CoursePassController@edit')->name('admin.courses.passwords');

});



Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
