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

		$oms = [
			'11º CGCFEx',
			'B Adm QGEx',
			'CCIEx',
			'CDS',
			'COEx',
			'CPEx',
			'COTER',
			'COLOG',
			'DCT',
			'DEC',
			'DGP',
			'DAbst',
			'DAProm',
			'DCIPAS',
			'DCont',
			'DCEM',
			'DFPC',
			'DGO',
			'DMat',
			'DMAvEx',
			'D M E',
			'DOC',
			'DOM',
			'DPIMA',
			'DPGO',
			'DPE',
			'DSau',
			'DSM',
			'DSMEM',
			'DSG',
			'EME',
			'Graf Ex',
			'IEFEX',
			'SEF',
			'SGE'
		];
	}
}
