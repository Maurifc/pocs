<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComputadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computadores', function (Blueprint $table) {
          $table->increments('comp_id');
          $table->integer('cliente_id')->unsigned();
          $table->foreign('cliente_id')->references('cliente_id')->
                                        on('clientes')->onDelete('cascade');
          $table->string('nome_estacao');
          $table->string('login')->nullable(); //Usuário do so
          $table->string('grupo_trabalho')->nullable();
          $table->string('dominio')->nullable();
          $table->string('so')->nullable();
          $table->ipAddress('ip')->nullable();
          $table->string('nome_usuario')->nullable(); //Pessoa que usa
          $table->text('observacao')->nullable();
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
        Schema::dropIfExists('computadores');
    }
}
