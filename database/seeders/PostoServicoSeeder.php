<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostoServicoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$servicos = [
			['nome' => 'Oficial de Serviço' ],
			['nome' => 'Aux do Oficial de Serviço' ],
			['nome' => 'Adj' ],
			['nome' => 'Monitoramento 01' ],
			['nome' => 'Monitoramento 02' ],
			['nome' => 'Monitoramento 03' ],
			['nome' => 'Monitoramento 04' ],
			['nome' => 'Portaria Norte' ],
			['nome' => 'Portaria Sul' ],
			['nome' => 'Garagem' ],
			['nome' => 'P1' ],
			['nome' => 'P2' ],
			['nome' => 'P3' ],
			['nome' => 'CB Portiara Norte' ],
			['nome' => 'CB Portaria Sul' ],
			['nome' => 'CB Garagem' ],
			['nome' => 'CB P1' ],
			['nome' => 'CB P2' ],
			['nome' => 'CB P3' ],
			['nome' => 'CB P4' ]
		];

		foreach ($servicos as $servico) {
			\App\Models\PostoServico::create($servico);
		}
	}
}
