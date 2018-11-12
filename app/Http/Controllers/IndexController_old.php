<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Format;
use App\Donator;
use App\Payment;
use App\Setting;
use App\Recurring;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Feedback;

class InDexController extenDs Controller
{
    //
    public function __construct()
        {
            //$this->middleware('IsUser');
        }

    public function execute(Request $request) {
      //$portfolios = Portfolio::get(array('name','filter','images'));
      //$services = Service::where('id','<',20)->get();
      //$peoples = People::take(3)->get();

      return view('site.index', [
        'formats' => Format::orderBy('position')->paginate(10),
      ]);
    }

    public function forms($id, Request $request) {

      if(Auth::guard('user_guard')->user()) {
        $user_id = Auth::guard('user_guard')->user()->id;
        $user = Donator::where('id', $user_id)->first();
      }
      else $user = '';

      return view('site.form', [
        'format' => Format::where('id',$id)->first(),
        'user' => $user,
      ]);
    }

    public function form_check(Request $request, Donator $donator, Payment $payment) {

//dd($request);

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
        $to = $donator->email;
        $subject = 'Регистрация на iskconclub.ru';

        $message = '
        <html>
            <head>
                <title>Уведомление о регистрации</title>
                <meta charset="utf8">
            </head>
            <body>
                <h2>Здравствуйте, '.$donator->name.'!</h2>
                <p>Вы успешно зарегистрированы на сайте http://iskconclub.ru</p>
                <p>Ваш логин: '.$donator->email.' </p>
                <p>Ваш пароль: '.$password.' </p>
            </body>
        </html>
        ';

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf8';
        $headers[] = 'From: iskconclub.ru <info@iskconclub.ru>';

        $result = mail($to, $subject, $message, implode("\r\n", $headers));
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
                                ->withErrors('У Вас уже есть ежемесячная подписка. Если Вы хотите изменить ее, сначала удалите старую подписку в личном кабинете.')
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

    protected function generate_password($number)
    {
      $arr = array('a','b','c','d','e','f',
                   'g','h','i','j','k','l',
                   'm','n','o','p','r','s',
                   't','u','v','x','y','z',
                   'A','B','C','D','E','F',
                   'G','H','I','J','K','L',
                   'M','N','O','P','R','S',
                   'T','U','V','X','Y','Z',
                   '1','2','3','4','5','6',
                   '7','8','9','0');
      // Генерируем пароль
      $pass = "";
      for($i = 0; $i < $number; $i++)
      {
        // Вычисляем случайный индекс массива
        $index = rand(0, count($arr) - 1);
        $pass .= $arr[$index];
      }
      return $pass;
    }

}
