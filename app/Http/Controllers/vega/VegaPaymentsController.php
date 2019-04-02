<?php

namespace App\Http\Controllers\vega;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\VegaPayment;
use App\VegaUser;
use App\Format;
use Carbon\Carbon;
use Auth;

class VegaPaymentsController extends Controller
{
  public function __construct() {

        //$this->middleware('auth');
  }

  public function execute(VegaPayment $vegapayment) {

    return view('admin.VegaPayments.index', [
      'payments' => VegaPayment::where('confirmation','!=',NULL)->orderBy('created_at', 'desc')->paginate(10)
    ]);
  }

  public function execute_sort(VegaPayment $vegapayment, $sort) {

    return view('admin.VegaPayments.index', [
      'payments' => VegaPayment::where('confirmation','!=',NULL)->orderBy($sort)->paginate(10)
    ]);
  }

  public function execute_id(VegaPayment $vegapayment, $id) {//Полные данные по жертвователю

    $recurring = Recurring::where('unsubscribed',NULL)->where('donator_id', $id)->first();
    if(isset($recurring->format_id))$format = Format::where('id', $recurring->format_id)->first();
    else $format = NULL;
    return view('admin.payments.id', [
      'payments' => VegaPayment::where('confirmation','!=',NULL)->where('donator_id', $id)->paginate(500),
      'donator' => Donator::where('id', $id)->first(),
      'recurring' => $recurring,
      'format' => $format,
      'admin_email' => Auth::guard('admin_guard')->user()->email
    ]);
  }

  public function destroy(VegaPayment $vegapayment)
  {
      $vegapayment->delete();
      return redirect()->route('admin.vegapayments');
  }

  public function stat(VegaPayment $vegapayment) {

        $result = array();
        $groups = VegaPayment::where('confirmation','!=',NULL)->pluck('course_name');//Коллекция из столбца названий курсов
        foreach($groups as $value){$result[] = $value;}
        $result = array_unique($result);

        $month_now = Carbon::now()->format('m');//Текущие год и месяц
        $year_now = Carbon::now()->format('Y');

          $year = $year_now;
            for ($month=$month_now+0; $month > 0 ; $month--) {
              $month_result = array();

              $month_result[] = $month.'.'.$year;
              foreach ($result as $course_name){//Перебираем таблицу по названиям курсов

                //Обнуляем переменые
                $month_array_1 = array();
                $month_array_2 = array();
                $month_array_3 = array();
                $summ1 = 0;
                $summ2 = 0;
                $summ3 = 0;

                //Выборки по  курсам и по форматам
                $month_line_1 = VegaPayment::where('confirmation','!=',NULL)
                                       ->where('course_name', $course_name)
                                       ->where('format', 1)
                                       ->whereYear('created_at', $year)
                                       ->whereMonth('created_at', $month)
                                       ->pluck('summ');
                $month_line_2 = VegaPayment::where('confirmation','!=',NULL)
                                      ->where('course_name', $course_name)
                                      ->where('format', 2)
                                      ->whereYear('created_at', $year)
                                      ->whereMonth('created_at', $month)
                                      ->pluck('summ');
                $month_line_3 = VegaPayment::where('confirmation','!=',NULL)
                                     ->where('course_name', $course_name)
                                     ->where('format', 3)
                                     ->whereYear('created_at', $year)
                                     ->whereMonth('created_at', $month)
                                     ->pluck('summ');

                //Считаем суммы по каждому формату
                foreach($month_line_1 as $value_1){$month_array_1[] = $value_1;}
                $summ_1 = array_sum($month_array_1);
                foreach($month_line_2 as $value_2){$month_array_2[] = $value_2;}
                $summ_2 = array_sum($month_array_2);
                foreach($month_line_3 as $value_3){$month_array_3[] = $value_3;}
                $summ_3 = array_sum($month_array_3);

                $month_result[] = $summ_1.' / '.$summ_2.' / '.$summ_3;
              };
              $year_result[] = $month_result;
            }

            $year = $year_now-1;
              for ($month=12; $month > $month_now ; $month--) {
                $month_result = array();

                $month_result[] = $month.'.'.$year;
                foreach ($result as $course_name){//Перебираем таблицу по названиям курсов

                  //Обнуляем переменые
                  $month_array_1 = array();
                  $month_array_2 = array();
                  $month_array_3 = array();
                  $summ1 = 0;
                  $summ2 = 0;
                  $summ3 = 0;

                  //Выборки по  курсам и по форматам
                  $month_line_1 = VegaPayment::where('confirmation','!=',NULL)
                                         ->where('course_name', $course_name)
                                         ->where('format', 1)
                                         ->whereYear('created_at', $year)
                                         ->whereMonth('created_at', $month)
                                         ->pluck('summ');
                  $month_line_2 = VegaPayment::where('confirmation','!=',NULL)
                                        ->where('course_name', $course_name)
                                        ->where('format', 2)
                                        ->whereYear('created_at', $year)
                                        ->whereMonth('created_at', $month)
                                        ->pluck('summ');
                  $month_line_3 = VegaPayment::where('confirmation','!=',NULL)
                                       ->where('course_name', $course_name)
                                       ->where('format', 3)
                                       ->whereYear('created_at', $year)
                                       ->whereMonth('created_at', $month)
                                       ->pluck('summ');

                  //Считаем суммы по каждому формату
                  foreach($month_line_1 as $value_1){$month_array_1[] = $value_1;}
                  $summ_1 = array_sum($month_array_1);
                  foreach($month_line_2 as $value_2){$month_array_2[] = $value_2;}
                  $summ_2 = array_sum($month_array_2);
                  foreach($month_line_3 as $value_3){$month_array_3[] = $value_3;}
                  $summ_3 = array_sum($month_array_3);

                  $month_result[] = $summ_1.' / '.$summ_2.' / '.$summ_3;
                };
                $year_result[] = $month_result;
              }

        //dd($year_result);

        return view('admin.VegaPayments.stat', [
          'course_names' => $result,
          'year_results' => $year_result
        ]);
      }

}
