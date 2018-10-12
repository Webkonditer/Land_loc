<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Donator;
use App\Payment;
use Carbon\Carbon;
use App\Recurring;
use Illuminate\Support\Facades\Storage;

class RecurringController extends Controller
{
    public function unsubscribe(Request $request) {
        $validator = $this->validate($request, [
        'email' => 'required|email',
        'pers' => 'accepted',
        ]);

        $donator = Donator::where('last_payment','!=',NULL)->where('email', $request->email)->first();
        if (isset($donator->id)) {
            $recur = Recurring::where('unsubscribed', NULL)->where('donator_id', $donator->id)->first();
            if($recur != NULL) {

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
                            ->withErrors('Указанный Вами Email в базе ежемесячных платежей не найден')
                            ->withInput();
    }

    public function unsubscribe_after_email($email, $key) {

      $donator = Donator::where('last_payment','!=',NULL)->where('email', $email)->first();
      if (isset($donator->id)) {
          if(Recurring::where('donator_id', $donator->id)->count() != 0 && $key == '69483'.$donator->id.'5739') {
              //dd('Отписан');
              $recur = Recurring::where('unsubscribed', NULL)->where('donator_id', $donator->id)->first();
                if($recur != NULL) {
                  $recur->unsubscribed = Carbon::now()->format('Y-m-d H:i:s');
                  $recur->save();//Внесение в таблицу регулярных платежей отметки об отписке.

                  return view('site.unsubscribe-success');
                }
          }
      }
      return view('site.unsubscribe-fail');
    }

    public function rron_script() {
      //Echo($d = Carbon::now()->format('m-d'));
    //dd(new Carbon('last day of this month'));


      if( $curl = curl_init() ) {
        curl_setopt($curl, CURLOPT_URL, 'https://auth.robokassa.ru/Merchant/Recurring');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "MrchLogin=$mrh_login&OutSum=$out_summ&PreviousInvoiceID=$prev_inv_id&InvId=$inv_id&Desc=$inv_desc&SignatureValue=$crc&Email=$Email&Receipt=$Receipt&IsTest=$IsTest");
        $out = curl_exec($curl);
        //echo $out;
        curl_close($curl);
      }
      Storage::append('cron.html', $out);
    }
}
