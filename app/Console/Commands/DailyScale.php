<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\PermanenciaDelivery;
use Illuminate\Support\Facades\Mail;

class DailyScale extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scale:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comand to schedule soldiers in scale of stay';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = new \stdClass();
        $user->email = 'admin@permanencia.com';
        $user->name = 'Admin Enviando Email';
        // return new PermanenciaDelivery($user);
        Mail::send(new PermanenciaDelivery($user));
        
        $this->info('Soldiers scheduled with success.');
    }
}
