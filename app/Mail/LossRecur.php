<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LossRecur extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($data)
     {
         $this->data = $data;
     }

     /**
      * Build the message.
      *
      * @return $this
      */
     public function build()
     {
       return $this->from('info@bhaktilata.ru')
                   ->subject('iskconclub.ru - проблема с отправкой ежемесячного платежа')
                   ->view('mails.loss_recur');
     }
 }
