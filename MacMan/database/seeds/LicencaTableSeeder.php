<?php

use Illuminate\Database\Seeder;
use App\Cliente;
use App\Licenca;

class LicencaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      if(Licenca::first() === null){
        $l = new Licenca();
        $l->nome_software = 'Nome Software';
        $l->chave = '0000-0000-0000-0000-0000';
        $l->data_expiracao = '2020/12/31';
        $l->qnt_ativacoes = 5;
        Cliente::first()->licencas()->save($l);
      }

      echo "Tabela 'licencas' semeada\n";
    }
}
