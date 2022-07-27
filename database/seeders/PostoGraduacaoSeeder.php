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
		$graduacoes = [
			['nome' => 'Marechal', 'nivel' => 1],
			['nome' => 'General de Exército', 'nivel'=> 2],
			['nome' => 'General de Divisão', 'nivel'=> 3],
			['nome' => 'General de Brigada', 'nivel'=> 4],
			['nome' => 'Coronel', 'nivel' => 5],
			['nome' => 'Tenente-Coronel', 'nivel' => 6],
			['nome' => 'Major', 'nivel' => 7],
			['nome' => 'Capitão', 'nivel' => 8],
			['nome' => '1º Tenente', 'nivel' =>	9],
			['nome' => '2º Tenente', 'nivel' =>	10],
			['nome' => 'Aspirante a Oficial','nivel'=>11],
			['nome' => 'Subtenente', 'nivel' =>	12],
			['nome' => '1º Sargento', 'nivel' => 13],
			['nome' => '2º Sargento', 'nivel' => 14],
			['nome' => '3º Sargento', 'nivel' => 15],
			['nome' => 'Taifeiro-Mor', 'nivel' => 16],
			['nome' => 'Cabo', 'nivel' =>	17],
			['nome' => 'Taifeiro de 1 Classe', 'nivel'=>18],
			['nome' => 'Taifeiro de 2 Classe','nivel' =>19],
			['nome' => 'Soldado', 'nivel'=> 20],
		];

		foreach($graduacoes as $graduacao){
			\App\Models\PostoGraduacao::create($graduacao);
		}
	}
}
