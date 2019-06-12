<?php

namespace App\Http\Controllers\vega;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Auth;
use App\VegaPayment;
use App\VegaUser;
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


    public function form_check(Request $request, VegaUser $vegauser) {

      dump('Страница приземления с Тильды и перенаправления на платежный шлюз. Сюда должны прийти все необходимые данные из формы.');
      dd($request);
    if(!isset($request->autorised)) { //Для неавторизованных

        $validator = $this->validate($request, [
          'name' => 'required|string|max:100',
          'email' => 'required|email|unique:donators',
          'course_namber' => 'required|integer',
          'format' => 'sometimes|string|max:100',
          'ref_namber' => 'sometimes|required|integer',
        ]);

        $vegauser->name = $request->name;
        $vegauser->email = $request->email;
        //$vegauser->phone = $request->phone;
        //$vegauser->city = $request->city;
        $vegauser->save();

        $user_id = $vegauser->id;

        
    }
    else { //Для авторизованных

      $validator = $this->validate($request, [
        'summ' => 'required|integer',
        'podp' => 'sometimes|required|accepted',
        'format_id' => 'required|integer',
        'format_name' => 'required|string|max:60',
        'monthly' => 'required|string|max:60',
      ]);

      $donator_id = Auth::guard('user_guard')->user()->id; //ид донатора

      //проверяем на наличие подписок
      if($request->monthly == "Ежемесячно"){
          $old_recurring = Recurring::where('unsubscribed',NULL)->where('donator_id', $donator_id)->first();
          if (isset($old_recurring->id)) {
            return redirect()->back()
                                ->withErrors('У Вас уже есть ежемесячная подписка. Изменить подписку Вы можете в личном кабинете.')
                                ->withInput();
          }
      }
    }

    $payment->donator_id = $donator_id;
    $payment->format_id = $request->format_id;
    if($request->monthly == "Ежемесячно"){
      $payment->monthly = "Ежемесячно";
      $payment->repeated = "Родительский";

    }
    else {
      $payment->monthly = "Разово";
      $payment->repeated = "Разовый";

    }

    $payment->summ = $request->summ;
    $payment->save();
    //dd($payment->id);
    $payment_id = $payment->id;

    $setting = Setting::first();

    // регистрационная информация (Идентификатор магазина, пароль #1)
      $mrh_login = $setting->mrh_login;

      if($setting->test_mode == 1)$mrh_pass1 = $setting->test_pass1;
      else $mrh_pass1 = $setting->mrh_pass1;
      // номер заказа
      $inv_id = $payment_id;

      // описание заказа
      $inv_desc = $setting->inv_desc;

      // сумма заказа

        $out_summ = $request->summ;

      // кодировка
      $encoding = "utf-8";

      // Адрес электронной почты покупателя
      $Email = $request->email;

      //Фискальная информация URL-кодировать. Параметр включается в контрольную подпись запроса (после номера счета магазина). Например: MerchantLogin:OutSum:InvId:Receipt:Пароль#1
      $receipt = '{"sno": "usn_income","items":[{"name": "Участие в вебинарах пакет '.$request->format_id.'","quantity": 1.0,"sum": '.$request->summ.'.0,"tax": "none"}]}';
      $receipt = urlencode($receipt);

      //Периодический платеж ()
      if($request->monthly == "Ежемесячно") $Recurring = true;
      else $Recurring = false;

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

    protected function success()
    {
      dd('Страница упеха');
    }

    protected function fail()
    {
      dd('Страница неудачного платежа');
    }

}
