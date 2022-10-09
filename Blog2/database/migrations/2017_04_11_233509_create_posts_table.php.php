<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo')->unique();
            $table->text('texto');
            $table->boolean('bloqueado');
            $table->dateTime('dataFantasia'); //Data que será apresentada para o usuário do blog
            $table->integer('categoria_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps(); //Data real que o post foi criado
        });


        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
