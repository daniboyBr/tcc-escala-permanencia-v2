<?php

namespace App\Http\Controllers;

use App\Models\Secao;
use Ramsey\Uuid\Uuid;
use App\Models\Escala;
use App\Models\Militar;
use Illuminate\Support\Str;
use App\Models\PostoServico;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\PermanenciaDelivery;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\PostoGraduacaoPostoServico;
use OwenIt\Auditing\Models\Audit;

class EscalaController extends Controller
{
	public function __construct()
	{
		$this->middleware('admin')->only(['trocar', 'efetuarTroca']);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$data = Carbon::now()->format('Y-m-d');

		if ($request->query('data', null)) {
			$data = $request->query('data');
		}

		$escala = Escala::where('data', $data)->get();

		foreach ($escala as $e) {
			$check1 = Auth::user()->isAdmin;
			$check2 = is_null($e->militarTroca_id);
			$check3 = $e->data > Carbon::now();
			$check4 = $e->dtFlgCiente;

			$e->can_switch =  $check1 && $check2 && $check3 && $check4;

			$checkLivro1 = ($e->data == Carbon::now());
			$checkLivro2 = in_array(Auth::user()->id, [$e->militar_id, $e->militarTroca_id]);
			$checkLivro3 = empty(trim($e->livroPermanencia));

			$e->enable_book_record = $checkLivro1 && $checkLivro2 &&  $checkLivro3;
			// $e->enable_book_record = true;
		}

		return view('escala/index', ['escala' => $escala]);
	}

	public function confirm(string $escala, string $token)
	{

		$escala = Escala::where('uuidEscala', $escala)->where('tokenCiente', $token)->first();
		$troca = Escala::where('uuidEscala', $escala)->where('tokenCienteTroca', $token)->first();

		if ($escala) {
			$escala->dtFlgCiente = Carbon::now();
			$escala->FlgCiente = true;
			$escala->save();
		}

		if ($troca) {
			$troca->dtFlgCienteTroca = Carbon::now();
			$troca->FlgCiente = true;
			$troca->save();
		}

		return redirect()->route('home-sistema');
	}

	public function trocar(Request $request, string $escala)
	{
		$escala = Escala::where('uuidEscala', $escala)->first();

		if (is_null($escala)) {
			abort(404);
		}

		if (!is_null($escala->militarTroca)) {
			return redirect()->route('home-sistema')
				->with('error', 'Troca já efetuada para esse posto.');
		}

		$militar = new Militar();

		if ($request->has('identidade')) {

			$militar = Militar::where('identidade',  $request->query('identidade'))
				->where('flgAtivo', 1)
				->first();

			if (is_null($militar)) {
				return redirect()->back()->with('error', 'Militar não encontrado');
			}

			$postos = $escala->postoGraduacao->map(function ($item) {
				return $item->id;
			})->values()->all();

			if (!in_array($militar->postoGraduacao_id, $postos)) {
				return redirect()->back()->with('error', 'Militar não possui a graduação necessária');
			}
		}

		return view('escala/troca', [
			'escala' => $escala,
			'militarTroca' => $militar
		]);
	}

	public function efetuarTroca(Request $request, string $escala)
	{
		$request->validate([
			'militarTroca_id' => 'required|exists:militar,id',
		], [
			'required' => 'Militar para troca é obrigatorio.',
			'exists' => 'Militar deve ser um usuário valido.',
		]);

		$escala = Escala::where('uuidEscala', $escala)->first();

		if (is_null($escala)) {
			abort(404);
		}

		$militar_current = $escala->militar_id;
		$militar_switch =  $request->get('militarTroca_id');

		$escalaTroca = Escala::where('militar_id', $militar_switch)
			->whereNull('militarTroca_id')
			->where('data', '>', Carbon::now()->format('Y-m-d'))
			->latest()
			->first();

		if ($escalaTroca) {
			$escalaTroca->militarTroca_id = $militar_current;
			$escalaTroca->observacaoTroca = $request->get('observacaoTroca');
			$escalaTroca->save();
		}

		$escala->militarTroca_id = $militar_switch;
		$escala->observacaoTroca = $request->get('observacaoTroca');
		$escala->save();

		$user = new \stdClass();
		$user->email = $escala->militar->email;
		$user->name = $escala->militar->name;
		$user->postoServico = $escalaTroca ?  $escalaTroca->postoServico->nome : ' ainda não determinado';
		$user->escala = $escala->uuidEscala;
		$user->tokenCiente = $escala->tokenCienteTroca;
		$user->data = $escalaTroca ? $escalaTroca->data->format('d/m/Y') : ' ainda não foi definida';
		$user->template = PermanenciaDelivery::TEMPLATE_TROCA_ESCALA;

		Mail::send(new PermanenciaDelivery($user));

		$user = new \stdClass();
		$user->email = $escala->militarTroca->email;
		$user->name = $escala->militarTroca->name;
		$user->postoServico = $escala->postoServico->nome;
		$user->escala = $escalaTroca ? $escalaTroca->uuidEscala : '';
		$user->withLink = $escalaTroca ? true : false;
		$user->tokenCiente = $escalaTroca ?  $escalaTroca->tokenCienteTroca : '';
		$user->data = $escala->data->format('d/m/Y');
		$user->template = PermanenciaDelivery::TEMPLATE_TROCA_ESCALA;

		Mail::send(new PermanenciaDelivery($user));

		return redirect()->route('home-sistema')
			->with('success', 'Troca efetuada com sucesso.');
	}

	public function registrarPermanencia(Request $request, string $escala)
	{
		$escala = Escala::where('uuidEscala', $escala)->first();

		if (is_null($escala)) {
			abort(404);
		}

		if (!empty(trim($escala->livroPermanencia))) {
			return redirect()->route('home-sistema')
				->with('error', 'Já foi registrado os relados para essa permanências');
		}

		if (!in_array(Auth::user()->id, [$escala->militar_id, $escala->militarTroca_id])) {
			return redirect()->route('home-sistema')
				->with('error', 'Militar não autorizado para essa escala.');
		}

		if ($request->isMethod('post')) {
			$request->validate([
				'livroPermanencia' => 'required|min:30',
			], [
				'required' => 'É obrigatório preencher o livro de permanência.',
				'min' => 'O texto deve ter no minimo 30 caracteres.',
			]);


			$escala->livroPermanencia = $request->get('livroPermanencia');
			$escala->save();

			return redirect()->route('home-sistema')
				->with('success', 'Registro da Permanência salvo com sucesso');
		}

		return view('escala/livro', [
			'escala' => $escala,
			'militar' => $escala->militarTroca_id ? $escala->militarTroca : $escala->militar
		]);
	}


	public function auditsRecords()
	{
		if(!Auth::user()->isAdmin){
			abort(404);
		}

		return Audit::paginate(50)->toJson();
		// Escala::truncate();
		// dd(Escala::all());
		// dd(Carbon::now()->subDay(3)->format('Y-m-d'));
		// return Escala::where('data', Carbon::now()->subDay(2)->format('Y-m-d'))->get();

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

		// http://localhost:8080/confirm/escala/d8c399ef-cd35-4088-a9a2-849e7b54effb/Gd2xrbdazpbiBa3NpTBEl9NHj0bF7Z

	}
}
