<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Course_payment;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CoursePaymentsController extends Controller
{
    public function forms($nic, Request $request) {

      $course = Course::where('nic',$nic)->first();
      if(isset($course->module))$modules = explode("\n", $course->module);
      else abort(404);

      return view('site.courses.form', [
        'course' => $course,
        'modules'  => $modules,
      ]);
    }
    //----------------------------------------------------------------
    public function form_check($nic, Request $request, Course_payment $payment, Course $courses) {

    $validator = $this->validate($request, [
      'summ' => 'required|integer',
      'name' => 'required|string|max:100',
      'email' => 'required|email',
      'group' => 'required|integer',
      'module' => 'required|string|max:250',
    ]);

    $course = Course::where('nic', $nic)->first();

    $payment->name = $request->name;
    $payment->email = $request->email;
    $payment->group_id = $request->group;
    $payment->course_id = $course->id;
    $payment->course_name = $course->name;
    $payment->module = $request->module;
    $payment->summ = $request->summ;
    $payment->confirmation = $request->confirmation;
    $payment->save();

    $payment_id = $payment->id;

    $setting = Setting::first();

    // регистрационная информация (Идентификатор магазина, пароль #1)
      $mrh_login = $setting->mrh_login;

      if($setting->test_mode == 1)$mrh_pass1 = $setting->test_pass1;
      else $mrh_pass1 = $setting->mrh_pass1;
      // номер заказа
      $inv_id = $payment_id+1000000;

      // описание заказа
      $inv_desc = 'Оплата: '.$payment->course_name.' - '.$payment->module;

      // сумма заказа
      $out_summ = $payment->summ;

      // кодировка
      $encoding = "utf-8";

      // Адрес электронной почты покупателя
      $Email = $payment->email;

      //Фискальная информация URL-кодировать. Параметр включается в контрольную подпись запроса (после номера счета магазина). Например: MerchantLogin:OutSum:InvId:Receipt:Пароль#1
      $receipt = '{"sno": "usn_income","items":[{"name": "'.$inv_desc.'","quantity": 1.0,"sum": '.$out_summ.'.0,"tax": "none"}]}';
      $receipt = urlencode($receipt);

      //Периодический платеж ()
      //if($request->monthly == "Ежемесячно") $Recurring = true;
      //else
      $Recurring = false;

      //Тестовый режим
      if($setting->test_mode == 1)$IsTest = true;
      else $IsTest = false;

      // формирование подписи
      $crc  = md5("$mrh_login:$out_summ:$inv_id:$receipt:$mrh_pass1");
      //$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");

      return view('site.form_send', [
          'mrh_login' => $mrh_login,
          'out_summ' => $out_summ,
          'inv_id' => $inv_id,
          'inv_desc' => $inv_desc,
          'crc' => $crc,
          'Email' => $Email,
          'Receipt' => $receipt,
          'Recurring' => $Recurring,
          'IsTest' => $IsTest
      ]);
    }
    //----------------------------------------------------------------

    public function payments(Course_payment $payments) {

      if (!Auth::guard('admin_guard')->check()) {return redirect('/login');}

      return view('admin.courses.payments', [
        'payments' => Course_payment::where('confirmation','!=',NULL)->orderBy('created_at', 'desc')->paginate(10)
      ]);
    }
    //-----------------------------------------------------------------
    public function destroy(Course_payment $payment)
    {
        if (!Auth::guard('admin_guard')->check()) {return redirect('/login');}

        $payment->delete();
        return redirect()->route('admin.courses.payments');
    }

    public function search(Course_payment $payment, Request $request) {
        if(isset($request->email)){
          $validator = $this->validate($request, [
              'email' => 'required|string|email|max:255',
          ]);
          $payment = Course_payment::where('confirmation','!=',NULL)->where('email', $request->email)->first();
          if (isset($payment->id)) {
            return view('admin.courses.payments', [
              'payments' => Course_payment::where('confirmation','!=',NULL)->where('email', $request->email)->orderBy('created_at', 'desc')->paginate(10)
            ]);
          }
          else {
            return redirect()->back()
                                ->withErrors('Указанный Вами Email в базе не найден')
                                ->withInput();
          }
        }
        if(isset($request->group)){
          $validator = $this->validate($request, [
              'group' => 'required|int',
          ]);
          $payment = Course_payment::where('confirmation','!=',NULL)->where('group_id', $request->group)->first();
          if (isset($payment->id)) {
            return view('admin.courses.payments', [
              'payments' => Course_payment::where('confirmation','!=',NULL)->where('group_id', $request->group)->orderBy('created_at', 'desc')->paginate(10)
            ]);
          }
          else {
            return redirect()->back()
                                ->withErrors('Указанный Вами номер группы в базе не найден')
                                ->withInput();
          }
        }
      }

      public function stat(Course_payment $payments) {

        if (!Auth::guard('admin_guard')->check()) {return redirect('/login');}

        $result = array();
        $groups = Course_payment::where('confirmation','!=',NULL)->pluck('group_id');//Коллекция из столбца групп
        foreach($groups as $value){$result[] = $value;}
        $result = array_unique($result);

        $month_now = Carbon::now()->format('m');echo '<br>';
        $year_now = Carbon::now()->format('Y');echo '<br>';

          $year = $year_now;
            for ($month=$month_now; $month > 0 ; $month--) {
              $month_result = array();

              $month_result[] = $month.'.'.$year;
              foreach ($result as $group){

                $month_array = array();
                $summ = 0;
                $month_line = Course_payment::where('confirmation','!=',NULL)
                                       ->where('group_id', $group)
                                       ->whereYear('created_at', $year)
                                       ->whereMonth('created_at', $month)
                                       ->pluck('summ');

                $count = $month_line->count();
                if ($count == 0) {
                  $summ = 0;
                }
                else {
                  foreach($month_line as $value){$month_array[] = $value;}
                  //dd($month_array);
                  $summ = array_sum($month_array);
                }
                $month_result[] = $count.' / '.$summ;
              };
              $year_result[] = $month_result;
            }

            $year = $year_now-1;
              for ($month=12; $month > $month_now ; $month--) {
                $month_result = array();

                $month_result[] = $month.'.'.$year;
                foreach ($result as $group){
                  $month_array = array();
                  $summ = 0;
                  $month_line = Course_payment::where('confirmation','!=',NULL)
                                         ->where('group_id', $group)
                                         ->whereYear('created_at', $year)
                                         ->whereMonth('created_at', $month)
                                         ->pluck('summ');

                  $count = $month_line->count();
                  if ($count == 0) {
                    $summ = 0;
                  }
                  else {
                    foreach($month_line as $value){$month_array[] = $value;}
                    //dd($month_array);
                    $summ = array_sum($month_array);
                  }
                  $month_result[] = $count.' / '.$summ;
                };
                $year_result[] = $month_result;
              }

        //dd($year_result);

        return view('admin.courses.stat', [
          'groups' => $result,
          'year_results' => $year_result
        ]);
      }



}
