<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Donator;
use App\Format;
use App\Payment;
use Carbon\Carbon;
use App\Recurring;
use App\Setting;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\LossRecur;

class RecurringController extends Controller
{
    public function unsubscribe(Request $request) {
        $validator = $this->validate($request, [
        'email' => 'required|email',
        'pers' => 'accepted',
        ]);

        $donator = Donator::where('last_payment','!=',NULL)->where('email', $request->email)->first();
        if (isset($donator->id)) {
            $recur = Recurring::where('unsubscribed', NULL)->where('donator_id', $donator->id)->first();
            if($recur != NULL) {
              //Отправка письма
              $to = $request->email;
              $subject = 'Отписка от ежемесячного платежа';
              $url = route('home').'/unsubscribe/'.$request->email.'/69483'.$donator->id.'5739';

              $message = '
              <html>
                  <head>
                      <title>Отписка от ежемесячного платежа</title>
                      <meta charset="utf8">
                  </head>
                  <body>
                      <p>Здравствуйте, '.$donator->name.'</p>
                      <p> </p>
                      <p>Для того, чтобы отписаться от ежемесячного платежа, пожалуйста перейдите по ссылке '.$url.'</p>
                      <p> </p>
                      <p>Спасибо за то, что были с нами!</p>
                  </body>
              </html>
              ';

              $headers[] = 'MIME-Version: 1.0';
              $headers[] = 'Content-type: text/html; charset=utf8';
              $headers[] = 'From: bhaktilata.ru <info@bhaktilata.ru>';

              $result = mail($to, $subject, $message, implode("\r\n", $headers));
              //echo $result ? 'OK' : 'Error';

              return view('site.unsubscribe-emaled');
            }
        }
        return redirect('unsubscribe')
                            ->withErrors('Указанный Вами Email в базе ежемесячных платежей не найден')
                            ->withInput();
    }

    public function unsubscribe_after_email($email, $key) {

      $donator = Donator::where('last_payment','!=',NULL)->where('email', $email)->first();
      if (isset($donator->id)) {
          if(Recurring::where('donator_id', $donator->id)->count() != 0 && $key == '69483'.$donator->id.'5739') {
              //dd('Отписан');
              $recur = Recurring::where('unsubscribed', NULL)->where('donator_id', $donator->id)->first();
                if($recur != NULL) {
                  $recur->unsubscribed = Carbon::now()->format('Y-m-d H:i:s');
                  $recur->save();//Внесение в таблицу регулярных платежей отметки об отписке.

                  return view('site.unsubscribe-success');
                }
          }
      }
      return view('site.unsubscribe-fail');
    }

    public function cron_script(Payment $payment) {

        $last_date = (new Carbon('last day of this month'))->format('d');
        $today_d = Carbon::now()->format('d');
        if($last_date == $today_d) {
            $recurs = Recurring::where('unsubscribed', NULL)
                                ->whereDay('created_at','>=', $today_d)
                                ->get();
        }
        else {
            $recurs = Recurring::where('unsubscribed', NULL)
                                ->whereDay('created_at', $today_d)
                                ->get();
        }
        $recurs = Recurring::where('unsubscribed', NULL)->where('payment_id', 405)->get();

        $setting = Setting::first();

        // регистрационная информация (Идентификатор магазина, пароль #1)
          $mrh_login = $setting->mrh_login;

          //пароль1
          if($setting->test_mode == 1)$mrh_pass1 = $setting->test_pass1;
          else $mrh_pass1 = $setting->mrh_pass1;

          // описание заказа
          $inv_desc = $setting->inv_desc;

          // кодировка
          $encoding = "utf-8";

          //Тестовый режим
          if($setting->test_mode == 1)$IsTest = true;
          else $IsTest = false;

        foreach($recurs as $recur){

			$payment = new Payment;

            $payment->donator_id = $recur->donator_id;
            $payment->format_id = $recur->format_id;
            $payment->monthly = "Ежемесячно";
            $payment->summ = $recur->summ;
            $payment->repeated = "Рекурентный";
            $payment->save();
            // номер заказа
            $inv_id = $payment->id;
            $prev_inv_id = $recur->payment_id;

            // сумма заказа
            $out_summ = $recur->summ;

            //Описание товара
            $desc = $setting->inv_desc;

            //Фискальная информация URL-кодировать. Параметр включается в контрольную подпись запроса (после номера счета магазина). Например: MerchantLogin:OutSum:InvId:Receipt:Пароль#1
            $receipt = '{"sno": "usn_income","items":[{"name": "Участие в вебинарах пакет '.$recur->format_id.'","quantity": 1.0,"sum": '.$recur->summ.'.0,"tax": "none"}]}';
            $receipt = urlencode($receipt);

            // формирование подписи
            $crc  = md5("$mrh_login:$out_summ:$inv_id:$receipt:$mrh_pass1");

          $client = new Client();
          $res = $client->request('POST', 'https://auth.robokassa.ru/Merchant/Recurring', [ 'form_params' => [ 'MrchLogin' => $mrh_login, 'OutSum' => $out_summ, 'PreviousInvoiceID' => $prev_inv_id, 'InvId' => $inv_id, 'SignatureValue' => $crc, 'Receipt' => $receipt, 'Desc' =>  $desc, ] ]);

          echo $response = $res->getBody()->getContents();

          //В случае отрицательного ответа сервера
          if ($response == 'OK'.$inv_id) {
            $don = Donator::where('id', $payment->donator_id)->first();

            $data = [
                'name' => $don->name,
            ];
dd($don->email);
            Mail::to($don->email)->send(new LossRecur($data));

          }

        }
		Storage::append('cron2.html', Carbon::now()->format('Y-m-d H:i:s'));
    $forLog = 'Рекурентный № '.$inv_id. ' от '. Carbon::now()->format('Y-m-d H:i:s').'. Ответ сервера РК - '.$response;
    Storage::append('public/recur_orders.txt', $forLog);
    }

    public function execute(Recurring $recurrings) {

      if (!Auth::guard('admin_guard')->check()) {
        return redirect('/login');
    }

      return view('admin.recurrings.index', [
        'recurrings' => Recurring::where('unsubscribed',NULL)->orderBy('created_at', 'desc')->paginate(10)
      ]);
    }

    public function destroy(Recurring $recurring)
    {
        $donator = Donator::where('id', $recurring->donator_id)->first();
        if (Auth::guard('admin_guard')->check() || Auth::guard('user_guard')->user()->id == $donator->id ) {

            $recurring->unsubscribed = Carbon::now()->format('Y-m-d H:i:s');
            $recurring->save();

            $donator->monthly = 'Разово';
            $donator->save();
        }
        return redirect()->back();
    }
}
