<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Format;
use App\Donator;
use App\Payment;
use App\Setting;
use Carbon\Carbon;
use App\Recurring;
use App\Course;
use App\Course_payment;
use App\Course_pass;
use App\Mail\CoursMailMain;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonatPayConfirm;

class ResultController extends Controller
{
        public function result(Request $request, Donator $donator, Payment $payment, Recurring $recurrings) {

            // регистрационная информация (пароль #2)
            $setting = Setting::first();
            if($setting->test_mode == 1)$mrh_pass2 = $setting->test_pass2;
            else $mrh_pass2 = $setting->mrh_pass2;


            //Переменные из запроса
            $out_summ = $request->OutSum;
            $inv_id = $request->InvId;

            $crc = $request->SignatureValue;
            $crc = strtoupper($crc);

            //Вычисляем подпись
            $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));

            //Логируем подтверждение сервера РК
            $forLog = 'Подтверждение РК по чеку № '.$inv_id. ' получено '. Carbon::now()->format('Y-m-d H:i:s').'. Сумма - '.$out_summ.' Емейл отправителя - '.$request->EMail;
            Storage::append('public/rk_messages.txt', $forLog);
            // проверка корректности подписи
            if ($my_crc !=$crc)
              {
                echo "bad sign\n";
                Storage::append('public/rk_messages.txt', 'Цифровая подпись не совпадает. Обработка прервана.');
                exit();
              }


              //Платежи за курсы
              if ($inv_id > 1000000) {
                //Storage::append('test.html', $request);
                $course_payment = Course_payment::where('id', $inv_id-1000000)->first();
                $course_payment->confirmation = Carbon::now()->format('Y-m-d H:i:s');
                $course_payment->save();
                Storage::append('public/rk_messages.txt', 'Платеж внесен в базу.');

                $pass_line = Course_pass::where('course', $course_payment->course_name)->where('module', $course_payment->module)->first();
                if (isset($pass_line->password)) $password = $pass_line->password;
                else $password = '----------------';

                $course = Course::where('id', $course_payment->course_id)->first();
                echo "OK$inv_id\n";

                $text =
                '<div class="panel panel-default col-md-8 col-md-offset-2">
                <div class="panel-body">
                <p style="margin:0cm 0cm 10pt"><span style="font-size:11pt"><span style="line-height:115%"><span style="font-family:Calibri,sans-serif"></span></span></span></p>

                <p style="margin:0cm 0cm 10pt"><span style="font-size:11pt"><span style="line-height:115%"><span style="font-family:Calibri,sans-serif">Харе Кришна!</span></span></span></p>

                <p style="margin:0cm 0cm 10pt"><span style="font-size:11pt"><span style="line-height:115%"><span style="font-family:Calibri,sans-serif">Примите, пожалуйста, наши смиренные поклоны. Вся слава Шриле Прабхупаде.</span></span></span></p>

                <p style="margin:0cm 0cm 10pt"><span style="font-size:11pt"><span style="line-height:115%"><span style="font-family:Calibri,sans-serif">Благодарим Вас за дополнительный перевод!</span></span></span></p>

                <p style="margin:0cm 0cm 10pt"><span style="font-size:11pt"><span style="line-height:115%"><span style="font-family:Calibri,sans-serif">Ваши слуги,<br />
                Секретариат курса.</span></span></span></p>

                <p style="margin:0cm 0cm 10pt"><span style="font-size:11pt"><span style="line-height:115%"><span style="font-family:Calibri,sans-serif"></span></span></span></p>
                </div>
                </div>.';

                if($course_payment->module == 'Факультативная доплата за модуль'){
                  $mail_text = $text;
                  $password = '';
                }
                else {
                  $mail_text = $course->mail_text;
                }

                //Отправка письма
                $data = [
                    'name' => $course_payment->name,
                    'text' => $mail_text,
                    'password' => $password,
                ];

                Mail::to($course_payment->email)->send(new CoursMailMain($data));
                Storage::append('public/rk_messages.txt', 'Письмо отправлено.');

                //-------------------------------------------------

                exit();
              }

              //Клубные пожертвования
              //Вычисляем платеж и жертвователя
            $pay = Payment::where('id', $inv_id)->first();
            $don = Donator::where('id', $pay->donator_id)->first();
            $form = Format::where('id', $pay->format_id)->first();

            //Проверяем емейл на уникальность, сливаем при совпадении
            $email = $don->email;
            $old_don = Donator::where('last_payment','!=',NULL)->where('email', $email)->first();
            if(isset($old_don->id)){
              $don->created_at = $old_don->created_at;
              $don->bonus_points = $old_don->bonus_points;
              $id = $old_don->id;
              $old_don->delete();
              $don->id = $id;
              $don->save();
            }

            //Подтверждение платежа в таблицу платежей
            $pay->confirmation = Carbon::now()->format('Y-m-d H:i:s');
            $pay->donator_id = $don->id;
            $pay->save();

            //логирование
            Storage::append('public/rk_messages.txt', 'Платеж внесен в базу.');

            Storage::append('test_recuring.html', Carbon::now()->format('Y-m-d H:i:s'));
            Storage::append('test_recuring.html', $request->InvId);
            Storage::append('test_recuring.html', $pay->donator_id);
            Storage::append('test_recuring.html', $pay->monthly);
            Storage::append('test_recuring.html', $pay->repeated);
            Storage::append('test_recuring.html', $don->bonus_points);

            //Начисляем Чайтаньи
            if ($form->ctn > 0) {
              $don->bonus_points = $don->bonus_points + $form->ctn;
              $don->save();
              Storage::append('public/rk_messages.txt', 'Чайтаньи начислены.');
            }
            //Вносим изменения в профиль донора
            $don->last_payment = Carbon::now()->format('Y-m-d H:i:s');
            if ($pay->monthly == "Ежемесячно") $don->recurring = 'Да';
            $don->save();

            // Вносим изменения в таблицу ежемесячных
            if ($pay->monthly == "Ежемесячно") {
              if($pay->repeated != 'Рекурентный') {

                  //Отписываем пользователя от старой подписки
                  $old_recurring = Recurring::where('unsubscribed', NULL)->where('donator_id', $don->id)->first();
                  if(isset($old_recurring->id)){
                    $old_recurring->unsubscribed = Carbon::now()->format('Y-m-d H:i:s');
                    $old_recurring->save();
                  }
                  //Вносим в таблицу новую подписку
                  $recurrings->payment_id = $pay->id;
                  $recurrings->donator_id = $pay->donator_id;
                  $recurrings->format_id = $pay->format_id;
                  $recurrings->summ = $pay->summ;
                  $recurrings->save();
              }
            }

            echo "OK$inv_id\n";

            //Отправка письма

            $format = Format::where('id', $pay->format_id)->first();

            if($pay->repeated == 'Рекурентный') {
              $mail_text = '
              <p> Мы получили Ваш ежемесячный взнос. Спасибо Вам большое за Вашу поддержку!</p>
              ';
            }
            else $mail_text = $format->success;
            if($don->bonus_points == '') $bonus_points = 0;
            else $bonus_points = $don->bonus_points;

            //Отправка письма
            $data = [
                'name' => $don->name,
                'text' => $mail_text,
                'bonus_points' => $bonus_points,
            ];

            Mail::to($don->email)->send(new DonatPayConfirm($data));
            Storage::append('public/rk_messages.txt', 'Письмо отправлено.');

            //-------------------------------------------------
            exit();
        }

        public function success(Request $request) {

          if ($request->InvId > 1000000) {
              $course_payment = Course_payment::where('id', $request->InvId-1000000)->first();
              $course = Course::where('id', $course_payment->course_id)->first();

              $text =
              '
              <div class="panel panel-default col-md-8 col-md-offset-2">
              <div class="panel-body">
              <p style="margin:0cm 0cm 10pt"><span style="font-size:11pt"><span style="line-height:115%"><span style="font-family:Calibri,sans-serif"></span></span></span></p>

              <p style="margin:0cm 0cm 10pt"><span style="font-size:11pt"><span style="line-height:115%"><span style="font-family:Calibri,sans-serif">Харе Кришна!</span></span></span></p>

              <p style="margin:0cm 0cm 10pt"><span style="font-size:11pt"><span style="line-height:115%"><span style="font-family:Calibri,sans-serif">Примите, пожалуйста, наши смиренные поклоны. Вся слава Шриле Прабхупаде.</span></span></span></p>

              <p style="margin:0cm 0cm 10pt"><span style="font-size:11pt"><span style="line-height:115%"><span style="font-family:Calibri,sans-serif">Благодарим Вас за дополнительный перевод!</span></span></span></p>

              <p style="margin:0cm 0cm 10pt"><span style="font-size:11pt"><span style="line-height:115%"><span style="font-family:Calibri,sans-serif">Ваши слуги,<br />
              Секретариат курса.</span></span></span></p>

              <p style="margin:0cm 0cm 10pt"><span style="font-size:11pt"><span style="line-height:115%"><span style="font-family:Calibri,sans-serif"></span></span></span></p>
              </div>
              </div>.';

              if($course_payment->module == 'Факультативная доплата за модуль'){
                return view('site.success', [
                  'text' => $text,
                ]);
                exit();
              }

              return view('site.success', [
                'text' => $course->result_text,
              ]);
              exit();
          }
          //dd($request->InvId);
          $pay = Payment::where('id', $request->InvId)->first();

          $format = Format::where('id', $pay->format_id)->first();
          //dd($pay->format_id);
          return view('site.success', [
            'text' => $format->success,
          ]);
        }
}
