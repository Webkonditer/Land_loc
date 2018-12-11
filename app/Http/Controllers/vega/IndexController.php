<?php

namespace App\Http\Controllers\vega;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\VegaPayment;
use App\VegaUser;
use App\Format;
use App\Setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\Feedback;
use App\Mail\DonatLetter;

class InDexController extenDs Controller
{
    //
    public function __construct()
        {
            //$this->middleware('IsUser');
        }


    public function form_check(Request $request, VegaUser $vegauser, VegaPayment $vegapayment) {

      $validator = $this->validate($request, [
        'name' => 'required|string|max:100',
        'email' => 'required|email',
        'course_namber' => 'required|integer',
        'format' => 'sometimes|string|max:100',
        'ref_namber' => 'sometimes|required|integer',
      ]);

      $user = VegaUser::where('email', $request->email)->first();

    if(!isset($user->id)) { //Для тех, кто в первый раз

        //dd('Первый');
        $vegauser->name = $request->name;
        $vegauser->email = $request->email;
        //$vegauser->refer = $request->ref_namber;
        //$vegauser->city = $request->city;
        $vegauser->save();

        $user_id = $vegauser->id;


    }
    else { //Для тех, кто уже в базе
      //dd('неПервый');
      $user_id = $user->id;
    }

    $format = Format::where('position', $request->course_namber)->first();

    $vegapayment->user_id = $user_id;
    $vegapayment->course_id = $request->course_namber;
    $vegapayment->course_name = $format->name;
    if(isset($request->format))$vegapayment->format = $request->format;
    //$vegapayment->ref_namber = $request->ref_namber;
    $vegapayment->summ = $format->summ;
    $vegapayment->save();
    //dd($vegapayment);

    $payment_id = $vegapayment->id;

    $setting = Setting::first();

    // регистрационная информация (Идентификатор магазина, пароль #1)
      $mrh_login = $setting->mrh_login;

      if($setting->test_mode == 1)$mrh_pass1 = $setting->test_pass1;
      else $mrh_pass1 = $setting->mrh_pass1;
      // номер заказа
      $inv_id = $payment_id;

      // описание заказа
      $inv_desc = 'Оплата за курс: "'.$format->name.'"';

      // сумма заказа

        $out_summ = $format->summ;

      // кодировка
      $encoding = "utf-8";

      // Адрес электронной почты покупателя
      $Email = $request->email;

      //Фискальная информация URL-кодировать. Параметр включается в контрольную подпись запроса (после номера счета магазина). Например: MerchantLogin:OutSum:InvId:Receipt:Пароль#1
      $receipt = '{"sno": "usn_income","items":[{"name": "Оплата курсов пакет '.$request->course_namber.'","quantity": 1.0,"sum": '.$request->summ.'.0,"tax": "none"}]}';
      $receipt = urlencode($receipt);

      //Периодический платеж ()
      ///if($request->monthly == "Ежемесячно") $Recurring = true;
      //else $Recurring = false;

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
          'IsTest' => $IsTest
      ]);
    }

    protected function success()
    {
      return view('site.success');
    }

    protected function fail()
    {
      return view('site.fail');
    }

}
