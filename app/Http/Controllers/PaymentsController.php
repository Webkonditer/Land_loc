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

}
