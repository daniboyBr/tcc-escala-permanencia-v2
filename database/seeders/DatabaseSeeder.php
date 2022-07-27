<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\MilitarSeeder;
use Database\Seeders\PostoServicoSeeder;
use Database\Seeders\PostoGraduacaoSeeder;
use Database\Seeders\TipoImpedimentoSeeder;
use Database\Seeders\OrganizacaoMilitarSeeder;
use Database\Seeders\PostoGraducaoPostoServicoSeeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// \App\Models\User::factory(10)->create();
		$this->call(OrganizacaoMilitarSeeder::class);
		$this->call(PostoGraduacaoSeeder::class);
		$this->call(PostoServicoSeeder::class);
		$this->call(PostoGraducaoPostoServicoSeeder::class);
		$this->call(TipoImpedimentoSeeder::class);
		$this->call(MilitarSeeder::class);
	}
}
