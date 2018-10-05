<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Payment;

class DonatorsController extends Controller
{
    public function __construct() {

          $this->middleware('auth');
    }

    public function execute(Donator $donators) {

      return view('admin.donators.index', [
        'donators' => Donator::where('last_payment','!=',NULL)->orderBy('created_at', 'desc')->paginate(10)
      ]);
    }

    public function execute_sort(Donator $donators, $sort) {

      return view('admin.donators.index', [
        'donators' => Donator::where('last_payment','!=',NULL)->orderBy($sort)->paginate(10)
      ]);
    }

    public function execute_monthly(Donator $donators, $sort) {

      return view('admin.donators.monthly', [
        'donators' => Donator::where('last_payment','!=',NULL)->where('monthly', 'Ежемесячно')->orderBy($sort)->paginate(10)
      ]);
    }

    public function execute_one_time(Donator $donators, $sort) {

      return view('admin.donators.one_time', [
        'donators' => Donator::where('last_payment','!=',NULL)->where('monthly', 'Разово')->orderBy($sort)->paginate(10)
      ]);
    }

    public function destroy(Donator $donator)
    {
        $delPayments = Payment::where('donator_id', $donator->id)->delete();
        $donator->delete();
        return redirect()->route('admin.donators');

    }
}
