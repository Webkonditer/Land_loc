<?php

namespace App\Http\Controllers\Vega;

use Illuminate\Http\Request;
use App\VegaPayment;
use App\VegaUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Format;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class VegaUsersController extends Controller
{
    public function __construct() {

          //$this->middleware('auth');
    }

    public function execute(VegaUser $vegauser) {

      return view('admin.VegaUsers.index', [
        'vegausers' => VegaUser::where('last_payment','!=',NULL)->orderBy('created_at', 'desc')->paginate(10)
      ]);
    }

    public function execute_sort(VegaUser $vegauser, $sort) {

      return view('admin.VegaUsers.index', [
        'vegausers' => VegaUser::where('last_payment','!=',NULL)->orderBy($sort)->paginate(10)
      ]);
    }


    public function destroy(VegaUser $vegauser)
    {
        $delPayments = VegaPayment::where('user_id', $vegauser->id)->delete();
        $vegauser->delete();
        return redirect()->route('admin.vegausers');

    }

    public function new_password(VegaUser $vegauser, Request $request)
    {
        $validator = $this->validate($request, [
            'new_password' => 'required|string|min:8',
        ]);

        $vegauser = VegaUser::where('id', $request->id)->first();
        $vegauser->password = Hash::make($request->new_password);
        $vegauser->save();

        return redirect()->route('admin.vegausers')
              ->withErrors('Пароль успешно изменен');

    }

    public function search(VegaUser $vegauser, Request $request) {

        if(isset($request->email)) {
            $validator = $this->validate($request, [
                'email' => 'required|string|email|max:255',
            ]);
            $dons = VegaUser::where('last_payment','!=',NULL)->where('email', $request->email)->get();
            if ($dons->count() > 0) {
              return view('admin.donators.search', [
                'donators' => $dons
              ]);
            }
            else {
              return redirect('admin/donators')
                                  ->withErrors('Указанный Вами Email в безе не найден')
                                  ->withInput();
            }
        }
    }
}
