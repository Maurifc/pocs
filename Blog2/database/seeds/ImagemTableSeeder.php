<?php

use Illuminate\Database\Seeder;

class ImagemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('imagems')->insert([
        	'post_id' => 1,
        	'legenda' => 'Legenda da imagem',
        	'caminhoArquivo' => 'no-image.png',
        	'imagemDestaque' => 1,
        	]);
    }
}
