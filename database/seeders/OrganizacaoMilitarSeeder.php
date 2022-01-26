<?php

namespace Database\Seeders;

use App\Models\OrganizacaoMilitar;
use Illuminate\Database\Seeder;

class OrganizacaoMilitarSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// \App\Models\OrganizacaoMilitar::factory(10)->create();

		\App\Models\OrganizacaoMilitar::factory()
			->count(5)
			->hasSecao(5, function (array $attributes, OrganizacaoMilitar $organizacaoMilitar) {
				return ['organizacaoMilitar_id' => $organizacaoMilitar->id];
			})
			->create();
	}
}
