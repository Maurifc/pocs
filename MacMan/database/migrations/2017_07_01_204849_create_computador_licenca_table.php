<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComputadorLicencaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computador_licenca', function (Blueprint $table) {
            $table->integer('comp_id')->unsigned();
            $table->foreign('comp_id')->references('comp_id')->
                                            on('computadores')->onDelete('cascade');
            $table->integer('licenca_id')->unsigned();
            $table->foreign('licenca_id')->references('licenca_id')->
                                            on('licencas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('computador_licenca');
    }
}
