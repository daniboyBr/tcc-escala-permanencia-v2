<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpedimentosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('impedimento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipoImpedimento_id');
            $table->unsignedBigInteger('militar_id');
            $table->date('dataInicio');
            $table->date('dataFinal');
            $table->string('arquivo', 100);
			$table->unsignedBigInteger('id_inseridoPor')->nullable();
			$table->unsignedBigInteger('id_atualizadoPor')->nullable();
            $table->timestamps();
        });

        Schema::table('impedimento', function (Blueprint $table) {
            $table->foreign('tipoImpedimento_id')->references('id')->on('tipoImpedimento')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('militar_id')->references('id')->on('militar')->onDelete('NO ACTION')->onUpdate('NO ACTION');
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
		Schema::table('impedimento', function (Blueprint $table) {
			$table->dropForeign(['militar_id']);
			$table->dropForeign(['tipoImpedimento_id']);
			$table->dropForeign(['id_inseridoPor']);
			$table->dropForeign(['id_atualizadoPor']);
		});
		
		Schema::dropIfExists('impedimento');
	}
}
