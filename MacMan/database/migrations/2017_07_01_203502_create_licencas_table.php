<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicencasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licencas', function (Blueprint $table) {
            $table->increments('licenca_id');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('cliente_id')->
                                        on('clientes')->onDelete('cascade');
            $table->string('nome_software');
            $table->string('chave')->nullable();
            $table->string('login')->nullable();
            $table->string('senha')->nullable();
            $table->date('data_expiracao')->nullable();
            $table->smallinteger('qnt_ativacoes')->unsigned()->default(1);
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
        Schema::dropIfExists('licencas');
    }
}
