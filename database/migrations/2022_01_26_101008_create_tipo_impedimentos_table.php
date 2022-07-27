<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoImpedimentosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tipoImpedimento', function (Blueprint $table) {
            $table->id();
            $table->string('nome',255);
            $table->boolean('flgAtivo')->default(1);
            $table->unsignedBigInteger('id_inseridoPor')->nullable();
			$table->unsignedBigInteger('id_atualizadoPor')->nullable();
            $table->timestamps();
        });

        Schema::table('tipoImpedimento', function (Blueprint $table) {
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
		Schema::table('tipoImpedimento', function (Blueprint $table) {
            $table->dropForeign(['id_inseridoPor']);
            $table->dropForeign(['id_atualizadoPor']);
        });

		Schema::dropIfExists('tipoImpedimento');
	}
}
