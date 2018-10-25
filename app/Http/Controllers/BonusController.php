<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Donator;

class BonusController extends Controller
{
    public function gifts(Request $request) {

      $gift[1] = (object) array('name' => 'Базовый комплект книг',
                       'description' => 'Бхагавад-гита, Нектар преданности, Нектар наставлений, Ишопанишад, Наука самосознания, Прабхупада, Кришна, Учение Шри Чайтаньи.',
                       'summ' => '60',
                       );
       $gift[2] = (object) array('name' => 'Бхакти-шастры онлайн (1 модуль)',
                        'description' => '',
                        'summ' => '60',
                        );
      $gift[3] = (object) array('name' => 'Подарочный комплект книг 1',
                       'description' => 'Прабхупада Лиламрита, Кришна - Верховная Личность Бога (Делюкс).',
                       'summ' => '120',
                       );
      $gift[4] = (object) array('name' => 'Подарочный комплект книг 2',
                      'description' => 'Кришна АРТ, Кулинарная книга от Ямуны д.д.',
                      'summ' => '120',
                      );

      $gift[5] = (object) array('name' => 'Шримад Бхагаватам, песни 1-4',
                       'description' => '',
                       'summ' => '120',
                       );

     $gift[6] = (object) array('name' => 'Шримад Бхагаватам, песни 5-8',
                      'description' => '',
                      'summ' => '100',
                      );
     $gift[7] = (object) array('name' => 'Шримад Бхагаватам, песни 9-12',
                     'description' => '',
                     'summ' => '160',
                     );
     $gift[8] = (object) array('name' => 'Полный комплект "Чайтанья-чаритамрита"',
                      'description' => '',
                      'summ' => '120',
                      );
    $gift[9] = (object) array('name' => 'Очный курс отдела образования',
                     'description' => 'Включает: взнос, проживание и питание, если они предусмотрены.',
                     'summ' => '200',
                     );

    $gift[10] = (object) array('name' => 'Полный комплект "Шримад Бхагаватам"',
                    'description' => '',
                    'summ' => '240',
                    );
    $gift[11] = (object) array('name' => 'Бхакти-шастры/Бхакти-вайбхава в Маяпуре или Вриндаване',
                   'description' => 'Только взнос за обучение, без билетов, питания и проживания.',
                   'summ' => '480',
                   );

    $gift_object = (object) $gift;
                   //dd($gift_object);

      return view('site.bonus.gifts', [
            'gifts' => $gift_object,
          ]);
    }

    public function entrance(Request $request) {

      $validator = $this->validate($request, [
        'bonus_name' => 'required|string|max:255',
        'bonus_summ' => 'required|integer',
      ]);

      return view('site.bonus.entrance', [
        'bonus_name' => $request->bonus_name,
        'bonus_summ' => $request->bonus_summ,
      ]);
    }

    public function entrance_check(Request $request) {

      $validator = $this->validate($request, [
        'email' => 'required|string|email|max:255',
        'phone' => 'required|integer',
        'bonus_name' => 'required|string|max:255',
        'bonus_summ' => 'required|integer',
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


    dd($request);

      return view('site.bonus.entrance');
    }
}
