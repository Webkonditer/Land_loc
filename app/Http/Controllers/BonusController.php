<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Donator;
use App\Bonus_application;

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

      if ($donator->bonus_points < $request->bonus_summ) {
        return redirect(route('bonus.gifts'))
                            ->withErrors('Ваш баланс - '.$donator->bonus_points.' Чайтаний. Этого недостаточно, чтобы получить выбранный Вами подарок. Выберите пожалуйста другой.')
                            ->withInput();
      }
      //Заносим в базу
      $bonus_application = new Bonus_application;

      $bonus_application->donator_id = $donator->id;
      $bonus_application->name = $donator->name;
      $bonus_application->email = $donator->email;
      $bonus_application->phone = $donator->phone;
      $bonus_application->bonus_points = $donator->bonus_points;
      $bonus_application->bonus = $request->bonus_name;
      $bonus_application->summ = $request->bonus_summ;
      $bonus_application->save();

      //Отправка письма
      $to = 'webkonditer@yandex.ru';
      $subject = 'Заявка на подарок';

      $message = '
      <html>
          <head>
              <title>Поступила заявка на подарок</title>
              <meta charset="utf8">
          </head>
          <body>
              <h2>Поступила заявка на подарок</h2>
              <p>От: '.$donator->name.'</p>
              <p>Email: '.$donator->email.'</p>
              <p>Телефон: '.$donator->phone.'</p>
              <p>Количество бонусных баллов: '.$donator->bonus_points.'</p>
              <p>------------------------------</p>
              <p>Подарок: '.$request->bonus_name.'</p>
              <p>Стоимость подарка: '.$request->bonus_summ.'</p>
          </body>
      </html>
      ';

      $headers[] = 'MIME-Version: 1.0';
      $headers[] = 'Content-type: text/html; charset=utf8';
      $headers[] = 'From: iskconclub.ru <info@iskconclub.ru>';

      $result = mail($to, $subject, $message, implode("\r\n", $headers));
      //echo $result ? 'OK' : 'Error';


      return view('site.bonus.success');
      //dd($request->email);
    }
}
