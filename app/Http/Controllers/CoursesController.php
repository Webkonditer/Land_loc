<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Course_payment;
use App\Setting;

class CoursesController extends Controller
{
  public function __construct() {

        $this->middleware('auth');
  }

  public function index(Course $courses)
  {
    return view('admin.courses.index', [
      'courses' => Course::orderBy('position')->paginate(10),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Course $courses)
  {
    return view('admin.courses.create', [
      'courses'  => $courses,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Course $course)
  {
    //dd($request->all());
    $validator = $this->validate($request, [

        'position' => 'required|integer',
        'image' => 'required|image',
        'name' => 'required|string|max:191',
        'nic' => 'required|string|max:191',
        'from' => 'required|integer',
        'to_' => 'required|integer',
        'description' => 'required|string',
        'module' => 'required|string',
        'mail_text' => 'required|string',
        'result_text' => 'required|string',
    ]);
    //dd($request->all());
      $path = $request->file('image')->store('i/formatsImage', 'public');

      $course->position = $request->position;
      $course->image = $path;
      $course->name = $request->name;
      $course->nic = $request->nic;
      $course->from = $request->from;
      $course->to = $request->to_;
      $course->description = $request->description;
      $course->module = $request->module;
      $course->mail_text = $request->mail_text;
      $course->result_text = $request->result_text;
      if(isset($request->inscription_chb))$course->inscription_chb = 1;
      if(isset($request->ngrup_chb))$course->ngrup_chb = 1;
      $course->save();

      return redirect()->route('admin.courses.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Course $course)
  {

    return view('admin.courses.edit', [
      'course'  => $course,
    ]);
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Course $course)
  {
      //dd($request->all());
      $validator = $this->validate($request, [

        'position' => 'required|integer',
        'image' => 'nullable|image',
        'name' => 'required|string|max:191',
        'nic' => 'required|string|max:191',
        'from' => 'required|integer',
        'to_' => 'required|integer',
        'description' => 'required|string',
        'module' => 'required|string',
        'mail_text' => 'required|string',
        'result_text' => 'required|string',
      ]);
      //dump($request->all());
        if(null !==($request->file('image'))) $path = $request->file('image')->store('i/formatsImage', 'public');
        else $path = null;

        $course->position = $request->position;
        if($path)$course->image = $path;
        $course->name = $request->name;
        $course->nic = $request->nic;
        $course->from = $request->from;
        $course->to = $request->to_;
        $course->description = $request->description;
        $course->module = $request->module;
        $course->mail_text = $request->mail_text;
        $course->result_text = $request->result_text;
        if(isset($request->inscription_chb))$course->inscription_chb = 1; else $course->inscription_chb = 0;
        if(isset($request->ngrup_chb))$course->ngrup_chb = 1; else $course->ngrup_chb = 0;
        $course->save();

        return redirect()->route('admin.courses.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Course $course)
  {
      $course->delete();
      return redirect()->route('admin.courses.index');
  }
}
