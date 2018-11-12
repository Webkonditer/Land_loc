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

            // проверка корректности подписи
            if ($my_crc !=$crc)
              {
                echo "bad sign\n";
                //Storage::append('test_down.html', 'Пароль не совпадает');
                exit();
              }

              //Платежи за курсы
              if ($inv_id > 1000000) {
                //Storage::append('test.html', $request);
                $course_payment = Course_payment::where('id', $inv_id-1000000)->first();
                $course_payment->confirmation = Carbon::now()->format('Y-m-d H:i:s');
                $course_payment->save();

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
                $to = $course_payment->email;
                $subject = 'Уведомление о платеже';

                $message = '
                <html>
                    <head>
                        <title>Уведомление о платеже</title>
                        <meta charset="utf8">
                    </head>
                    <body>
                        <h2>Здравствуйте, '.$course_payment->name.'!</h2>
                        '.$mail_text.'
                        <h3>Ваш пароль: '.$password.'</h3>
                    </body>
                </html>
                ';

                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: text/html; charset=utf8';
                $headers[] = 'From: iskconclub.ru <info@iskconclub.ru>';

                $result = mail($to, $subject, $message, implode("\r\n", $headers));
                //echo $result ? 'OK' : 'Error';

                //-------------------------------------------------

                exit();
              }
              // Пожертвования
              //Вычисляем платеж и жертвователя
            $pay = Payment::where('id', $inv_id)->first();
            $don = Donator::where('id', $pay->donator_id)->first();
            $form = Format::where('id', $pay->format_id)->first();

            /*
            // Меняем данные жертвователя
            $old_donator = Donator::where('id','!=', $don->id)->where('email', $don->email)->first();
            if (isset($old_donator->id)) {
              $id = $old_donator->id;
              $reg_date = $old_donator->created_at;
              $recurring = $old_donator->recurring;
              $anonim = $old_donator->anonim;
              $monthly = $old_donator->monthly;
              $ctn = $old_donator->bonus_points;
              $old_donator->delete(); //При совпадении убираем старого жертвователя
              $don->id = $id; //Его ид отдаем новому
              $don->bonus_points = $ctn;
              if ($recurring == 'Да')$don->recurring = $recurring; //Согласие на ежемесячные
              if ($don->anonim == 'Нет') $don->anonim = $anonim; //Анонимность
              if ($monthly == 'Ежемесячно') $don->monthly = $monthly; //Ежемесячно
              $pay->donator_id = $id;//Меняем ид донатора у платежа
            }
            */

            //Подтверждение платежа в таблицу платежей
            $pay->confirmation = Carbon::now()->format('Y-m-d H:i:s');
            $pay->save();

            //Начисляем бонусы
            if ($form->ctn > 0) {
              $don->bonus_points = $don->bonus_points + $form->ctn;
            }

            //Отметка донатору о последнем платеже
            $don->last_payment = Carbon::now()->format('Y-m-d H:i:s');
            $don->save();

            //Если родительский, вносим в таблицу рекурентных
            if ($pay->monthly == "Ежемесячно") {
              if($pay->repeated != 'Рекурентный') {
                  $recurrings->payment_id = $pay->id;
                  $recurrings->donator_id = $pay->donator_id;
                  $recurrings->format_id = $pay->format_id;
                  $recurrings->summ = $pay->summ;
                  $recurrings->save();
              }
            }

            //Говорим ок робокасе
            echo "OK$inv_id\n";

            //Отправка письма
            $to = $don->email;
            $subject = 'Уведомление о платеже';
            $url = route('home').'/unsubscribe/'.$don->email.'/69483'.$don->id.'5739';
            $format = Format::where('id', $pay->format_id)->first();

            if($pay->repeated == 'Рекурентный') {
                $message_text = 'Мы получили Ваш ежемесячный платеж. Спаибо Вам большое!';//текст для рекурентного
            }
            else $message_text = $format->success;//текст для разового или родительского

            $message = '
            <html>
                <head>
                    <title>Уведомление о платеже</title>
                    <meta charset="utf8">
                </head>
                <body>
                    <h2>Здравствуйте, '.$don->name.'!</h2>
                    '.$message_text.'
                    <p>Ваш бонусный счет сейчас: '.$don->bonus_points.' Чайтаний.
                </body>
            </html>
            ';

            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=utf8';
            $headers[] = 'From: iskconclub.ru <info@iskconclub.ru>';

            $result = mail($to, $subject, $message, implode("\r\n", $headers));
            //echo $result ? 'OK' : 'Error';

            //-------------------------------------------------
            exit();
        }

        public function success(Request $request) {

          //страница успеха для платежей за курсы
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

          //страница успеха для пожертвований
          $pay = Payment::where('id', $request->inv_id)->first();
          $format = Format::where('id', $pay->format_id)->first();
          //dd($pay->format_id);
          return view('site.success', [
            'text' => $format->success,
          ]);
        }
}