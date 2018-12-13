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
use Carbon\Carbon;
use Cookie;

class VideosController extends Controller
{
    //
    public function __construct() {
      //Проверка авторизации
        $this->middleware('IsUser');
    }

    public function execute(Device $device, $course, Request $request, VegaUser $vegauser, VegaPayment $vegapayment) {

      $id = Auth::guard('user_guard')->user()->id;

      $payment = VegaPayment::where('user_id', $id)->where('course_id', $course)->orderBy('created_at', 'desc')->first();

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
      if (($current_date->gt($finish_date))) {
        return redirect()->back()
          ->withErrors('К сожалению время действия Вашего пароля для данного курса (90 дней) уже истекло.')
          ->withInput();
      }

      //Проверка трех девайсов
      if (!isset($_COOKIE['dev'])) {
          $devices = Device::where('user_id', $id)->where('course_id', $course)->get();
          if ($devices->count() == 3) {
            return redirect()->back()
              ->withErrors('К сожалению Вы можете использовать Ваш пароль только на трех устройствах. Обратитесь пожалуйста в техподдержку.')
              ->withInput();
          }
          else {
            $device->user_id = $id;
            $device->course_id = $course;
            $device->device = str_random(8);;
            $device->save();
            setcookie("dev", $device->device, time()+7862400);
          }
      }
      else {
        $search_device = Device::where('user_id', $id)->where('course_id', $course)->where('device', $_COOKIE['dev'])->first();
        if (!isset($search_device->id)) {
          return redirect()->back()
            ->withErrors('К сожалению Вы можете использовать Ваш пароль только на трех устройствах. Обратитесь пожалуйста в техподдержку.')
            ->withInput();
        }
      }

      //Вывод страницы
      return view('site.vega.course_page', [
        'format' => Format::where('id', $payment->course_id)->first(),
      ]);

      //if (isset($_COOKIE['dev'])) dump($_COOKIE['dev']);

    }
}
