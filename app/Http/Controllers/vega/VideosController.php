<?php

namespace App\Http\Controllers\vega;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\VegaPayment;
use App\VegaUser;
use App\Format;
use App\Setting;
use App\Device;
use App\VegaChat;
use Carbon\Carbon;
use Cookie;
use App\Text;

class VideosController extends Controller
{
    //
    public function __construct() {
      //Проверка авторизации
        $this->middleware('IsUser');
    }

    public function execute(Device $device, Request $request, VegaUser $vegauser, VegaPayment $vegapayment, $course) {
//dd(Hash::make('12345'));
      $id = Auth::guard('user_guard')->user()->id;

      $format = Format::where('position', $course)->first();

      $payment = VegaPayment::where('user_id', $id)->where('course_id', $format->id)->orderBy('created_at', 'desc')->first();

      if ($id < 1000000)
        {
          //Оплачен ли даный курс
          if (!isset($payment->id)) {
            return redirect()->back()
              ->withErrors('К сожалению мы не нашли в базе сведений об оплате Вами данного курса. Обратитесь пожалуйста в техподдержку.')
              ->withInput();
          }

          //Не исткло ли 90 дней
          $date_of_pay =  Carbon::createFromFormat('Y-m-d H:i:s', $payment->created_at);
          $finish_date = $date_of_pay->addDays(90);
          $current_date = Carbon::now();
          if (($current_date->gt($finish_date)) && $payment->format == 1) {
            return redirect()->back()
              ->withErrors('К сожалению время действия Вашего пароля для данного курса (90 дней) уже истекло.')
              ->withInput();
          }

          //Проверка трех девайсов
          if (!isset($_COOKIE['dev'])) {//Если куков нет
              $devices = Device::where('user_id', $id)->get();
              if ($devices->count() == 3) {//Если куков уже три
                return redirect()->back()
                  ->withErrors('К сожалению Вы можете использовать Ваш пароль только на трех устройствах. Обратитесь пожалуйста в техподдержку.')
                  ->withInput();
              }
              else {//если куков меньше трех
                $device->user_id = $id;
                $device->course_id = $course;
                $device->device = str_random(8);
                $device->save();
                setcookie("dev", $device->device, time()+7862400);
              }
          }
          else {//Если куки уже есть
            $search_device = Device::where('user_id', $id)->where('device', $_COOKIE['dev'])->first();
            if (!isset($search_device->id)) {//Если левый кук, то до свидания!
              return redirect()->back()
                ->withErrors('К сожалению Вы можете использовать Ваш пароль только на трех устройствах. Обратитесь пожалуйста в техподдержку.')
                ->withInput();
            }
          }
        }

      //Вывод страницы
      $COOKIE_name = "course_".$format->id;
      if (isset($_COOKIE[$COOKIE_name])) $pages = ($_COOKIE[$COOKIE_name]);
      else $pages = 1;

      for ($i=1; $i <= $pages; $i++) {
        $text = "text_".$i;
        $video = "video_".$i;

        if(!$format->$video) {
          $pages = $pages-1;
          $end = true;
          break;
        }
        else {
          $end = false;
          $videos[$i] = array( "text" => $format->$text, "video" => $format->$video);
        }
      }
      //Переменные для чата
      if(isset(Auth::guard('admin_guard')->user()->email)) {
        $email = Auth::guard('admin_guard')->user()->email;
        $is_admin = 1;
        $nik = Auth::guard('admin_guard')->user()->name;//dd($nik);
      }
      else {
        if(isset(Auth::guard('user_guard')->user()->email)) {
          $email = Auth::guard('user_guard')->user()->email;
          $is_admin = 0;
          $nik = Auth::guard('user_guard')->user()->name;
        }
      }
      $pos = strpos($email, '@')+1;
      //$nik = substr($email, 0, $pos);


      //Тексты
      $texts_1 = Text::where('format_id', $format->id)->where('text_x', 1)->get();//dd($format->id);
      $texts_2 = Text::where('format_id', $format->id)->where('text_x', 2)->get();
      foreach ($texts_1 as $text_1) {
        $array1[$text_1->text_x_x] = $text_1->text;
      }
      foreach ($texts_2 as $text_2) {
        $array2[$text_2->text_x_x] = $text_2->text;
      }

      //dd($payment->course_id);
      return view('site.vega.course_page', [
        'format' => Format::where('id', $format->id)->first(),
        'videos' => $videos,
        'text_1' => $array1,
        'text_2' => $array2,
        'pages' => $pages,
        'end' => $end,
        'vegachats' => VegaChat::where('question_id', $format->id)->get(),
        'nik' => $nik,
        'is_admin' => $is_admin,
      ]);

      //if (isset($_COOKIE['dev'])) dump($_COOKIE['dev']);

    }
}
