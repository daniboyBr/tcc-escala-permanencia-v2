<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecaosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('secao', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('organizacaoMilitar_id');
			$table->string('nome', 60);
			$table->boolean('flgAtivo')->default(true);
			$table->string('inseridoPor', 100)->nullable();
			$table->string('atualizadoPor', 100)->nullable();
			$table->timestamps();
		});

		Schema::table('secao', function (Blueprint $table) {
			$table->foreign('organizacaoMilitar_id')->references('id')->on('organizacaoMilitar')->onDelete('NO ACTION')->onUpdate('NO ACTION');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('secao');
	}
}
