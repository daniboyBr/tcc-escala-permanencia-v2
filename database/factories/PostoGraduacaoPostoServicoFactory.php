<?php

namespace Database\Factories;

use App\Models\PostoServico;
use App\Models\PostoGraduacao;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostoGraduacaoPostoServicoFactory extends Factory
{

    	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
        $postoGraduacao = PostoGraduacao::where('flgAtivo', 1)->inRandomOrder()->first();
		$postoServico = PostoServico::where('flgAtivo', 1)->inRandomOrder()->first();


		return [
			'postoGraduacao_id' => $postoGraduacao->id,
			'postoServico_id' => $postoServico->id
		];
	}
}