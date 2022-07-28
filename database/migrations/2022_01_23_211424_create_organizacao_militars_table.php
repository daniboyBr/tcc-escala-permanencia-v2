<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizacaoMilitarsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('organizacaoMilitar', function (Blueprint $table) {
			$table->id();
			$table->string('nome', 255);
			$table->string('sigla', 10);
			$table->boolean('flgAtivo')->default(true);
			$table->string('inseridoPor', 100)->nullable();
			$table->string('atualizadoPor', 100)->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('organizacaoMilitar');
	}
}
