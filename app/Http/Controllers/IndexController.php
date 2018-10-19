<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Format;
use App\Donator;
use App\Payment;
use App\Setting;
use App\Recurring;

class InDexController extenDs Controller
{
    //
    public function execute(Request $request) {

      //$pages = Page::all();
      //$portfolios = Portfolio::get(array('name','filter','images'));
      //$services = Service::where('id','<',20)->get();
      //$peoples = People::take(3)->get();

      //dd($peoples);

      return view('site.index', [
        'formats' => Format::orderBy('position')->paginate(10),
      ]);
    }

    public function forms($id, Request $request) {
      
      return view('site.form', [
        'format' => Format::where('id',$id)->first(),
      ]);
    }

    public function form_check(Request $request, Donator $donator, Payment $payment) {

//dd($request);

    $validator = $this->validate($request, [

      'format_id' => 'required|integer',
      'format_name' => 'required|string|max:60',
      'name' => 'required|string|max:100',
      'email' => 'required|email',
      'phone' => 'required|integer',
      'city' => 'required|string|max:100',
      'summ' => 'required|integer',
      'monthly' => 'required|string|max:60',
      'podp' => 'sometimes|required|accepted',
    ]);

    if($request->monthly == "Ежемесячно"){
      $old_donator = Donator::where('last_payment','!=',NULL)->where('email', $request->email)->first();
      if (isset($old_donator->id)) {
        $old_recurring = Recurring::where('unsubscribed',NULL)->where('donator_id', $old_donator->id)->first();
        if (isset($old_recurring->id)) {
          return redirect()->back()
                              ->withErrors('У Вас уже есть ежемесячная подписка. Если Вы хотите изменить ее, сначала отпишитесь от старой подписки.')
                              ->withInput();
        }
      }
    }
    //dd('Еще нет');
    $donator->name = $request->name;
    $donator->email = $request->email;
    $donator->phone = $request->phone;
    $donator->city = $request->city;
    $donator->format_name = $request->format_name;
    if($request->monthly == "Ежемесячно")$donator->monthly = "Ежемесячно"; else $donator->monthly = "Разово";
    $donator->summ = $request->summ;
    if($request->podp == "on")$donator->recurring = "Да"; else $donator->recurring = "---";
    if(isset($request->anonim) )$donator->anonim = "Да"; else $donator->anonim = "Нет";
    $donator->save();

    $donator_id = $donator->id;

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

}
