<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DonatorsController extends Controller
{
    public function __construct() {

          $this->middleware('auth');
    }

    public function execute(Donator $donators) {

      return view('admin.donators.index', [
        'donators' => Donator::orderBy('created_at', 'desc')->paginate(10)
      ]);
    }

    public function execute_sort(Donator $donators, $sort) {

      return view('admin.donators.index', [
        'donators' => Donator::orderBy($sort)->paginate(10)
      ]);
    }

    public function execute_monthly(Donator $donators, $sort) {

      return view('admin.donators.monthly', [
        'donators' => Donator::where('monthly', 'Ежемесячно')->orderBy($sort)->paginate(10)
      ]);
    }

    public function execute_one_time(Donator $donators, $sort) {

      return view('admin.donators.one_time', [
        'donators' => Donator::where('monthly', 'Разово')->orderBy($sort)->paginate(10)
      ]);
    }
}