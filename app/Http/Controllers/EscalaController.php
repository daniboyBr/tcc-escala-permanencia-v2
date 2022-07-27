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
		$previousDay = Carbon::now()->subDays(1);
		$now =  Carbon::now();

		DB::enableQueryLog();

		$postoServico = PostoServico::with('postoGraduacao')->whereHas('postoGraduacao')
							->whereNotIn('id', function ($query) use($now) {
								$query->select('postoServico_id')
									->from('escala')
									->where('data', $now->format('Y-m-d'));
							})->get();

		// dd($postoServico);
		foreach($postoServico as $posto){
			$enabledGraducao = $posto->postoGraduacao->map(function ($item) {
				return $item->id;
			});

			$militar = Militar::select('militar.*')->where('militar.flgAtivo',1)
				->whereNotIn('militar.id', function ($query) use($previousDay, $now) {
					$query->select('militar_id')
						->from('escala')
						->where('data', $previousDay->format('Y-m-d'))
						->orWhere('data',$now->format('Y-m-d'));
				})
				->whereNotIn('militar.id', function ($query) use($previousDay, $now) {
					$query->select('militarTroca_id')
						->from('escala')
						->where('data', $previousDay->format('Y-m-d'))
						->orWhere('data',$now->format('Y-m-d'));
				})
				->join('postoGraduacao','postoGraduacao.id','militar.postoGraduacao_id')
				->leftjoin('impedimento', 'impedimento.militar_id','militar.id')
				->whereRaw("
					((? NOT BETWEEN impedimento.dataInicio AND impedimento.dataFinal) OR impedimento.id is null)", [$now->format('Y-m-d')])
				->whereIn('postoGraduacao.id', $enabledGraducao)
				->orderBy('postoGraduacao.nivel','desc')
				->get();

			dd($militar);
			
			if(is_null($militar)){
				continue;
			}

			Escala::create([
				'postoServico_id' => $posto->id,
				'militar_id' => $militar->id,
				'data' => Carbon::now(),
				'tokenCiente' => Str::random(30),
				'tokenCienteTroca' => Str::random(30),
				'uuidEscala' => Uuid::uuid4(),
				'livroPermanencia' => ''
			]);
		}

		dd(Escala::all()->toArray());
	}
}
