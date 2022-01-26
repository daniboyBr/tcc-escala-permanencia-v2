<?php

namespace Database\Seeders;

use App\Models\Militar;
use Illuminate\Support\Str;
use App\Models\PostoGraduacao;
use Illuminate\Database\Seeder;
use App\Models\OrganizacaoMilitar;
use Illuminate\Support\Facades\Hash;

class MilitarSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = \Faker\Factory::create();
		$om = OrganizacaoMilitar::where('flgAtivo', 1)->inRandomOrder()->limit(1)->first();
		$secao = $om->secao()->where('flgAtivo', 1)->inRandomOrder()->limit(1)->first();
		$postoGraduacao = PostoGraduacao::where('flgAtivo', 1)->inRandomOrder()->limit(1)->first();

		Militar::create([
			'name' => 'Admin',
			'email' => 'admin@escalapermanencia.com',
			'nomeGuerra' => 'Master',
			'organizacaoMilitar_id' => $om->id,
			'secao_id' => $secao->id,
			'postoGraduacao_id' => $postoGraduacao->id,
			'ramal' => $faker->numerify('###'),
			'telefoneResidencial' => $faker->numerify('##########'),
			'telefoneCelular' => $faker->numerify('###########'),
			'isAdmin' => true,
			'flgAtivo' => true,
			'email_verified_at' => now(),
			'remember_token' => Str::random(10),
			'password' => Hash::make('12345678')
		]);
	}
}
