<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostoGraduacaosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('postoGraduacao', function (Blueprint $table) {
			$table->id();
			$table->string('nome', 45);
			$table->tinyInteger('nivel');
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
		Schema::dropIfExists('postoGraduacao');
	}
}
