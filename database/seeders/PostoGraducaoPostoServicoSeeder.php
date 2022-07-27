<?php

namespace Database\Seeders;

use App\Models\PostoGraduacaoPostoServico;
use Illuminate\Database\Seeder;

class PostoGraducaoPostoServicoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$cabo = \App\Models\PostoGraduacao::where('nivel', 17)->first();
		$servicosCabo = [
			'CB Portiara Norte',
			'CB Portaria Sul',
			'CB Garagem',
			'CB P1',
			'CB P2',
			'CB P3',
			'CB P4',
		];

		$servicos = \App\Models\PostoServico::whereIn('nome', $servicosCabo)->get();
		foreach($servicos as $servico){
			PostoGraduacaoPostoServico::create([
				PostoGraduacaoPostoServico::POSTO_GRADUACAO_ID => $cabo->id,
				PostoGraduacaoPostoServico::POSTO_SERVICO_ID => $servico->id
			]);
		}

		$sargentos = \App\Models\PostoGraduacao::whereIn('nivel', [14,15])->get();
		$servivoSargento = [
			'Monitoramento 01',
			'Monitoramento 02',
			'Monitoramento 03',
			'Monitoramento 04',
			'Portaria Norte',
			'Portaria Sul',
			'Garagem',
			'P1',
			'P2',
			'P3',
		];

		$servicos = \App\Models\PostoServico::whereIn('nome', $servivoSargento)->get();
		foreach($servicos as $servico){
			foreach($sargentos as $sargento){
				PostoGraduacaoPostoServico::create([
					PostoGraduacaoPostoServico::POSTO_GRADUACAO_ID => $sargento->id,
					PostoGraduacaoPostoServico::POSTO_SERVICO_ID => $servico->id
				]);
			}
		}

		$demais = \App\Models\PostoGraduacao::whereIn('nivel', [9,10,11])->get();
		$servicosDemais = [
			'Oficial de Serviço',
			'Aux do Oficial de Serviço',
		];
		$servicos = \App\Models\PostoServico::whereIn('nome', $servicosDemais)->get();
		foreach($servicos as $servico){
			foreach($demais as $oficias){
				PostoGraduacaoPostoServico::create([
					PostoGraduacaoPostoServico::POSTO_GRADUACAO_ID => $oficias->id,
					PostoGraduacaoPostoServico::POSTO_SERVICO_ID => $servico->id
				]);
			}
		}

		$primeiroSargento = \App\Models\PostoGraduacao::where('nivel', 13)->first();
		$servico = \App\Models\PostoServico::where('nome', 'Adj')->first();
		PostoGraduacaoPostoServico::create([
			PostoGraduacaoPostoServico::POSTO_GRADUACAO_ID => $primeiroSargento->id,
			PostoGraduacaoPostoServico::POSTO_SERVICO_ID => $servico->id
		]);

		// \App\Models\Secao::factory()->count(5)->for(OrganizacaoMilitar::factory()->create())->create();
	}
}
