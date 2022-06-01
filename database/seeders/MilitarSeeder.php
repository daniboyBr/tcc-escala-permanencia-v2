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
	private $om;
	private $secao;
	private $postoGraduacao;

	private function setDependences()
	{
		$this->om = OrganizacaoMilitar::where('flgAtivo', 1)
			->whereHas('secao', function($q) {
				$q->whereNotNull('id');
				$q->where('flgAtivo',1);
			})
			->inRandomOrder()
			->first();
		$this->secao = $this->om->secao()->where('flgAtivo', 1)->inRandomOrder()->first();
		$this->postoGraduacao = PostoGraduacao::where('flgAtivo', 1)->inRandomOrder()->first();
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = \Faker\Factory::create();

		$this->setDependences();

		$militar = Militar::where(['email'=>'admin@permanencia.com'])->get()->first();

		if(!$militar){

			Militar::create([
				'name' => 'Admin',
				'email' => 'admin@permanencia.com',
				'nomeGuerra' => 'Master',
				'organizacaoMilitar_id' => $this->om->id,
				'secao_id' => $this->secao->id,
				'postoGraduacao_id' => $this->postoGraduacao->id,
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

		$militar = Militar::where(['email'=>'sistema@permanencia.com'])->get()->first();

		$this->setDependences();

		if(!$militar){
			Militar::create([
				'name' => 'Sistema',
				'email' => 'sistema@permanencia.com',
				'nomeGuerra' => 'System',
				'organizacaoMilitar_id' => $this->om->id,
				'secao_id' => $this->secao->id,
				'postoGraduacao_id' => $this->postoGraduacao->id,
				'ramal' => $faker->numerify('###'),
				'telefoneResidencial' => $faker->numerify('##########'),
				'telefoneCelular' => $faker->numerify('###########'),
				'isAdmin' => false,
				'flgAtivo' => true,
				'email_verified_at' => now(),
				'remember_token' => Str::random(10),
				'password' => Hash::make(Str::random(10))
			]);
		}

		\App\Models\Militar::factory(10)->create();
	}
}
