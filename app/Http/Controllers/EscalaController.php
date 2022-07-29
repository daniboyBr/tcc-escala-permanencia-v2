<?php

namespace App\Http\Controllers;

use App\Models\Secao;
use Ramsey\Uuid\Uuid;
use App\Models\Escala;
use App\Models\Militar;
use Illuminate\Support\Str;
use App\Models\PostoServico;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Storage;
use App\Models\PostoGraduacaoPostoServico;

class EscalaController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// if(request()->hasFile('image')){
		// 	dd(request()->file('image')->store('upload'));
		// 	// return  Storage::download("upload/bkDdGgp7pqvhmnEsjdAZ9naHUrqfp2kXaNRz7nGi.bin","file.gp4");
		// 	// dd(Storage::url('upload/bkDdGgp7pqvhmnEsjdAZ9naHUrqfp2kXaNRz7nGi.bin'));

		// }
		return view('escala/index');
	}

	public function generateEscala()
	{
		// Escala::truncate();
		dd(Escala::count());

		// $current = 0;

		// foreach(array_fill(0, 1000,"militar") as $key => $value){
			// $now =  Carbon::now()->addDay(0);
			// $previousDay = $now->subDays(2);
	
			// $postoServico = PostoServico::with('postoGraduacao')->whereHas('postoGraduacao')
			// 					->whereNotIn('id', function ($query) use($now) {
			// 						$query->select('postoServico_id')
			// 							->from('escala')
			// 							->where('data', $now->format('Y-m-d'));
			// 					})->get();
	
			// foreach($postoServico as $posto){
			// 	$enabledGraducao = $posto->postoGraduacao->map(function ($item) {
			// 		return $item->id;
			// 	});
	
			// 	$militar = Militar::select('militar.*')
			// 		->join('postoGraduacao','postoGraduacao.id','militar.postoGraduacao_id')
			// 		->leftjoin('impedimento', 'impedimento.militar_id','militar.id')
			// 		->leftjoin('escala as e1', function($join){
			// 			$join->on('e1.militar_id','=','militar.id');
			// 			$join->on('e1.militarTroca_id','<>','militar.id');
			// 		})
			// 		->leftjoin('escala as e2', function($join){
			// 			$join->on('e2.militar_id','<>','militar.id');
			// 			$join->on('e2.militarTroca_id','=','militar.id');
			// 		})
			// 		->where('militar.flgAtivo',1)
			// 		->whereRaw("
			// 			((? NOT BETWEEN impedimento.dataInicio AND impedimento.dataFinal) OR impedimento.id is null)", [$now->format('Y-m-d')])
			// 		->whereIn('postoGraduacao.id', $enabledGraducao)
			// 		->where(function($query)  use($previousDay, $now){
			// 			$query
			// 				->whereNull('e1.militar_id')
			// 				->orWhere(function($query3)  use($previousDay, $now) {
			// 					$query3->whereNotIn('militar.id', function ($query1) use($previousDay, $now) {
			// 						$query1->select('militar_id')
			// 						->from('escala')
			// 						->whereBetween("data", [$now->format('Y-m-d'), $previousDay->format('Y-m-d')]);
			// 					})
			// 					->orWhereNotIn('militar.id', function ($query2) use($previousDay, $now) {
			// 						$query2->select('militarTroca_id')
			// 						->from('escala')
			// 						->whereBetween("data", [$now->format('Y-m-d'), $previousDay->format('Y-m-d')]);
			// 					});
			// 				})
			// 				->orWhereNull('e2.militarTroca_id');
			// 		})
			// 		->distinct()
			// 		->orderBy('postoGraduacao.nivel','desc')
			// 		->inRandomOrder()
			// 		->first();
	
			// 	// dd($militar);
			// 	if(is_null($militar)){
			// 		continue;
			// 	}
	
			// 	Escala::create([
			// 		'postoServico_id' => $posto->id,
			// 		'militar_id' => $militar->id,
			// 		'data' => $now->format('Y-m-d'),
			// 		'tokenCiente' => Str::random(30),
			// 		'tokenCienteTroca' => Str::random(30),
			// 		'uuidEscala' => Uuid::uuid4(),
			// 		'livroPermanencia' => ''
			// 	]);
			// }

		// 	$current++;

		// }


		// dd(Escala::where('data', Carbon::now()->format('Y-m-d'))->get());
		// ob_start();

		// 	foreach(Escala::groupBy('militar_id')->select('militar_id', DB::raw('count(*) as total'))->get() as $e){
		// 		echo 'Militar: '.$e->militar->name.' Data: '.$e->total.'<br/>';
		// 	}

		// echo ob_get_clean();

		// return Escala::all()->map( function ($item){
		// 	return [
		// 		'militar' => $item->militar->name,
		// 		'data' =>  $item->data->format('d/m/Y'),
		// 		'posto_servico' =>  $item->postoServico->nome
		// 	];
		// })->values()->all();

		// dd(Escala::count());

	}
}
