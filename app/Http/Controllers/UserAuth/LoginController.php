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
          //if(session('next_url') != '') return session('next_url');
          //else return '/';
          //return Request::session()->get('_previous')['url'];
          return back()->getTargetUrl();
      }

    protected $redirectAfterLogout = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request)
        {
            //$next_url = session('_previous')['url'];
            //session(['next_url' => $next_url]);
            //dd(back()->getTargetUrl());
            if(Auth::guard('user_guard')->user()) return redirect('/');
            return view('user.login');
        }

    protected function guard()
        {
            return Auth::guard('user_guard');
        }

}
