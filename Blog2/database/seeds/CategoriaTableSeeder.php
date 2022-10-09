<?php

use Illuminate\Database\Seeder;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Gera 2 categorias
        DB::table('categorias')->insert(
            ['titulo' => 'Hardware']
        );

        DB::table('categorias')->insert(
            ['titulo' => 'Software']
        );
    }
}
