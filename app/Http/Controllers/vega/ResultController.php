<?php

namespace App\Http\Controllers\vega;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Format;
use App\VegaPayment;
use App\VegaUser;
use App\Setting;
use Carbon\Carbon;
use App\Mail\CoursMailMain;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonatPayConfirm;

class ResultController extends Controller
{
        public function result(Request $request, VegaUser $user, VegaPayment $payment) {
          //Storage::append('test.html', $request->all());
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
              //Вычисляем платеж и жертвователя
            $pay = VegaPayment::where('id', $inv_id)->first();
            $don = VegaUser::where('id', $pay->user_id)->first();
            $form = Format::where('id', $pay->format_id)->first();

            $pay->confirmation = Carbon::now()->format('Y-m-d H:i:s');
            $pay->save();//Подтверждение платежа в таблицу платежей

            $password = $this->generate_password(12);

            $don->last_payment = Carbon::now()->format('Y-m-d H:i:s');
            $don->password = Hash::make($password);
            $don->save();//Подтверждение и пароль пользователю в таблицу

            echo "OK$inv_id\n";

            //Отправка письма

            $format = Format::where('id', $pay->course_id)->first();

            //Отправка письма покупателю
            $data = [
                'name' => $don->name,
                'password' => $password,
                'email' => $don->email,
                'course' => $format->id,
                'format' => $pay->format
            ];

            Mail::to($don->email)->send(new DonatPayConfirm($data));

            //Отправка письма админу в случае курса с сопровождением
            if($pay->format == 3){//dd('!!!!');
                $data2 = [
                    'name' => $don->name,
                    'email' => $don->email,
                    'course' => $format->name,
                    'summ' => $pay->summ,
                ];
                $admin_email = "prostofoodonline@gmail.com";
                Mail::to($admin_email)->send(new CoursMailMain($data2));
            }

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

          $pay = Payment::where('id', $request->inv_id)->first();
          $format = Format::where('id', $pay->format_id)->first();
          //dd($pay->format_id);
          return view('site.success', [
            'text' => $format->success,
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
