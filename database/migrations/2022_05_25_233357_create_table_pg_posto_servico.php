<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePgPostoServico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pgPostoServico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postoGraduacao_id');
            $table->unsignedBigInteger('postoServico_id');
            $table->unsignedBigInteger('id_inseridoPor')->nullable();
			$table->unsignedBigInteger('id_atualizadoPor')->nullable();
            $table->timestamps();
        });

        Schema::table('pgPostoServico', function (Blueprint $table) {
            $table->foreign('postoGraduacao_id')->references('id')->on('postoGraduacao')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('postoServico_id')->references('id')->on('postoServico')->onDelete('NO ACTION')->onUpdate('NO ACTION');
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
        Schema::dropIfExists('pgPostoServico');
    }
}
