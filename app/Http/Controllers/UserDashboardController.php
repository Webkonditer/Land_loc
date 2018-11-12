<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Donator;
use App\Recurring;
use App\Format;
use Auth;

class UserDashboardController extends Controller
{
  //Выдаем личный кабинет пользователю
  public function execute(Payment $payments) {

    $id = Auth::guard('user_guard')->user()->id;

    $recurring = Recurring::where('unsubscribed',NULL)->where('donator_id', $id)->first();
    if(isset($recurring->format_id))$format = Format::where('id', $recurring->format_id)->first();
    else $format = NULL;
    return view('site.dashboard.index', [
      'payments' => Payment::where('confirmation','!=',NULL)->where('donator_id', $id)->paginate(500),
      'donator' => Donator::where('id', $id)->first(),
      'recurring' => $recurring,
      'format' => $format
    ]);
  }

  //Пользователь меняет свои Данные
  public function edit(Request $request) {

    $id = Auth::guard('user_guard')->user()->id;
    $donator = Donator::where('id', $id)->first();

    $validator = $this->validate($request, [
        'name' => 'sometimes|required|string|max:100',
        'phone' => 'sometimes|required|integer|min:10000',
        'city' => 'sometimes|required|string|max:100',
        'anonim' => 'sometimes|required|string|max:3',
    ],
    $messages = [
      'name.required' => 'Поле имя не может быть пустым',
      'phone.integer' => 'Поле телефона должно содержать только цифры',
      'phone.min' => 'Поле телефона должно содержать не менее 5 цифр',
      'city.required' => 'Поле город не может быть пустым',
      'anonim.required' => 'Поле анонимность не может быть пустым',
    ]);

    if (isset($request->name)) {
      $donator->name = $request->name;
    }
    if (isset($request->phone)) {
      $donator->phone = $request->phone;
    }
    if (isset($request->city)) {
      $donator->city = $request->city;
    }
    if (isset($request->anonim)) {
      $donator->anonim = $request->anonim;
    }
    $donator->save();

    return redirect()->back();
  }
}
