<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Payment;
use App\Donator;
use App\Recurring;
use App\Format;
use Carbon\Carbon;

class PaymentsController extends Controller
{
  public function __construct() {

        $this->middleware('auth');
  }

  public function execute(Payment $payments) {

    return view('admin.payments.index', [
      'payments' => Payment::where('confirmation','!=',NULL)->orderBy('created_at', 'desc')->paginate(10)
    ]);
  }

  public function execute_sort(Payment $payments, $sort) {

    return view('admin.payments.index', [
      'payments' => Payment::where('confirmation','!=',NULL)->orderBy($sort)->paginate(10)
    ]);
  }

  public function execute_id(Payment $payments, $id) {//Полные данные по жертвователю

    $recurring = Recurring::where('unsubscribed',NULL)->where('donator_id', $id)->first();
    if(isset($recurring->format_id))$format = Format::where('id', $recurring->format_id)->first();
    else $format = NULL;
    return view('admin.payments.id', [
      'payments' => Payment::where('confirmation','!=',NULL)->where('donator_id', $id)->paginate(500),
      'donator' => Donator::where('id', $id)->first(),
      'recurring' => $recurring,
      'format' => $format
    ]);
  }

  public function destroy(Payment $payment)
  {
      $payment->delete();
      return redirect()->route('admin.payments');
  }

  public function stat() {

    $result = array();
    $formats = Format::all();//Коллекция из столбца групп
    foreach($formats as $format){$result[$format->id] = $format->name;}
    //dd($result);

    $month_now = Carbon::now()->format('m');echo '<br>';//Текущий месяц
    $year_now = Carbon::now()->format('Y');echo '<br>';//Текущий год

      $year = $year_now;//Текущий год
        for ($month=$month_now; $month > 0 ; $month--) {//Перебираем месяцы
          $month_result = array();

          $month_result[] = $month.'.'.$year;
          foreach ($result as $format_id=>$format_name){

            $month_array = array();
            $summ = 0;
            $month_line = Payment::where('confirmation','!=',NULL)
                                   ->where('format_id', $format_id)
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
            $month_result[] = $summ;
          };
          $year_result[] = $month_result;
        }

        $year = $year_now-1;
          for ($month=12; $month > $month_now ; $month--) {
            $month_result = array();

            $month_result[] = $month.'.'.$year;
            foreach ($result as $format_id=>$format_name){
              $month_array = array();
              $summ = 0;
              $month_line = Payment::where('confirmation','!=',NULL)
                                     ->where('format_id', $format_id)
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
              $month_result[] = $summ;
            };
            $year_result[] = $month_result;
          }

          //Вычисляем кол-во отписавшихся
          $year = $year_now;//Текущий год
          $month_results = array();
            for ($month=$month_now; $month > 0 ; $month--) {//Перебираем месяцы
            $month_results[] = array('year'=>$year, 'month'=>$month);
            }
          $year = $year_now-1;//Прошлый год
            for ($month=12; $month > $month_now ; $month--) {
              $month_results[] = array('year'=>$year, 'month'=>$month);
            }

            foreach ($month_results as $month_result){
              $summ = 0;
              $month_array = array();
              $month_line = Recurring::where('unsubscribed','!=',NULL)
                                               ->whereYear('unsubscribed', $month_result['year'])
                                               ->whereMonth('unsubscribed', $month_result['month'])
                                               ->get();

              $unsubscribed[] = $month_line->count();
            };

    return view('admin.payments.stat', [
      'formats' => $result,
      'year_results' => $year_result,
      'months' => $month_results,
      'unsubscribeds' => $unsubscribed,
    ]);

  }

}
