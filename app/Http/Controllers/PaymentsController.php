<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Payment;
use App\Donator;

class PaymentsController extends Controller
{
  public function __construct() {

        $this->middleware('auth');
  }

  public function execute(Payment $payments) {

    return view('admin.payments.index', [
      'payments' => Payment::orderBy('created_at', 'desc')->paginate(10)
    ]);
  }

  public function execute_sort(Payment $payments, $sort) {

    return view('admin.payments.index', [
      'payments' => Payment::orderBy($sort)->paginate(10)
    ]);
  }

  public function execute_id(Payment $payments, $id) {

    return view('admin.payments.id', [
      'payments' => Payment::where('donator_id', $id)->paginate(500),
      'donator' => Donator::where('id', $id)->first()
    ]);
  }


}
