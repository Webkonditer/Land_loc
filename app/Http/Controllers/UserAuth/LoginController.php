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
          return session('next_url');
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
            //print_r($request->session(['attributes']));
            //dd($request->session()->get('_previous')['url']);
            //dd(session('_previous')['url']);
            $next_url = session('_previous')['url'];

            session(['next_url' => $next_url]);
            //dd(session('next_url'));
            return view('user.login');
        }
    protected function guard()
        {
            return Auth::guard('user_guard');
        }

}
