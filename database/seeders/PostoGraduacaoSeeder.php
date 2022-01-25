<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostoGraduacaoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\App\Models\PostoGraduacao::factory(10)->create();
	}
}
