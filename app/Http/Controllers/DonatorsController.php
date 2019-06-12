<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Payment;
use App\Recurring;
use App\Format;
use Illuminate\Support\Facades\Storage;

class DonatorsController extends Controller
{
    public function __construct() {

          //$this->middleware('auth');
    }

    public function execute(Donator $donators) {
      //Выгрузка емейлов
      $result = array();
      $formats = Format::all();//Коллекция из столбца групп
      foreach($formats as $format){$result[$format->id] = $format->name;}

      foreach($result as $format_name){
        $don_emails = Donator::where('last_payment','!=',NULL)->where('format_name', $format_name)->get();

        $email = '/public/i/emails/'.$format_name.'.csv';
        $url[] = $format_name.'.csv';

        Storage::delete($email);
        $data2=iconv("utf-8","windows-1251","Нет жертвователей в данной опции");

        if($don_emails->count() > 0) {
          foreach($don_emails as $don_email){

            $data = $don_email->name.';'.$don_email->email;
            $data=iconv("utf-8","windows-1251",$data);

              Storage::append($email, $data);
          }
        }
        else Storage::append($email, $data2);
      }
      //Выгрузка Чайтаний
      Storage::delete('public/i/Чайтаньи.csv');
      $ctn_lines = Donator::where('last_payment','!=',NULL)->get();
      foreach($ctn_lines as $ctn_line){

        $data = $ctn_line->name.';'.$ctn_line->email.';'.$ctn_line->bonus_points;
        $data=iconv("utf-8","windows-1251",$data);

          Storage::append('public/i/Чайтаньи.csv', $data);
      }

      return view('admin.donators.index', [
        'urls' => $url,
        'donators' => Donator::where('last_payment','!=',NULL)->orderBy('created_at', 'desc')->paginate(10)
      ]);
    }

    public function execute_sort(Donator $donators, $sort) {

      //Выгрузка емейлов
      $result = array();
      $formats = Format::all();//Коллекция из столбца групп
      foreach($formats as $format){$result[$format->id] = $format->name;}

      foreach($result as $format_name){
        $don_emails = Donator::where('last_payment','!=',NULL)->where('format_name', $format_name)->get();

        $email = '/public/i/emails/'.$format_name.'.csv';
        $url[] = $format_name.'.csv';

        Storage::delete($email);
        $data2=iconv("utf-8","windows-1251","Нет жертвователей в данной опции");

        if($don_emails->count() > 0) {
          foreach($don_emails as $don_email){

            $data = $don_email->name.';'.$don_email->email;
            $data=iconv("utf-8","windows-1251",$data);

              Storage::append($email, $data);
          }
        }
        else Storage::append($email, $data2);
      }
      //Выгрузка Чайтаний
      Storage::delete('public/i/Чайтаньи.csv');
      $ctn_lines = Donator::where('last_payment','!=',NULL)->get();
      foreach($ctn_lines as $ctn_line){

        $data = $ctn_line->name.';'.$ctn_line->email.';'.$ctn_line->bonus_points;
        $data=iconv("utf-8","windows-1251",$data);

          Storage::append('public/i/Чайтаньи.csv', $data);
      }

      return view('admin.donators.index', [
        'urls' => $url,
        'donators' => Donator::where('last_payment','!=',NULL)->orderBy($sort)->paginate(10)
      ]);
    }

    public function execute_monthly(Donator $donators, $sort) {

      return view('admin.donators.monthly', [
        'donators' => Donator::where('last_payment','!=',NULL)->where('monthly', 'Ежемесячно')->orderBy($sort)->paginate(10)
      ]);
    }

    public function execute_one_time(Donator $donators, $sort) {

      return view('admin.donators.one_time', [
        'donators' => Donator::where('last_payment','!=',NULL)->where('monthly', 'Разово')->orderBy($sort)->paginate(10)
      ]);
    }

    public function destroy(Donator $donator)
    {
        $delPayments = Payment::where('donator_id', $donator->id)->delete();
        $delRecurrings = Recurring::where('donator_id', $donator->id)->delete();
        $donator->delete();
        return redirect()->route('admin.donators');

    }

    public function search(Donator $donators, Request $request) {

        if(isset($request->email)) {
            $validator = $this->validate($request, [
                'email' => 'required|string|email|max:255',
            ]);
            $dons = Donator::where('last_payment','!=',NULL)->where('email', $request->email)->get();
            if ($dons->count() > 0) {
              return view('admin.donators.search', [
                'donators' => $dons
              ]);
            }
            else {
              return redirect('admin/donators')
                                  ->withErrors('Указанный Вами Email в безе не найден')
                                  ->withInput();
            }
        }
        if(isset($request->phone)) {
            $validator = $this->validate($request, [
                'phone' => 'required|integer',
            ]);
            $dons = Donator::where('last_payment','!=',NULL)->where('phone', $request->phone)->get();
            if ($dons->count() > 0) {
              return view('admin.donators.search', [
                'donators' => $dons
              ]);
            }
            else {
              return redirect('admin/donators')
                                  ->withErrors('Указанный Вами телефон в безе не найден')
                                  ->withInput();
            }
        }

    }

    public function ch_edit(Request $request)
    {
      $validator = $this->validate($request, [
          'ch' => 'required|integer',
      ]);
        $donator = Donator::where('id', $request->id)->first();
        $donator->bonus_points = $request->ch;
        $donator->save();

        return redirect()->back();
    }
}
