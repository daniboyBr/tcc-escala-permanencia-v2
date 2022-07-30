<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PermanenciaDelivery extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private \stdClass $user)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject("Notificação: Escalação de Permanência");
        $this->to($this->user->email, $this->user->name);
        $this->header['Content-Type'] ='text/html; charset=UTF-8';
        
        return $this->markdown('mail.new',[
            'user'=>$this->user->name,
            'data' => $this->user->data,
            'postoServico' => $this->user->postoServico,
            'link' => url('confirm/escala', [$this->user->escala, $this->user->tokenCiente])
        ]);
    }
}
