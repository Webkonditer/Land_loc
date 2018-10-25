<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Donator;

class BonusController extends Controller
{
    public function gifts(Request $request) {

      $gift[1] = array('name' => 'Базовый комплект книг',
                       'description' => 'Бхагавад-гита, Нектар преданности, Нектар наставлений, Ишопанишад, Наука самосознания, Прабхупада, Кришна, Учение Шри Чайтаньи.',
                       'summ' => '60',
                       );
       $gift[2] = array('name' => 'Бхакти-шастры онлайн (1 модуль)',
                        'description' => '',
                        'summ' => '60',
                        );
      $gift[3] = array('name' => 'Подарочный комплект книг 1',
                       'description' => 'Прабхупада Лиламрита, Кришна - Верховная Личность Бога (Делюкс).',
                       'summ' => '120',
                       );
      $gift[4] = array('name' => 'Подарочный комплект книг 2',
                      'description' => 'Кришна АРТ, Кулинарная книга от Ямуны д.д.',
                      'summ' => '120',
                      );

      $gift[5] = array('name' => 'Шримад Бхагаватам, песни 1-4',
                       'description' => '',
                       'summ' => '120',
                       );

     $gift[6] = array('name' => 'Шримад Бхагаватам, песни 5-8',
                      'description' => '',
                      'summ' => '100',
                      );
     $gift[7] = array('name' => 'Шримад Бхагаватам, песни 9-12',
                     'description' => '',
                     'summ' => '160',
                     );
     $gift[8] = array('name' => 'Полный комплект "Чайтанья-чаритамрита"',
                      'description' => '',
                      'summ' => '120',
                      );
    $gift[9] = array('name' => 'Очный курс отдела образования',
                     'description' => 'Включает: взнос, проживание и питание, если они предусмотрены.',
                     'summ' => '200',
                     );

    $gift[10] = array('name' => 'Полный комплект "Шримад Бхагаватам"',
                    'description' => '',
                    'summ' => '240',
                    );
    $gift[11] = array('name' => 'Бхакти-шастры/Бхакти-вайбхава в Маяпуре или Вриндаване',
                   'description' => 'Только взнос за обучение, без билетов, питания и проживания.',
                   'summ' => '480',
                   );
    $gift[12] = array('name' => 'Полный комплект "Чайтанья-чаритамрита"',
                    'description' => '',
                    'summ' => '120',
                    );      dd($gift->1->name);

      return view('site.bonus.entrance');
    }

    public function entrance(Request $request) {

      return view('site.bonus.entrance');
    }

    public function entrance_check(Request $request) {

      $validator = $this->validate($request, [
        'email' => 'required|string|email|max:255',
        'phone' => 'required|integer',
      ]);

      $donator = Donator::where('last_payment','!=',NULL)
                          ->where('email', $request->email)
                          ->where('phone', $request->phone)
                          ->first();

      if (!isset($donator->id)) {
        return redirect()->back()
                            ->withErrors('Такая пара Email и телефон в базе не найдена. Попробуйте еще раз.')
                            ->withInput();
      }


    dd('entrance');

      return view('site.bonus.entrance');
    }
}
