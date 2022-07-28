<?php

namespace Database\Seeders;

use App\Models\OrganizacaoMilitar;
use Illuminate\Database\Seeder;

class SecaoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$oms = \App\Models\OrganizacaoMilitar::all();

		$secoes = [
			'EME',
			'Seç Avl',
			' Seç Pes',
			'SCCR',
			'Asse Intlg',
			'SApur',
			'SAAPes',
			'AsseJur',
			'SPE',
			'Seç Infor'
		];

		foreach($oms as $om){
			foreach($secoes as $secao){
				\App\Models\Secao::create([
					'nome' => $secao,
					'organizacaoMilitar_id' => $om->id
				]);
			}
		}
	}
}
