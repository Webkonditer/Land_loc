<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = Request::session()->get('_previous')['url'];
    protected function redirectTo()
      {
          if(session('next_url') != '') return session('next_url');
          else return '/course/1';
          //return $request->path();
          //return '/course/1';//session('_previous')['url'];//back()->getTargetUrl();
      }

      public function logout(Request $request)   {

           $this->guard()->logout();

           $request->session()->flush();

           $request->session()->regenerate();

           return redirect('/login');
       }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    protected function guard()
        {
            return Auth::guard('user_guard');
        }

}
