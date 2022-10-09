<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableComputadoresAddSo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('computadores', function (Blueprint $table) {
            $table->dropColumn('so');
            $table->integer('so_id')->unsigned()->nullable()->after('cliente_id');
            $table->foreign('so_id')->references('so_id')->
                                      on('sistemas_operacionais');
            $table->enum('so_arquitetura', ['x86', 'x64'])->
                                                nullable()->after('so_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('computadores', function (Blueprint $table) {
            // $table->dropColumn('so_id');
            $table->dropForeign('computadores_so_id_foreign');            
            $table->dropColumn('so_arquitetura');
            $table->string('so')->nullable();
        });
    }
}
