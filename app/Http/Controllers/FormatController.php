<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Format;
use App\Text;

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
      'summ' => 'required|integer',
      'summ2' => 'required|integer',
      'summ3' => 'required|integer',
      'video_1' => 'required|string|',
      'text_1' => 'required|string|',
      'text2_1' => 'required|string|',

    ]);
    //dd($request->all());
      $path = $request->file('image')->store('i/formatsImage', 'public');

      $format->position = $request->position;
      if($path)$format->image = $path;
      $format->name = $request->name;
      $format->summ = $request->summ;
      $format->summ2 = $request->summ2;
      $format->summ3 = $request->summ3;
      $format->video_1 = $request->video_1;
      $format->video_2 = $request->video_2;
      $format->video_3 = $request->video_3;
      $format->video_4 = $request->video_4;
      $format->video_5 = $request->video_5;
      $format->video_6 = $request->video_6;
      $format->video_7 = $request->video_7;
      $format->video_8 = $request->video_8;
      $format->video_9 = $request->video_9;
      $format->video_10 = $request->video_10;
      $format->video_11 = $request->video_11;
      $format->video_12 = $request->video_12;
      $format->video_13 = $request->video_13;
      $format->video_14 = $request->video_14;
      $format->video_15 = $request->video_15;
      $format->text_1 = 1;
      $format->text2_1 = 1;

      $format->save();


      if (isset($request->text_1)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 1;
        $text->text_x_x = 1;
        $text->text = $request->text_1;
        $text->save();
      }
      if (isset($request->text_2)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 1;
        $text->text_x_x = 2;
        $text->text = $request->text_2;
        $text->save();
      }
      if (isset($request->text_3)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 1;
        $text->text_x_x = 3;
        $text->text = $request->text_3;
        $text->save();
      }
      if (isset($request->text_4)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 1;
        $text->text_x_x = 4;
        $text->text = $request->text_4;
        $text->save();
      }
      if (isset($request->text_5)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 1;
        $text->text_x_x = 5;
        $text->text = $request->text_5;
        $text->save();
      }
      if (isset($request->text_6)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 1;
        $text->text_x_x = 6;
        $text->text = $request->text_6;
        $text->save();
      }
      if (isset($request->text_7)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 1;
        $text->text_x_x = 7;
        $text->text = $request->text_7;
        $text->save();
      }
      if (isset($request->text_8)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 1;
        $text->text_x_x = 8;
        $text->text = $request->text_8;
        $text->save();
      }
      if (isset($request->text_9)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 1;
        $text->text_x_x = 9;
        $text->text = $request->text_9;
        $text->save();
      }
      if (isset($request->text_10)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 1;
        $text->text_x_x = 10;
        $text->text = $request->text_10;
        $text->save();
      }
      if (isset($request->text_11)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 1;
        $text->text_x_x = 11;
        $text->text = $request->text_11;
        $text->save();
      }
      if (isset($request->text_12)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 1;
        $text->text_x_x = 12;
        $text->text = $request->text_12;
        $text->save();
      }
      if (isset($request->text_13)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 1;
        $text->text_x_x = 13;
        $text->text = $request->text_13;
        $text->save();
      }
      if (isset($request->text_14)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 1;
        $text->text_x_x = 14;
        $text->text = $request->text_14;
        $text->save();
      }
      if (isset($request->text_15)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 1;
        $text->text_x_x = 15;
        $text->text = $request->text_15;
        $text->save();
      }

      //---------------------------

      if (isset($request->text2_1)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 2;
        $text->text_x_x = 1;
        $text->text = $request->text2_1;
        $text->save();
      }
      if (isset($request->text2_2)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 2;
        $text->text_x_x = 2;
        $text->text = $request->text2_2;
        $text->save();
      }
      if (isset($request->text2_3)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 2;
        $text->text_x_x = 3;
        $text->text = $request->text2_3;
        $text->save();
      }
      if (isset($request->text2_4)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 2;
        $text->text_x_x = 4;
        $text->text = $request->text2_4;
        $text->save();
      }
      if (isset($request->text2_5)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 2;
        $text->text_x_x = 5;
        $text->text = $request->text2_5;
        $text->save();
      }
      if (isset($request->text2_6)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 2;
        $text->text_x_x = 6;
        $text->text = $request->text2_6;
        $text->save();
      }
      if (isset($request->text2_7)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 2;
        $text->text_x_x = 7;
        $text->text = $request->text2_7;
        $text->save();
      }
      if (isset($request->text2_8)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 2;
        $text->text_x_x = 8;
        $text->text = $request->text2_8;
        $text->save();
      }
      if (isset($request->text2_9)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 2;
        $text->text_x_x = 9;
        $text->text = $request->text2_9;
        $text->save();
      }
      if (isset($request->text2_10)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 2;
        $text->text_x_x = 10;
        $text->text = $request->text2_10;
        $text->save();
      }
      if (isset($request->text2_11)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 2;
        $text->text_x_x = 11;
        $text->text = $request->text2_11;
        $text->save();
      }
      if (isset($request->text2_12)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 2;
        $text->text_x_x = 12;
        $text->text = $request->text2_12;
        $text->save();
      }
      if (isset($request->text2_13)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 2;
        $text->text_x_x = 13;
        $text->text = $request->text2_13;
        $text->save();
      }
      if (isset($request->text2_14)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 2;
        $text->text_x_x = 14;
        $text->text = $request->text2_14;
        $text->save();
      }
      if (isset($request->text2_15)) {
        $text = new Text;
        $text->format_id = $format->id;
        $text->text_x = 2;
        $text->text_x_x = 15;
        $text->text = $request->text2_15;
        $text->save();
      }



      return redirect()->route('admin.formats.index');
  }

  public function edit(Format $format)
  {

    $texts_1 = Text::where('format_id', $format->id)->where('text_x', 1)->get();
    $texts_2 = Text::where('format_id', $format->id)->where('text_x', 2)->get();
    foreach ($texts_1 as $text_1) {
      $array1[$text_1->text_x_x] = $text_1->text;
    }
    foreach ($texts_2 as $text_2) {
      $array2[$text_2->text_x_x] = $text_2->text;
    }
    return view('admin.formats.edit', [
      'format'  => $format,
      'text_1' => $array1,
      'text_2' => $array2,
    ]);
  }

  public function update(Request $request, Format $format)
  {
      //dd($request->all());
      $validator = $this->validate($request, [
        'position' => 'required|integer',
        'image' => 'nullable|image',
        'name' => 'required|string|max:191',
        'summ' => 'required|integer',
        'summ2' => 'required|integer',
        'summ3' => 'required|integer',
        'video_1' => 'required|string|',
        'text_1' => 'required|string|',
        'text2_1' => 'required|string|',
      ]);
      //dump($request->all());
        if(null !==($request->file('image'))) $path = $request->file('image')->store('i/formatsImage', 'public');
        else $path = null;

        $format->position = $request->position;
        if($path)$format->image = $path;
        $format->name = $request->name;
        $format->summ = $request->summ;
        $format->summ2 = $request->summ2;
        $format->summ3 = $request->summ3;
        $format->video_1 = $request->video_1;
        $format->video_2 = $request->video_2;
        $format->video_3 = $request->video_3;
        $format->video_4 = $request->video_4;
        $format->video_5 = $request->video_5;
        $format->video_6 = $request->video_6;
        $format->video_7 = $request->video_7;
        $format->video_8 = $request->video_8;
        $format->video_9 = $request->video_9;
        $format->video_10 = $request->video_10;
        $format->video_11 = $request->video_11;
        $format->video_12 = $request->video_12;
        $format->video_13 = $request->video_13;
        $format->video_14 = $request->video_14;
        $format->video_15 = $request->video_15;
        $format->text_1 = 1;
        $format->text2_1 = 1;

        $format->save();


        if (isset($request->text_1)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 1;
          $text->text_x_x = 1;
          $text->text = $request->text_1;
          $text->save();
        }
        if (isset($request->text_2)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 1;
          $text->text_x_x = 2;
          $text->text = $request->text_2;
          $text->save();
        }
        if (isset($request->text_3)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 1;
          $text->text_x_x = 3;
          $text->text = $request->text_3;
          $text->save();
        }
        if (isset($request->text_4)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 1;
          $text->text_x_x = 4;
          $text->text = $request->text_4;
          $text->save();
        }
        if (isset($request->text_5)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 1;
          $text->text_x_x = 5;
          $text->text = $request->text_5;
          $text->save();
        }
        if (isset($request->text_6)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 1;
          $text->text_x_x = 6;
          $text->text = $request->text_6;
          $text->save();
        }
        if (isset($request->text_7)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 1;
          $text->text_x_x = 7;
          $text->text = $request->text_7;
          $text->save();
        }
        if (isset($request->text_8)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 1;
          $text->text_x_x = 8;
          $text->text = $request->text_8;
          $text->save();
        }
        if (isset($request->text_9)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 1;
          $text->text_x_x = 9;
          $text->text = $request->text_9;
          $text->save();
        }
        if (isset($request->text_10)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 1;
          $text->text_x_x = 10;
          $text->text = $request->text_10;
          $text->save();
        }
        if (isset($request->text_11)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 1;
          $text->text_x_x = 11;
          $text->text = $request->text_11;
          $text->save();
        }
        if (isset($request->text_12)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 1;
          $text->text_x_x = 12;
          $text->text = $request->text_12;
          $text->save();
        }
        if (isset($request->text_13)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 1;
          $text->text_x_x = 13;
          $text->text = $request->text_13;
          $text->save();
        }
        if (isset($request->text_14)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 1;
          $text->text_x_x = 14;
          $text->text = $request->text_14;
          $text->save();
        }
        if (isset($request->text_15)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 1;
          $text->text_x_x = 15;
          $text->text = $request->text_15;
          $text->save();
        }

        //---------------------------

        if (isset($request->text2_1)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 2;
          $text->text_x_x = 1;
          $text->text = $request->text2_1;
          $text->save();
        }
        if (isset($request->text2_2)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 2;
          $text->text_x_x = 2;
          $text->text = $request->text2_2;
          $text->save();
        }
        if (isset($request->text2_3)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 2;
          $text->text_x_x = 3;
          $text->text = $request->text2_3;
          $text->save();
        }
        if (isset($request->text2_4)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 2;
          $text->text_x_x = 4;
          $text->text = $request->text2_4;
          $text->save();
        }
        if (isset($request->text2_5)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 2;
          $text->text_x_x = 5;
          $text->text = $request->text2_5;
          $text->save();
        }
        if (isset($request->text2_6)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 2;
          $text->text_x_x = 6;
          $text->text = $request->text2_6;
          $text->save();
        }
        if (isset($request->text2_7)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 2;
          $text->text_x_x = 7;
          $text->text = $request->text2_7;
          $text->save();
        }
        if (isset($request->text2_8)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 2;
          $text->text_x_x = 8;
          $text->text = $request->text2_8;
          $text->save();
        }
        if (isset($request->text2_9)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 2;
          $text->text_x_x = 9;
          $text->text = $request->text2_9;
          $text->save();
        }
        if (isset($request->text2_10)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 2;
          $text->text_x_x = 10;
          $text->text = $request->text2_10;
          $text->save();
        }
        if (isset($request->text2_11)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 2;
          $text->text_x_x = 11;
          $text->text = $request->text2_11;
          $text->save();
        }
        if (isset($request->text2_12)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 2;
          $text->text_x_x = 12;
          $text->text = $request->text2_12;
          $text->save();
        }
        if (isset($request->text2_13)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 2;
          $text->text_x_x = 13;
          $text->text = $request->text2_13;
          $text->save();
        }
        if (isset($request->text2_14)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 2;
          $text->text_x_x = 14;
          $text->text = $request->text2_14;
          $text->save();
        }
        if (isset($request->text2_15)) {
          $text = new Text;
          $text->format_id = $format->id;
          $text->text_x = 2;
          $text->text_x_x = 15;
          $text->text = $request->text2_15;
          $text->save();
        };

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
