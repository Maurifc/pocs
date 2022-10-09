<?php

use Illuminate\Database\Seeder;
use App\Telefone;
use App\Cliente;

class TelefoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      if(Telefone::first() === null){
        $tel = new Telefone();
        $tel->numero = '32 0000-0000';
        $tel->tipo = 'fixo';
        Cliente::first()->telefones()->save($tel);
      }

      echo "Tabela 'telefones' semeada\n";
    }
}
