<?php

namespace Database\Seeders;

use App\Models\Militar;
use Illuminate\Support\Str;
use App\Models\PostoGraduacao;
use Illuminate\Database\Seeder;
use App\Models\OrganizacaoMilitar;
use App\Models\Secao;
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
				'password' => Hash::make('12345678'),
				'identidade' => $this->generateIdentidade($faker)
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
				'password' => Hash::make(Str::random(10)),
				'identidade' => $this->generateIdentidade($faker)
			]);
		}

		$secoes = Secao::all();
		$postoGraduacao = PostoGraduacao::all();

		foreach($postoGraduacao as $graduacao) {
			foreach(array_fill(0, 9,"militar") as $key => $value){
				foreach($secoes as $secao){
					$militar = [
						'name' => $faker->name(),
						'email' => $faker->unique()->safeEmail(),
						'nomeGuerra' => $faker->lastName(),
						'organizacaoMilitar_id' => $secao->organizacaoMilitar_id,
						'secao_id' => $secao->id,
						'postoGraduacao_id' => $graduacao->id,
						'ramal' => $faker->numerify('###'),
						'telefoneResidencial' => $faker->numerify('##########'),
						'telefoneCelular' => $faker->numerify('###########'),
						'isAdmin' => false,
						'flgAtivo' => true,
						'email_verified_at' => now(),
						'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
						'remember_token' => Str::random(10),
						'identidade' => $this->generateIdentidade($faker)
					];

					\App\Models\Militar::create($militar);
				}
			}
		}

		// \App\Models\Militar::factory(10)->create();
	}

	private function generateIdentidade($faker)
    {
        $identidade = $faker->regexify('[0-9]{10}');

        while(Militar::where('identidade', $identidade)->first()){
            $identidade = $faker->regexify('[0-9]{10}');
        }

        return $identidade;
    }
}
