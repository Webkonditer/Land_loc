<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bonus_application;
use App\Donator;

class BonusApplicationController extends Controller
{
      public function __construct() {

            $this->middleware('auth');
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
}
