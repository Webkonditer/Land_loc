<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Course_payment;
use App\Setting;

class CoursePaymentsController extends Controller
{
    public function forms($nic, Request $request) {

      $course = Course::where('nic',$nic)->first();
      if(isset($course->module))$modules = explode("\n", $course->module);
      else abort(404);

      return view('site.courses.form', [
        'course' => $course,
        'modules'  => $modules,
      ]);
    }
    //----------------------------------------------------------------
    public function form_check($nic, Request $request, Course_payment $payment, Course $courses) {

    $validator = $this->validate($request, [
      'summ' => 'required|integer',
      'name' => 'required|string|max:100',
      'email' => 'required|email',
      'group' => 'required|integer',
      'module' => 'required|string|max:250',
    ]);

    $course = Course::where('nic', $nic)->first();

    $payment->name = $request->name;
    $payment->email = $request->email;
    $payment->group_id = $request->group;
    $payment->course_id = $course->id;
    $payment->course_name = $course->name;
    $payment->module = $request->module;
    $payment->summ = $request->summ;
    $payment->confirmation = $request->confirmation;
    $payment->save();

    $payment_id = $payment->id;

    $setting = Setting::first();

    // регистрационная информация (Идентификатор магазина, пароль #1)
      $mrh_login = $setting->mrh_login;

      if($setting->test_mode == 1)$mrh_pass1 = $setting->test_pass1;
      else $mrh_pass1 = $setting->mrh_pass1;
      // номер заказа
      $inv_id = $payment_id+1000000;

      // описание заказа
      $inv_desc = 'Оплата: '.$payment->course_name.' - '.$payment->module;

      // сумма заказа
      $out_summ = $payment->summ;

      // кодировка
      $encoding = "utf-8";

      // Адрес электронной почты покупателя
      $Email = $payment->email;

      //Фискальная информация URL-кодировать. Параметр включается в контрольную подпись запроса (после номера счета магазина). Например: MerchantLogin:OutSum:InvId:Receipt:Пароль#1
      $receipt = '{"sno": "usn_income","items":[{"name": "'.$inv_desc.'","quantity": 1.0,"sum": '.$out_summ.'.0,"tax": "none"}]}';
      $receipt = urlencode($receipt);

      //Периодический платеж ()
      //if($request->monthly == "Ежемесячно") $Recurring = true;
      //else
      $Recurring = false;

      //Тестовый режим
      if($setting->test_mode == 1)$IsTest = true;
      else $IsTest = false;

      // формирование подписи
      $crc  = md5("$mrh_login:$out_summ:$inv_id:$receipt:$mrh_pass1");
      //$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");

      return view('site.form_send', [
          'mrh_login' => $mrh_login,
          'out_summ' => $out_summ,
          'inv_id' => $inv_id,
          'inv_desc' => $inv_desc,
          'crc' => $crc,
          'Email' => $Email,
          'Receipt' => $receipt,
          'Recurring' => $Recurring,
          'IsTest' => $IsTest
      ]);
    }
    //----------------------------------------------------------------

    public function payments(Course_payment $payments) {

      return view('admin.courses.payments', [
        'payments' => Course_payment::where('confirmation','!=',NULL)->orderBy('created_at', 'desc')->paginate(10)
      ]);
    }
    //-----------------------------------------------------------------


}
