<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Format;
use App\Donator;
use App\Payment;
use App\Setting;
use Carbon\Carbon;
use App\Recurring;
use App\Course;
use App\Course_payment;

class ResultController extends Controller
{
        public function result(Request $request, Donator $donator, Payment $payment, Recurring $recurrings) {

            // регистрационная информация (пароль #2)
            $setting = Setting::first();
            if($setting->test_mode == 1)$mrh_pass2 = $setting->test_pass2;
            else $mrh_pass2 = $setting->mrh_pass2;

            //установка текущего времени
            //File::put('request', dump($request));

            $out_summ = $request->OutSum;
            $inv_id = $request->InvId;
            $crc = $request->SignatureValue;

            $crc = strtoupper($crc);

            $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));

            // проверка корректности подписи
            if ($my_crc !=$crc)
              {
                echo "bad sign\n";
                Storage::append('test_down.html', 'Пароль не совпадает');
                exit();
              }

              //Платежи за курсы
              if ($inv_id > 1000000) {
                Storage::append('test.html', $request);
                $course_payment = Course_payment::where('id', $inv_id-1000000)->first();
                $course_payment->confirmation = Carbon::now()->format('Y-m-d H:i:s');
                exit();
              }

            $pay = Payment::where('id', $inv_id)->first();
            $don = Donator::where('id', $pay->donator_id)->first();

            // признак успешно проведенной операции
            $old_donator = Donator::where('id','!=', $don->id)->where('email', $don->email)->first();
            if (isset($old_donator->id)) {
              $id = $old_donator->id;
              $reg_date = $old_donator->created_at;
              $recurring = $old_donator->recurring;
              $anonim = $old_donator->anonim;
              $monthly = $old_donator->monthly;
              $old_donator->delete(); //При совпадении убираем старого жертвователя
              $don->id = $id; //Его ид отдаем новому
              if ($recurring == 'Да')$don->recurring = $recurring; //Согласие на ежемесячные
              if ($don->anonim == 'Нет') $don->anonim = $anonim; //Анонимность
              if ($monthly == 'Ежемесячно') $don->monthly = $monthly; //Ежемесячно
              $pay->donator_id = $id;//Меняем ид донатора у платежа
            }

            $pay->confirmation = Carbon::now()->format('Y-m-d H:i:s');
            $pay->save();//Подтверждение платежа в таблицу платежей

            $don->last_payment = Carbon::now()->format('Y-m-d H:i:s');
            $don->save();//Подтверждение платежа в таблицу платежей

            if ($pay->monthly == "Ежемесячно") {
              if($pay->repeated != 'Рекурентный') {
                  //$recurrings = Recurring;// В таблицу ежемесячных

                  $recurrings->payment_id = $pay->id;
                  $recurrings->donator_id = $pay->donator_id;
                  $recurrings->format_id = $pay->format_id;
                  $recurrings->summ = $pay->summ;
                  $recurrings->save();
              }

            }

            echo "OK$inv_id\n";

            //Отправка письма
            $to = $don->email;
            $subject = 'Уведомление о платеже';
            $url = route('home').'/unsubscribe/'.$don->email.'/69483'.$don->id.'5739';
            $format = Format::where('id', $pay->format_id)->first();

            $message = '
            <html>
                <head>
                    <title>Уведомление о платеже</title>
                    <meta charset="utf8">
                </head>
                <body>
                    <h2>Здравствуйте, '.$don->name.'!</h2>
                    '.$format->success.'
                </body>
            </html>
            ';

            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=utf8';
            $headers[] = 'From: bhaktilata.ru <info@bhaktilata.ru>';

            $result = mail($to, $subject, $message, implode("\r\n", $headers));
            //echo $result ? 'OK' : 'Error';

            //-------------------------------------------------
            exit();
        }

        public function success(Request $request) {

          $pay = Payment::where('id', $request->inv_id)->first();
          $format = Format::where('id', $pay->format_id)->first();
          //dd($pay->format_id);
          return view('site.success', [
            'text' => $format->success,
          ]);
        }
}
