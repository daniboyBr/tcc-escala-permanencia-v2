<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostoGraduacaoFactory extends Factory
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
			'nivel' => $this->faker->randomDigit()
		];
	}
}
