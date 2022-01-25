<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizacaoMilitarFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'nome' => $this->faker->name(),
			'sigla' => strtoupper($this->faker->lexify('???'))
		];
	}
}
