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
        
        return $this->html('mail.new',[
            'user'=>$this->user->name,
            'systemLogo' => public_path().'/img/exercito-logo.png'
        ]);
    }
}
