<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\People;
use App\Page;
use App\Service;
use App\Portfolio;

class IndexController extends Controller
{
    //
    public function execute(Request $request) {

      //$pages = Page::all();
      //$portfolios = Portfolio::get(array('name','filter','images'));
      //$services = Service::where('id','<',20)->get();
      //$peoples = People::take(3)->get();

      //dd($peoples);

      return view('site/index');
    }
}
