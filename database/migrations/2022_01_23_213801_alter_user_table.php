<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('militar', function (Blueprint $table) {
			$table->boolean('isAdmin')->default(false);
			$table->integer('flgAtivo')->default(0);

			$table->unsignedBigInteger('organizacaoMilitar_id');
			$table->unsignedBigInteger('secao_id');
			$table->unsignedBigInteger('postoGraduacao_id');

			$table->string('identidade', 20)->unique();
			$table->string('nomeGuerra', 60);
			$table->string('imagem', 45)->nullable();
			$table->string('ramal', 45)->nullable();
			$table->string('telefoneResidencial', 12)->nullable();
			$table->string('telefoneCelular', 12)->nullable();
			$table->unsignedBigInteger('id_inseridoPor')->nullable();
			$table->unsignedBigInteger('id_atualizadoPor')->nullable();
		});

		Schema::table('militar', function (Blueprint $table) {
			$table->foreign('organizacaoMilitar_id')->references('id')->on('organizacaoMilitar')->onDelete('NO ACTION')->onUpdate('NO ACTION');
			$table->foreign('secao_id')->references('id')->on('secao')->onDelete('NO ACTION')->onUpdate('NO ACTION');
			$table->foreign('postoGraduacao_id')->references('id')->on('postoGraduacao')->onDelete('NO ACTION')->onUpdate('NO ACTION');
			$table->foreign('id_inseridoPor')->references('id')->on('militar')->onDelete('NO ACTION')->onUpdate('NO ACTION');
			$table->foreign('id_atualizadoPor')->references('id')->on('militar')->onDelete('NO ACTION')->onUpdate('NO ACTION');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('militar', function (Blueprint $table) {
			$table->dropForeign(['organizacaoMilitar_id']);
			$table->dropForeign(['secao_id']);
			$table->dropForeign(['postoGraduacao_id']);
			$table->dropForeign(['id_inseridoPor']);
			$table->dropForeign(['id_atualizadoPor']);
		});

		Schema::table('militar', function (Blueprint $table) {
			$table->dropColumn([
				'nomeGuerra', 'imagem', 'ramal', 'telefoneResidencial', 'telefoneCelular', 'id_inseridoPor', 'id_atualizadoPor'
			]);
		});
	}
}
