<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostoSericoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\App\Models\PostoServico::factory(10)->create();
	}
}
