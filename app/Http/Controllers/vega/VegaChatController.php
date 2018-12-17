<?php

namespace App\Http\Controllers\vega;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\VegaPayment;
use App\VegaUser;
use App\VegaChat;
use App\Format;
use Carbon\Carbon;

class VegaChatController extends Controller
{
    public function __construct() {
      //Проверка авторизации
        $this->middleware('IsUser');
    }

    public function execute(VegaUser $vegauser, VegaChat $vegachat) {

      return view('site.vega.chat', [
        'vegachat' => $vegachat,
      ]);

    }

    public function new_question(VegaUser $vegauser, VegaPayment $vegapayment) {

      $id = Auth::guard('user_guard')->user()->id;
      $email = Auth::guard('user_guard')->user()->email;
      $pos = strpos($email, '@')+1;
      $nik = substr($email, 0, $pos);
      dd($nik);

    }

}
