<?php

namespace Database\Factories;

use App\Models\OrganizacaoMilitar;
use Illuminate\Database\Eloquent\Factories\Factory;

class SecaoFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		$organizacao = $this->faker->randomElement(OrganizacaoMilitar::where('flgAtivo', 1)->get());

		return [
			'nome' => $this->faker->name(),
			'organizacaoMilitar_id' => $organizacao->id
		];
	}
}
