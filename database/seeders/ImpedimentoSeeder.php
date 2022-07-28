<?php

namespace Database\Seeders;

use App\Models\Militar;
use App\Models\Impedimento;
use Illuminate\Support\Str;
use App\Models\TipoImpedimento;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use App\Models\OrganizacaoMilitar;

class ImpedimentoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = \Faker\Factory::create();

		$timpoImpedimento = TipoImpedimento::all();

		foreach($timpoImpedimento as $tipo){
			$militar = Militar::doesntHave('impedimentos')->inRandomOrder()->first();
			$date = $faker->dateTimeBetween(date('Y-m-d'), '+1 month');
			Impedimento::create([
				'militar_id' => $militar->id,
				'arquivo' => UploadedFile::fake()->create(Str::random(10).'.pdf', 1000)->store('impedimento'),
				'dataInicio' => $date,
				'dataFinal' => $faker->dateTimeBetween($date, '+2 month'),
				'tipoImpedimento_id' => $tipo->id
			]);
		}
	}
}
