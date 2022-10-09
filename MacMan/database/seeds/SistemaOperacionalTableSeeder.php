<?php

use Illuminate\Database\Seeder;
use App\SistemaOperacional;

class SistemaOperacionalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      if(SistemaOperacional::first() === null){
        $so = new SistemaOperacional();
        $so->titulo = 'Título do SO';
        $so->save();
      }

        echo "Tabela 'sistemas_operacionais' semeada\n";
    }
}
