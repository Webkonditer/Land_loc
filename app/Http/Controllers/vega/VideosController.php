<?php

namespace App\Http\Controllers\vega;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\VegaPayment;
use App\VegaUser;
use App\Format;
use App\Setting;
use Carbon\Carbon;
use Cookie;
use Illuminate\Cookie\CookieJar;

class VideosController extends Controller
{
    //
    public function __construct() {

        $this->middleware('IsUser');
    }

    public function execute(CookieJar $cookieJar, $course, Request $request, VegaUser $vegauser, VegaPayment $vegapayment) {

      $id = Auth::guard('user_guard')->user()->id;

      $payment = VegaPayment::where('user_id', $id)->where('course_id', $course)->orderBy('created_at', 'desc')->first();

      if (!isset($payment->id)) {
        return redirect()->back()
          ->withErrors('К сожалению мы не нашли в базе сведений об оплате Вами данного курса. Обратитесь пожалуйста в техподдержку.')
          ->withInput();
      }

      $date_of_pay =  Carbon::createFromFormat('Y-m-d H:i:s', $payment->created_at);
      $finish_date = $date_of_pay->addDays(90);
      $current_date = Carbon::now();

      if (($current_date->gt($finish_date))) {
        return redirect()->back()
          ->withErrors('К сожалению время действия Вашего пароля для данного курса уже истекло.')
          ->withInput();
      }


//if (!$request->cookie('device')) {
    Cookie::queue(Cookie::make('name', 'value', 4500));
    $cookieJar->queue(cookie('name', $request->referrer, 45000));
//}

// вывод Cookie
dump($request->cookie());
//return response('Hello World')->withCookie(cookie('name', 'name',10));

$response = new \Illuminate\Http\Response(view('auth.login'));
$response->withCookie(cookie('name', $request->referrer, 45000));
return $response;




      foreach ($payments as $payment) {

      }
      dump($payments);
      dd($request);

    }

}
