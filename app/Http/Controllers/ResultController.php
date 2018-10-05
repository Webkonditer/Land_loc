<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Format;
use App\Donator;
use App\Payment;
use App\Setting;
use Carbon\Carbon;

class ResultController extends Controller
{
        public function result(Request $request, Donator $donator, Payment $payment) {

            // регистрационная информация (пароль #2)
            $setting = Setting::first();
            if($setting->test_mode == 1)$mrh_pass2 = $setting->test_pass2;
            else $mrh_pass2 = $setting->mrh_pass2;

            //установка текущего времени
            $tm=getdate(time()+9*3600);
            $date="$tm[year]-$tm[mon]-$tm[mday] $tm[hours]:$tm[minutes]:$tm[seconds]";

            $out_summ = $request->OutSum;
            $inv_id = $request->InvId;
            $crc = $request->SignatureValue;

            $crc = strtoupper($crc);

            $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));

            $pay = Payment::where('id', $inv_id)->first();
            $don = Donator::where('id', $pay->donator_id)->first();

            // проверка корректности подписи
            if ($my_crc !=$crc)
              {
                echo "bad sign\n";
                exit();
              }

            // признак успешно проведенной операции
            // success
            $pay->confirmation = Carbon::now()->format('Y-m-d H:i:s');
            $pay->save();//Подтверждение платежа в таблицу платежей

            $don->last_payment = Carbon::now()->format('Y-m-d H:i:s');
            $don->save();//Подтверждение платежа в таблицу платежей

            if ($pay->monthly == "Ежемесячно") {
              // В таблицу ежемесячных
            }

            echo "OK$inv_id\n";
            exit();
        }
}
