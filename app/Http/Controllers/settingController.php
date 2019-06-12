<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class settingController extends Controller
{
    public function __construct() {

          //$this->middleware('auth');
    }

    public function execute(Request $request) {

      return view('admin.settings.index', [
        'settings' => Setting::first(),
      ]);
    }

    public function update(Request $request, Setting $setting)
    {
        //dump($request->all());

          $setting->mrh_login = $request->mrh_login;
          if($request->mrh_pass1)$setting->mrh_pass1 = $request->mrh_pass1;
          if($request->mrh_pass2)$setting->mrh_pass2 = $request->mrh_pass2;
          $setting->inv_desc = $request->inv_desc;
          if($request->test_mode)$setting->test_mode = 1; else $setting->test_mode = 0;
          $setting->test_pass1 = $request->test_pass1;
          $setting->test_pass2 = $request->test_pass2;
          $setting->save();

          return view('admin.settings.index', [
            'settings' => Setting::first(),
          ]);
    }
}
