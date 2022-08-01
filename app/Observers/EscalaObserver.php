<?php

namespace App\Observers;

use App\Models\Escala;
use App\Mail\PermanenciaDelivery;
use Illuminate\Support\Facades\Mail;

class EscalaObserver
{
    /**
     * Handle the Escala "created" event.
     *
     * @param  \App\Models\Escala  $escala
     * @return void
     */
    public function created(Escala $escala)
    {
        $user = new \stdClass();
        $user->email = $escala->militar->email;
        $user->name = $escala->militar->name;
        $user->postoServico = $escala->postoServico->nome;
        $user->escala = $escala->uuidEscala;
        $user->tokenCiente = $escala->tokenCiente;
        $user->data = $escala->data->format('d/m/Y');
        $user->template = PermanenciaDelivery::TEMPLATE_CREATE_ESCALA;
        // return new PermanenciaDelivery($user);
        Mail::send(new PermanenciaDelivery($user));
    }

    /**
     * Handle the Escala "updated" event.
     *
     * @param  \App\Models\Escala  $escala
     * @return void
     */
    public function updated(Escala $escala)
    {
        //
    }

    /**
     * Handle the Escala "deleted" event.
     *
     * @param  \App\Models\Escala  $escala
     * @return void
     */
    public function deleted(Escala $escala)
    {
        //
    }

    /**
     * Handle the Escala "restored" event.
     *
     * @param  \App\Models\Escala  $escala
     * @return void
     */
    public function restored(Escala $escala)
    {
        //
    }

    /**
     * Handle the Escala "force deleted" event.
     *
     * @param  \App\Models\Escala  $escala
     * @return void
     */
    public function forceDeleted(Escala $escala)
    {
        //
    }
}
