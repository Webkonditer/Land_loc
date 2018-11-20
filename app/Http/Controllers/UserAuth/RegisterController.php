<?php

namespace App\Http\Controllers\UserAuth;

use App\Donator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function redirectTo()
      {
          return session('next_url');
      }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request, Donator $donator)
    {
          $validator = $this->validate($request, [

            'name' => 'required|string|max:200',
            'email' => 'required|string|email|max:255|unique:donators',
            'phone' => 'required|integer',
            'city' => 'required|string|max:100',
            'password' => 'required|string|min:6|confirmed',
          ]);

    //dd($request);
          $donator->name = $request->name;
          $donator->email = $request->email;
          $donator->phone = $request->phone;
          $donator->city = $request->city;
          $donator->password = Hash::make($request->password);
          $donator->format_name = '-';
          $donator->monthly = '-';
          $donator->summ = 0;
          $donator->recurring = '-';
          $donator->anonim = 'Нет';
          $donator->save();

          //$next_url = session('_previous')['url'];

          //session(['next_url' => $next_url]);
          //dd(session('next_url'));
          return redirect()->back()
                              ->withErrors('Вы успешно зарегистрированы.Теперь войдите, используя Ваш email и пароль.');
    }
}
