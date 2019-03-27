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
    /*Route::match(['get','post'],'/',['uses'=>'IndexController@execute','as'=>'home']);
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
    Route::get('/spend', 'BonusController@gifts')->name('bonus.gifts');
    //Route::post('/spend', 'BonusController@entrance');
    Route::get('/spend/entrance', 'BonusController@entrance')->name('spend.entrance');
    Route::post('/spend/check', 'BonusController@entrance_check')->name('spend.check');
    //Route::auth();Route::match(['get', 'post'],
    //Аутентификация
    Route::post('/user/register',['as' => 'user.register','uses' => 'UserAuth\RegisterController@create']);
    //Личный кабинете
    Route::get('/user/dashboard',['as' => 'user.dashboard','uses' => 'UserDashboardController@execute','middleware'=>'IsUser']);
    Route::post('/user/dashboard/edit',['as' => 'user.dashboard.edit','uses' => 'UserDashboardController@edit','middleware'=>'IsUser']);*/
    //Вега проект

    //Route::auth();

    Route::group(['namespace' => 'UserAuth'], function() {
      Route::get('/login',['as' => 'login','uses' => 'LoginController@showLoginForm']);
      Route::post('/login',['uses' => 'LoginController@login']);
      Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
      Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
      Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm');
      Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
      Route::get('/logout',['as' => 'logout','uses' => 'LoginController@logout']);
    });

    Route::group(['namespace' => 'Auth'], function() {
      Route::get('/dashboard/login',['as' => 'admin_login','uses' => 'LoginController@showLoginForm']);
      Route::post('/dashboard/login',['uses' => 'LoginController@login']);
      Route::get('/dashboard/logout',['as' => 'admin_logout','uses' => 'LoginController@logout']);
    });

    Route::get('/', 'vega\IndexController@execute')->name('vega.home');
    Route::post('/form_check', 'vega\IndexController@form_check')->name('vega.form_check');
    Route::post('/result_url', 'vega\ResultController@result')->name('vega.result_url');
    Route::get('/success_url', 'vega\IndexController@success')->name('vega.success');
    Route::get('/fail_url', 'vega\IndexController@fail')->name('vega.fail');

    Route::get('/course/{course}', 'vega\VideosController@execute')->name('vega.course');
    Route::get('/chat', 'vega\VegaChatController@execute')->name('vega.chat');
    Route::post('/chat/new', 'vega\VegaChatController@new_message')->name('vega.chat.new');
    Route::get('/chat/delete/{vegachat}', 'vega\VegaChatController@delete')->name('chat.delete');
    //Route::get('/user/login',['as' => 'user.login','uses' => 'UserAuth\LoginController@showLoginForm']);
    //Route::post('/user/login',['uses' => 'UserAuth\LoginController@login']);
    //Route::get('/user/logout',['as' => 'user.logout','uses' => 'UserAuth\LoginController@logout']);
    //Route::get('/password/reset/',['as' => 'password.reset','uses' => 'UserAuth\ResetPasswordController@showLinkRequestForm']);
    //Route::post('/password/reset/',['as' => 'password.reset','uses' => 'UserAuth\ResetPasswordController@reset']);
    //Route::get('/password/reset/{token}',['as' => 'password.reset','uses' => 'UserAuth\ResetPasswordController@showResetForm']);
    //Route::post('/password/email',['as' => 'password.email','uses' => 'UserAuth\ForgotPasswordController@sendResetLinkEmail']);
});

Route::group(['prefix'=>'admin','middleware'=>'IsAdmin'], function () {

      //Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
      Route::resource('/formats', 'FormatController', ['as'=>'admin']);
  		Route::get('/formats/{format}/delete', 'FormatController@destroy')->name('admin.formats.delete');

      Route::post('/setting/{setting}/update', 'settingController@update')->name('admin.setting.update');
      Route::get('/setting', 'settingController@execute')->name('admin.settings');

      Route::get('/administrators', 'AdminController@execute')->name('admin.administrators');
      Route::post('/administrators/create', 'AdminController@create')->name('admin.administrator.create');
      Route::post('/administrators/{user}/update', 'AdminController@update')->name('admin.administrator.update');
      Route::post('/administrators/{user}/delete', 'AdminController@destroy')->name('admin.administrator.delete');

      Route::get('/vegausers/{sort}', 'vega\VegaUsersController@execute_sort')->name('admin.vegausers.sort');
      Route::get('/vegausers/monthly/{sort}', 'vega\VegaUsersController@execute_monthly')->name('admin.vegausers.sort.monthly');
      Route::get('/vegausers/one_time/{sort}', 'vega\VegaUsersController@execute_one_time')->name('admin.vegausers.sort.one_time');
      Route::get('/vegausers', 'vega\VegaUsersController@execute')->name('admin.vegausers');
      Route::post('/vegausers/create', 'vega\VegaUsersController@create')->name('admin.vegausers.create');
      Route::post('/vegausers/{vegauser}/update', 'vega\VegaUsersController@update')->name('admin.vegausers.edit');
      Route::get('/vegausers/{vegauser}/delete', 'vega\VegaUsersController@destroy')->name('admin.vegausers.delete');
      Route::post('/vegausers/search', 'vega\VegaUsersController@search')->name('admin.vegausers.search');
      Route::post('/vegausers/new_password', 'vega\VegaUsersController@new_password')->name('admin.vegausers.new_password');

      Route::get('/vegapayments/stat', 'vega\VegaPaymentsController@stat')->name('admin.vegapayments.stat');
      Route::get('/vegapayments', 'vega\VegaPaymentsController@execute')->name('admin.vegapayments');
      Route::get('/vegapayments/{sort}', 'vega\VegaPaymentsController@execute_sort')->name('admin.vegapayments.sort');
      Route::get('/vegapayments/id/{id}', 'vega\VegaPaymentsController@execute_id')->name('admin.vegapayments.id');
      Route::get('/vegapayments/{vegapayment}/delete', 'vega\VegaPaymentsController@destroy')->name('admin.vegapayments.delete');

      Route::get('/recurrings', 'RecurringController@execute')->name('admin.recurrings');
      Route::get('/recurrings/{recurring}/delete', 'RecurringController@destroy')->name('admin.recurring.delete');

      Route::get('/courses/payments', 'CoursePaymentsController@payments')->name('admin.courses.payments');
      Route::post('/courses/payments', 'CoursePaymentsController@search');
      Route::get('/courses/stat', 'CoursePaymentsController@stat')->name('admin.courses.stat');

      Route::get('/courses/payments/delete/{payment}', 'CoursePaymentsController@destroy')->name('admin.courses.payments.delete');
      Route::resource('/courses', 'CoursesController', ['as'=>'admin']);
      Route::get('/courses/{course}/delete', 'CoursesController@destroy')->name('admin.courses.delete');
      Route::get('/course/passwords', 'CoursePassController@execute')->name('admin.courses.passwords');
      Route::post('/course/passwords', 'CoursePassController@edit')->name('admin.courses.passwords');

      Route::get('/bonus/applications', 'BonusApplicationController@execute')->name('admin.bonus.applications');
      Route::post('/bonus/application/return', 'BonusApplicationController@return')->name('admin.bonuses.return');
      Route::post('/bonus/application/process', 'BonusApplicationController@process')->name('admin.bonuses.process');
      Route::post('/bonus/application/processed', 'BonusApplicationController@processed')->name('admin.bonuses.processed');
      Route::get('/bonus/stat', 'BonusApplicationController@stat')->name('admin.bonus.stat');

      Route::post('/ch/edit', 'DonatorsController@ch_edit')->name('admin.ch.edit');

});


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
