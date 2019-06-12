<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bonus_application;
use App\Donator;
use Carbon\Carbon;

class BonusApplicationController extends Controller
{
      public function __construct() {

            //$this->middleware('auth');
      }

      public function execute(Bonus_application $bonus_applications)
      {
        return view('admin.bonuses.index', [
          'new_applications' => $bonus_applications->whereNotIn('status', ['Обработана', 'Возврат'])->orderBy('created_at')->get(),
          'old_applications' => $bonus_applications->whereIn('status', ['Обработана', 'Возврат'])->orderBy('created_at')->get(),
        ]);
      }

      public function process(Request $request, Bonus_application $bonus_applications)
      {
        $application = $bonus_applications->where('id', $request->app_id)->first();
        $application->status = 'В процессе';
        $application->save();

        return redirect(route('admin.bonus.applications'));
      }

      public function processed(Request $request, Bonus_application $bonus_applications)
      {
        $application = $bonus_applications->where('id', $request->app_id)->first();
        $application->status = 'Обработана';
        $application->save();

        $donator = Donator::where('id', $request->donator)->first();
        $donator->bonus_points = $donator->bonus_points - $request->summ;
        $donator->save();

        return redirect(route('admin.bonus.applications'));
      }

      public function return(Request $request, Bonus_application $bonus_applications)
      {
        $application = $bonus_applications->where('id', $request->app_id)->first();
        $application->status = 'Возврат';
        $application->save();

        $donator = Donator::where('id', $request->donator)->first();
        $donator->bonus_points = $donator->bonus_points + $request->summ;
        $donator->save();

        return redirect(route('admin.bonus.applications'));
      }

      public function stat() {

        $month_now = Carbon::now()->format('m');echo '<br>';//Текущий месяц
        $year_now = Carbon::now()->format('Y');echo '<br>';//Текущий год

        $year = $year_now;//Текущий год
        $month_results = array();
          for ($month=$month_now; $month > 0 ; $month--) {//Перебираем месяцы
          $month_results[] = array('year'=>$year, 'month'=>$month);
          }
        $year = $year_now-1;
          for ($month=12; $month > $month_now ; $month--) {
            $month_results[] = array('year'=>$year, 'month'=>$month);
          }

          foreach ($month_results as $month_result){
            $summ = 0;
            $month_array = array();
            $month_line = Bonus_application::where('status','Обработана')
                                             ->whereYear('created_at', $month_result['year'])
                                             ->whereMonth('created_at', $month_result['month'])
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
            $month_summ[] = $summ*25;
          };

              //Вычисляем общую сумму бонусных баллов
              $donator_line = Donator::where('last_payment','!=',NULL)->pluck('bonus_points');
              $count = $donator_line->count();
              if ($count == 0) {
                $donator_summ = 0;
              }
              else {
                foreach($donator_line as $value){$donator_array[] = $value;}
                //dd($month_array);
                $donator_summ = array_sum($donator_array)*25;
              }

        return view('admin.bonuses.stat', [
          'months' => $month_results,
          'month_summs' => $month_summ,
          'donator_summ' => $donator_summ
        ]);

      }
}
