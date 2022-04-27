<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableOrganizacaoMilitar extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('organizacaoMilitar', function (Blueprint $table) {
			$table->dropColumn('inseridoPor');
			$table->dropColumn('atualizadoPor');
		});

		Schema::table('organizacaoMilitar', function (Blueprint $table) {
			$table->unsignedBigInteger('id_inseridoPor')->nullable();
			$table->unsignedBigInteger('id_atualizadoPor')->nullable();
		});

		Schema::table('organizacaoMilitar', function (Blueprint $table) {
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
		Schema::table('organizacaoMilitar', function (Blueprint $table) {
			$table->dropForeign(['id_inseridoPor']);
			$table->dropForeign(['id_atualizadoPor']);
		});

		Schema::table('organizacaoMilitar', function (Blueprint $table) {
			$table->dropColumn(['id_inseridoPor', 'id_atualizadoPor']);
		});

		Schema::table('organizacaoMilitar', function (Blueprint $table) {
			$table->string('inseridoPor', 100)->nullable();
			$table->string('atualizadoPor', 100)->nullable();
		});
	}
}
