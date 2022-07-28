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
			['sigla' => '11º CGCFEx' ,'nome' => '11º Centro de Gestão, Contabilidade e Finanças do Exército'],
			['sigla' => 'B Adm QGEx' ,'nome' => 'Base Administrativa do Quartel-General do Exército'],
			['sigla' => 'CCIEx' ,'nome' => 'Centro de Controle Interno do Exército'],
			['sigla' => 'CDS' ,'nome' => 'Centro de Desenvolvimento de Sistemas'],
			['sigla' => 'COEx' ,'nome' => 'Centro de Obtenções do Exército'],
			['sigla' => 'CPEx' ,'nome' => 'Centro de Pagamento do Exército'],
			['sigla' => 'COTER' ,'nome' => 'Comando de Operações Terrestres'],
			['sigla' => 'COLOG' ,'nome' => 'Comando Logístico'],
			['sigla' => 'DCT' ,'nome' => 'Departamento de Ciência e Tecnologia do Exército'],
			['sigla' => 'DEC' ,'nome' => 'Departamento de Engenharia e Construção'],
			['sigla' => 'DGP' ,'nome' => 'Departamento-Geral do Pessoal '],
			['sigla' => 'DAbst' ,'nome' => 'Diretoria de Abastecimento'],
			['sigla' => 'DAProm' ,'nome' => 'Diretoria de Avaliação e Promoções'],
			['sigla' => 'DCIPAS' ,'nome' => 'Diretoria de Civis, Inativos, Pensionistas e Assistência Social'],
			['sigla' => 'DCont' ,'nome' => 'Diretoria de Contabilidade'],
			['sigla' => 'DCEM' ,'nome' => 'Diretoria de Controle de Efetivo e Movimentações'],
			['sigla' => 'DFPC' ,'nome' => 'Diretoria de Fiscalização de Produtos Controlados'],
			['sigla' => 'DGO' ,'nome' => 'Diretoria de Gestão Orçamentária'],
			['sigla' => 'DMat' ,'nome' => 'Diretoria de Material'],
			['sigla' => 'DMAvEx' ,'nome' => 'Diretoria de Material de Aviação do Exército'],
			['sigla' => 'DME' ,'nome' => 'Diretoria de Material de Engenharia'],
			['sigla' => 'DOC' ,'nome' => 'Diretoria de Obras de Cooperação'],
			['sigla' => 'DOM' ,'nome' => 'Diretoria de Obras Militares'],
			['sigla' => 'DPIMA' ,'nome' => 'Diretoria de Patrimônio Imobiliário e Meio Ambiente'],
			['sigla' => 'DPGO' ,'nome' => 'Departamento Geral do Pessoal'],
			['sigla' => 'DPE' ,'nome' => 'Diretoria de Projetos de Engenharia'],
			['sigla' => 'DSau' ,'nome' => 'Diretoria de Saúde'],
			['sigla' => 'DSM' ,'nome' => 'Diretoria de Serviço Militar'],
			['sigla' => 'DSMEM' ,'nome' => 'Diretoria de Sistemas e Material de Emprego Militar'],
			['sigla' => 'DSG' ,'nome' => 'Diretoria de Serviço Geográfico'],
			['sigla' => 'EME' ,'nome' => 'Estado-Maior do Exército'],
			['sigla' => 'Graf Ex' ,'nome' => 'Gráfica do Exército'],
			['sigla' => 'IEFEX' ,'nome' => 'Instituto de Economia e Finanças do Exército'],
			['sigla' => 'SEF' ,'nome' => 'Secretaria de Economia e Finanças'],
			['sigla' => 'SGE' ,'nome' => 'Secretaria Geral do Exército']
		];

		foreach($oms as $om){
			\App\Models\OrganizacaoMilitar::create($om);
		}
	}
}
