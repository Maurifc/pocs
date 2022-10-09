<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterarNomeColunaCaminhoArquivo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagems', function (Blueprint $table) {
            $table->renameColumn('caminhoArquivo', 'nomeArquivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagems', function (Blueprint $table) {
            $table->renameColumn('nomeArquivo', 'caminhoArquivo');
        });
    }
}
