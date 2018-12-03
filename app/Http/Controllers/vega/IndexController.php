<?php

namespace App\Http\Controllers\vega;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Auth;
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


    public function form_check(Request $request) {

      dump('Страница приземления с Тильды и перенаправления на платежный шлюз. Сюда должны прийти все необходимые данные из формы.');
      dd($request);
    if(!isset($request->autorised)) { //Для неавторизованных

        $validator = $this->validate($request, [
          'format_id' => 'required|integer',
          'format_name' => 'required|string|max:60',
          'name' => 'required|string|max:100',
          'email' => 'required|email|unique:donators',
          'phone' => 'required|integer',
          'city' => 'required|string|max:100',
          'summ' => 'required|integer',
          'monthly' => 'required|string|max:60',
          'podp' => 'sometimes|required|accepted',
        ]);

        $donator->name = $request->name;
        $donator->email = $request->email;
        $donator->phone = $request->phone;
        $donator->city = $request->city;
        $donator->format_name = $request->format_name;
        if($request->monthly == "Ежемесячно")$donator->monthly = "Ежемесячно"; else $donator->monthly = "Разово";
        $donator->summ = $request->summ;
        if($request->podp == "on")$donator->recurring = "Да"; else $donator->recurring = "---";
        if(isset($request->anonim) )$donator->anonim = "Да"; else $donator->anonim = "Нет";
        $password = $this->generate_password(8);
        $donator->password = Hash::make($password);
        $donator->save();

        $donator_id = $donator->id;

        //Отправка письма

        $data = [
            'name' => $donator->name,
            'email' => $donator->email,
            'password' => $password,
        ];

        Mail::to($donator->email)->send(new DonatLetter($data));
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
