<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefones', function (Blueprint $table) {
            $table->increments('telefone_id');
            $table->string('numero')->comments('DDD + Telefone');
            $table->enum('tipo', ['fixo', 'celular', 'whatsapp']);
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('cliente_id')->
                                          on('clientes')->onDelete('cascade');
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
        Schema::dropIfExists('telefones');
    }
}
