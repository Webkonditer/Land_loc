<?php

namespace App\Http\Controllers\vega;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\VegaPayment;
use App\VegaUser;
use App\Format;
use App\Setting;

class VideosController extends Controller
{
    //
    public function __construct() {

        $this->middleware('IsUser');
    }

    public function execute($course, Request $request, VegaUser $vegauser, VegaPayment $vegapayment) {

      var_dump($course);
      dd($request);

    }

}
