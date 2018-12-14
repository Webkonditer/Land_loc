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
        'bonus_1' => 'required|string|max:500',
        'bonus_2' => 'required|string|max:500',
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
        'video_1' => 'required',
      ]);
      //dump($request->all());
        if(null !==($request->file('image'))) $path = $request->file('image')->store('i/formatsImage', 'public');
        else $path = null;

        $format->position = $request->position;
        if($path)$format->image = $path;
        $format->name = $request->name;
        $format->summ = $request->summ;
        if($request->monthly)$format->monthly = "Ежемесячно"; else $format->monthly = "Разово";
        $format->video_1 = $request->video_1;
        $format->text_1 = $request->text_1;
        $format->video_2 = $request->video_2;
        $format->text_2 = $request->text_2;
        $format->video_3 = $request->video_3;
        $format->text_3 = $request->text_3;
        $format->video_4 = $request->video_4;
        $format->text_4 = $request->text_4;
        $format->video_5 = $request->video_5;
        $format->text_5 = $request->text_5;
        $format->video_6 = $request->video_6;
        $format->text_6 = $request->text_6;
        $format->video_7 = $request->video_7;
        $format->text_7 = $request->text_7;
        $format->video_8 = $request->video_8;
        $format->text_8 = $request->text_8;
        $format->video_9 = $request->video_9;
        $format->text_9 = $request->text_9;
        $format->video_10 = $request->video_10;
        $format->text_10 = $request->text_10;
        $format->video_11 = $request->video_11;
        $format->text_11 = $request->text_11;
        $format->video_12 = $request->video_12;
        $format->text_12 = $request->text_12;
        $format->video_13 = $request->video_13;
        $format->text_13 = $request->text_13;
        $format->video_14 = $request->video_14;
        $format->text_14 = $request->text_14;
        $format->video_15 = $request->video_15;
        $format->text_15 = $request->text_15;
        //$format->success = $request->success;
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
