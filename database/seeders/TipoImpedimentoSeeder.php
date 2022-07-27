<?php

namespace Database\Seeders;

use App\Models\OrganizacaoMilitar;
use App\Models\TipoImpedimento;
use Illuminate\Database\Seeder;

class TipoImpedimentoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$impedimentos = [
			'A Disposição do Médico Perito da Guarnição - A Dispo MPGU, 365 dias',
			'A Disposição do Médico Perito da Organização Militar - A Dispo MPOM, 30 dias',
			'Adjunto de Comando - Adj Cmdo, 365 dias',
			'Auxiliar Estado-Maior - Aux EM, 365 dias',
			'Auxiliar do Escalante - Aux Esc, 365 dias',
			'Baixado em Hospital - Baixado Hosp, 365 dias',
			'Curso de Formação de Cabo - CFC, 100 dias',
			'Chefe de Contingente - Ch Contg, 365 dias',
			'Concurso Público - Conc Pub, 2 dias',
			'Convocação de Atleta - Convc Atlt, 365 dias',
			'Cozinheiro/Copeiro - Coz/Copeiro, 365 dias',
			'Cursos e Estágios - Cur Estg, 365 dias',
			'Desconto em Férias - Desc Fri, 11 dias',
			'Dispensa de Ano Novo - Disp Ano Novo, 8 dias',
			'Dispensa de Fim de Ano - Disp Fim Ano, 15 dias',
			'Dispensa por Instalação - Disp Inst, 13 dias',
			'Dispensa Médica - Disp Med, 16 dias',
			'Dispensa Médica (COVID-19) - Disp Med (COVID-19), 21 dias',
			'Dispensa de Natal - Disp Natal, 8 dias',
			'Dispensa como Recompensa - Disp Recompensa, 11 dias',
			'Composição de Efetivo de Contingente - Ef Contg, 365 dias',
			'Encarregado do Material - Enc MC, 365 dias',
			'Escalante Substituto - Esc Substituto, 365 dias',
			'Escala de Serviço Específica - Esc Sv Epcf, 365 dias',
			'Escalante Titular - Esc Titular, 365 dias',
			'Fora da Força - F For, 365 dias',
			'Férias - Fri, 37 dias',
			'Função Privativa de Capitão ou Oficial Superior - Func Prvt Cap Of Sp, 365 dias',
			'Grupo de Risco (COVID-19) - GR (COVID-19), 365 dias',
			'Licença Especial - L Esp, 365 dias',
			'Licença Gestante - L Gestante, 365 dias',
			'Licença Maternidade - L Maternidade, 23 dias',
			'Licença Paternidade - L Paternidade, 23 dias',
			'Licenciado - Lic, 365 dias',
			'Licença para Tratamento de Interesse Particular - LTIP, 730 dias',
			'Licença para Tratamento de Saúde - LTS, 365 dias',
			'Licença para Tratamento de Saúde de Pessoa da Família - LTSPF, 365 dias',
			'Luto - Luto, 11 dias',
			'Missão no Exterior - Mis Ext, 730 dias',
			'Missão fora da Guarnição - Mis Fora GU, 365 dias',
			'Missão Interna na OM - Mis Intr OM, 365 dias',
			'Motorista - Mot, 365 dias',
			'Movimentado para Outra OM - Mov OM, 365 dias',
			'Não apresentado - N Apres, 365 dias',
			'Núpcias - Nupcias, 11 dias',
			'Ocupa Cargo Cap ou Superior letra b) do inciso II do Art. 186 do Regulamento Interno de dos Serviços Gerais (RISG). - Ocupa cargo Cap ou Superior, 1825 dias',
			'Operador de Boletim Interno - Op BI, 365 dias',
			'Ordenança - Ordn, 365 dias',
			'Outros - Outros, 365 dias',
			'Promoção - Prom, 365 dias',
			'Protocolista - Prot, 365 dias',
			'Passagem à Disposição de Órgão Fora da Força - Psg A Dispo Fora, 730 dias',
			'Passagem à Disposição de Outra OM - Psg A Dispo OM, 730 dias',
			'Punição (Prisão/Detenção) - Punição, 30 dias',
			'Reintegrado - R, 730 dias',
			'Reserva Remunerada - RR, 365 dias',
			'Sargenteante/Brigada - Sgte/Bda, 365 dias',
			'Serviço Interno na OM - Sv Intr OM, 5 dias',
			'Serviço de Sombra - Sv Sombra, 365 dias',
			'Viagem a Serviço - Vgm Sv, 30 dias',
		];

		foreach($impedimentos as $impedimento){
			TipoImpedimento::create([
				'nome' => trim($impedimento)
			]);
		}
		// \App\Models\Secao::factory()->count(5)->for(OrganizacaoMilitar::factory()->create())->create();
	}
}
