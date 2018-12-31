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

      if(isset(Auth::guard('admin_guard')->user()->email)) {
        $email = Auth::guard('admin_guard')->user()->email;
        $is_admin = 1;
      }
      else {
        if(isset(Auth::guard('user_guard')->user()->email)) {
          $email = Auth::guard('user_guard')->user()->email;
          $is_admin = 0;
        }
        else {
          return redirect()->route('login');
        }
      }
      $pos = strpos($email, '@')+1;
      $nik = substr($email, 0, $pos);
      return view('site.vega.chat', [
        'vegachats' => $vegachat->get(),
        'nik' => $nik,
        'is_admin' => $is_admin,
      ]);

    }

    public function new_message(Request $request, VegaPayment $vegapayment, VegaChat $vegachat) {

      $vegachat->question_id = $request->question_id;
      $vegachat->nik = $request->nik;
      $vegachat->question = $request->message;
      if(isset(Auth::guard('admin_guard')->user()->email)) $vegachat->answer = 1;
      $vegachat->save();

      return redirect()->back();
    }

    public function delete(VegaChat $vegachat) {
      $vegachat->delete();
      return redirect()->back();
    }


}
