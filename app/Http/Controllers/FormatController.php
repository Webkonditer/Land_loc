<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Format;

class FormatController extends Controller
{

    public function __construct() {

          //$this->middleware('auth');
    }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Format $format)
  {
    return view('admin.formats.index', [
      'formats' => Format::orderBy('position')->paginate(10),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Format $format)
  {
    //$schedule = Schedule::find(2);
    //dump($schedule->courselist);

    //$courselist = CourseList::find(1);
    //dump($courselist->schedules);

    return view('admin.formats.create', [
      'format'  => $format,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Format $format)
  {

    //dd($request->all());
    $validator = $this->validate($request, [

        'position' => 'required|integer',
        'image' => 'required|image',
        'name' => 'required|string|max:191',
        'summ' => 'required',
        'monthly' => 'string|max:2',
        'bonus_1' => 'required|string|max:191',
        'bonus_2' => 'required|string|max:191',
        'success' => 'required',
        'ctn' => 'required|integer',
    ]);
    //dd($request->all());
      $path = $request->file('image')->store('i/formatsImage', 'public');

      $format->position = $request->position;
      $format->image = $path;
      $format->name = $request->name;
      $format->summ = $request->summ;
      if($request->monthly)$format->monthly = "Ежемесячно"; else $format->monthly = "Разово";
      if($request->on_home)$format->on_home = "Да"; else $format->on_home = "Нет";
      $format->bonus_1 = $request->bonus_1;
      $format->bonus_2 = $request->bonus_2;
      $format->ctn = $request->ctn;
      $format->success = $request->success;
      $format->save();

      return redirect()->route('admin.formats.index');
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
  public function edit(Format $format)
  {

    return view('admin.formats.edit', [
      'format'  => $format,
    ]);
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Format $format)
  {
      //dd($request->all());
      $validator = $this->validate($request, [

        'position' => 'required|integer',
        'image' => 'nullable|image',
        'name' => 'required|string|max:191',
        'summ' => 'required',
        'monthly' => 'string|max:2',
        'bonus_1' => 'required|string|max:191',
        'bonus_2' => 'required|string|max:191',
        'ctn' => 'required|integer',
        'success' => 'required',
      ]);
      //dump($request->all());
        if(null !==($request->file('image'))) $path = $request->file('image')->store('i/formatsImage', 'public');
        else $path = null;

        $format->position = $request->position;
        if($path)$format->image = $path;
        $format->name = $request->name;
        $format->summ = $request->summ;
        if($request->monthly)$format->monthly = "Ежемесячно"; else $format->monthly = "Разово";
        if($request->on_home)$format->on_home = "Да"; else $format->on_home = "Нет";
        $format->bonus_1 = $request->bonus_1;
        $format->bonus_2 = $request->bonus_2;
        $format->ctn = $request->ctn;
        $format->success = $request->success;
        $format->save();

        return redirect()->route('admin.formats.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Format $format)
  {
      $format->delete();
      return redirect()->route('admin.formats.index');
  }
}
