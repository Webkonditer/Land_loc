<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Format;
use App\Donator;
use App\Payment;

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
//$ff = Format::where('id',$id)->first();
//dd($ff);

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
      'summ' => 'required|integer',
      'monthly' => 'required|string|max:60',
    ]);

    $donator->name = $request->name;
    $donator->email = $request->email;
    $donator->format_name = $request->format_name;
    if($request->monthly == "Ежемесячно")$donator->monthly = "Ежемесячно"; else $donator->monthly = "Разово";
    $donator->summ = $request->summ;
    $donator->save();

    $donator_id = $donator->id;

    $payment->donator_id = $donator_id;
    $payment->format_id = $request->format_id;
    if($request->monthly == "Ежемесячно")$payment->monthly = "Ежемесячно"; else $payment->monthly = "Разово";
    $payment->summ = $request->summ;
    $payment->save();

    $payment_id = $payment->id;

    // регистрационная информация (Идентификатор магазина, пароль #1)
      $mrh_login = "iskconclub";
      $mrh_pass1 = "TB4fw1ybFl8Bv0az8vUa";

      // номер заказа
      $inv_id = $payment_id;

      // описание заказа
      $inv_desc = "Участие в вебинарах и курсах";

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
      $Recurring = true;

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
          'Recurring' => $Recurring
      ]);
    }

}
