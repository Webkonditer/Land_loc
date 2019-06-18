<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course_pass;
use App\Course;
use Illuminate\Support\Facades\Auth;

class CoursePassController extends Controller
{
  public function __construct() {

        //$this->middleware('auth');
  }

  public function execute(Request $request) {

    $courses = Course::all();
    $i = 1;
    foreach ($courses as $course) {
      if(isset($course->module)) {
          $modules = explode("\r\n", $course->module);
          foreach ($modules as $module) {
              $pass_line = Course_pass::where('course', $course->name)->where('module', $module)->first();
              if (isset($pass_line->password)) $pass = $pass_line->password;
              else $pass = 'Не установлен';
              $passwords[] = [
                  "course" => $course->name,
                  "module" => $module,
                  "password" => $pass,
              ];
          }
      }
    }
    return view('admin.courses.passwords', [
      'passwords' => $passwords,
    ]);
  }

  protected function generate_password($number)
  {
    $arr = array('a','b','c','d','e','f',
                 'g','h','i','j','k','l',
                 'm','n','o','p','r','s',
                 't','u','v','x','y','z',
                 'A','B','C','D','E','F',
                 'G','H','I','J','K','L',
                 'M','N','O','P','R','S',
                 'T','U','V','X','Y','Z',
                 '1','2','3','4','5','6',
                 '7','8','9','0');
    // Генерируем пароль
    $pass = "";
    for($i = 0; $i < $number; $i++)
    {
      // Вычисляем случайный индекс массива
      $index = rand(0, count($arr) - 1);
      $pass .= $arr[$index];
    }
    return $pass;
  }

  public function edit(Request $request, Course_pass $course_pass)
  {
    //dd($request->all());
    $validator = $this->validate($request, [

        'course' => 'required|string|max:191',
        'module' => 'required|string',
        'password' => 'required|string',
    ]);
      $user = Auth::user()->name;
      $pass_line = Course_pass::where('course', $request->course)->where('module', $request->module)->first();
      if (isset($pass_line->module)) {
        $pass_line->password = $this->generate_password(8);
        $course_pass->admin = $user;
        $pass_line->save();
      }
      else {
        $course_pass->course = $request->course;
        $course_pass->module = $request->module;
        $course_pass->password = $this->generate_password(8);
        $course_pass->admin = $user;
        $course_pass->save();
      }
      return redirect()->route('admin.courses.passwords');
  }
}
