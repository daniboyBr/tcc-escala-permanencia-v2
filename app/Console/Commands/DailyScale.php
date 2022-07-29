<?php

namespace App\Console\Commands;

use Ramsey\Uuid\Uuid;
use App\Models\Escala;
use App\Models\Militar;
use Illuminate\Support\Str;
use App\Models\PostoServico;
use Illuminate\Support\Carbon;
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
        // $user = new \stdClass();
        // $user->email = 'admin@permanencia.com';
        // $user->name = 'Admin Enviando Email';
        // // return new PermanenciaDelivery($user);
        // Mail::send(new PermanenciaDelivery($user));
        
        // $this->info('Soldiers scheduled with success.');

        $now =  Carbon::now()->addDay(0);
        $previousDay = $now->subDays(2);

        $postoServico = PostoServico::with('postoGraduacao')->whereHas('postoGraduacao')
                            ->whereNotIn('id', function ($query) use($now) {
                                $query->select('postoServico_id')
                                    ->from('escala')
                                    ->where('data', $now->format('Y-m-d'));
                            })->get();

        foreach($postoServico as $posto){
            $enabledGraducao = $posto->postoGraduacao->map(function ($item) {
                return $item->id;
            });

            $militar = Militar::select('militar.*')
                ->join('postoGraduacao','postoGraduacao.id','militar.postoGraduacao_id')
                ->leftjoin('impedimento', 'impedimento.militar_id','militar.id')
                ->leftjoin('escala as e1', function($join){
                    $join->on('e1.militar_id','=','militar.id');
                    $join->on('e1.militarTroca_id','<>','militar.id');
                })
                ->leftjoin('escala as e2', function($join){
                    $join->on('e2.militar_id','<>','militar.id');
                    $join->on('e2.militarTroca_id','=','militar.id');
                })
                ->where('militar.flgAtivo',1)
                ->whereRaw("
                    ((? NOT BETWEEN impedimento.dataInicio AND impedimento.dataFinal) OR impedimento.id is null)", [$now->format('Y-m-d')])
                ->whereIn('postoGraduacao.id', $enabledGraducao)
                ->where(function($query)  use($previousDay, $now){
                    $query
                        ->whereNull('e1.militar_id')
                        ->orWhere(function($query3)  use($previousDay, $now) {
                            $query3->whereNotIn('militar.id', function ($query1) use($previousDay, $now) {
                                $query1->select('militar_id')
                                ->from('escala')
                                ->whereBetween("data", [$now->format('Y-m-d'), $previousDay->format('Y-m-d')]);
                            })
                            ->orWhereNotIn('militar.id', function ($query2) use($previousDay, $now) {
                                $query2->select('militarTroca_id')
                                ->from('escala')
                                ->whereBetween("data", [$now->format('Y-m-d'), $previousDay->format('Y-m-d')]);
                            });
                        })
                        ->orWhereNull('e2.militarTroca_id');
                })
                ->distinct()
                ->orderBy('postoGraduacao.nivel','desc')
                ->inRandomOrder()
                ->first();

            if(is_null($militar)){
                continue;
            }

            Escala::create([
                'postoServico_id' => $posto->id,
                'militar_id' => $militar->id,
                'data' => $now->format('Y-m-d'),
                'tokenCiente' => Str::random(30),
                'tokenCienteTroca' => Str::random(30),
                'uuidEscala' => Uuid::uuid4(),
                'livroPermanencia' => ''
            ]);

        }
        
        $this->info('Soldiers scheduled with success.');
    }
}
