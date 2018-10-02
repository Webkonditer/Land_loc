<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class AdminController extends Controller
{
  public function __construct() {

        $this->middleware('auth');
  }

  public function execute(Request $request) {

    return view('admin.administrators.index', [
      'settings' => User::All(),
    ]);
  }

  protected function create(Request $request, User $user)
  {
      $validator = $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8',
      ]);

       User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request->password),
      ]);

      return view('admin.administrators.index', [
        'settings' => User::All(),
      ]);
  }

  public function update(Request $request, User $user)
  {
      //dump($request->all());
      $validator = $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'nullable|string|min:8',
      ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password)$user->password = Hash::make($request->password);
        $user->save();

        return view('admin.administrators.index', [
          'settings' => User::All(),
        ]);
  }

  public function destroy(User $user)
  {
      $user->delete();
      return view('admin.administrators.index', [
        'settings' => User::All(),
      ]);
  }

}
