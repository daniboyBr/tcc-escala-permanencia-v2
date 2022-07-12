<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEscala extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escala', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postoServico_id');
            $table->unsignedBigInteger('militar_id');
            $table->unsignedBigInteger('militarTroca_id')->nullable();
            $table->unsignedBigInteger('id_inseridoPor')->nullable();
			$table->unsignedBigInteger('id_atualizadoPor')->nullable();
            $table->date('data');
            $table->text('livroPermanencia');
            $table->dateTime('emailEnviado')->nullable();
            $table->dateTime('telegramEnviado')->nullable();
            $table->boolean('FlgCiente')->default(false);
            $table->dateTime('dtFlgCiente')->nullable();
            $table->dateTime('dtFlgCienteTroca')->nullable();
            $table->string('tokenCiente',30)->nullable();
            $table->string('tokenCienteTroca',30)->nullable();
            $table->text('observacao')->nullable();
            $table->text('observacaoTroca')->nullable();
            $table->string('uuidEscala', 36);
            $table->timestamps();
        });

        Schema::table('escala', function (Blueprint $table) {
            $table->foreign('militar_id')->references('id')->on('militar')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('postoServico_id')->references('id')->on('postoServico')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('militarTroca_id')->references('id')->on('militar')->onDelete('NO ACTION')->onUpdate('NO ACTION');
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
        Schema::table('escala', function (Blueprint $table) {
            $table->dropForeign(['militar_id']);
            $table->dropForeign(['postoServico_id']);
            $table->dropForeign(['militarTroca_id']);
            $table->dropForeign(['id_inseridoPor']);
            $table->dropForeign(['id_atualizadoPor']);
        });

        Schema::dropIfExists('escala');
    }
}
