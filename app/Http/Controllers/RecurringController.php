<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recurring;
use Illuminate\Support\Facades\Validator;
use App\Donator;
use App\Payment;

class RecurringController extends Controller
{
    public function unsubscribe(Request $request) {
        $validator = $this->validate($request, [
        'email' => 'required|email',
        'pers' => 'accepted',
        ]);

        $donator = Donator::where('last_payment','!=',NULL)->where('email', $request->email)->first();
        if (isset($donator->id)) {
            if(Recurring::where('donator_id', $donator->id)->count() != 0) {

              $to = $request->email;
              $subject = 'Отписка от ежемесячного платежа';
              $url = route('home').'/unsubscribe/'.$request->email.'/69483'.$donator->id.'5739';

              $message = '
              <html>
                  <head>
                      <title>Отписка от ежемесячного платежа</title>
                      <meta charset="utf8">
                  </head>
                  <body>
                      <p>Здравствуйте, '.$donator->name.'</p>
                      <p> </p>
                      <p>Для того, чтобы отписаться от ежемесячного платежа, пожалуйста перейдите по ссылке '.$url.'</p>
                      <p> </p>
                      <p>Спасибо за то, что были с нами!</p>
                  </body>
              </html>
              ';

              $headers[] = 'MIME-Version: 1.0';
              $headers[] = 'Content-type: text/html; charset=utf8';
              $headers[] = 'From: bhaktilata.ru <info@bhaktilata.ru>';

              $result = mail($to, $subject, $message, implode("\r\n", $headers));
              //echo $result ? 'OK' : 'Error';

              return view('site.unsubscribe-emaled');
            }
        }
        return redirect('unsubscribe')
                            ->withErrors('Указанный Вами Email в безе ежемесячных платежей не найден')
                            ->withInput();

    }
}
