<?php

use Illuminate\Database\Seeder;
use App\Computador;
use App\Cliente;

class ComputadorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Computador::first() === null){
          $so_id = App\SistemaOperacional::first()->so_id;

          $c = new Computador();
          $c->nome_estacao = 'EstacaoExemplo';
          $c->login = 'Usuario SO';
          $c->grupo_trabalho = 'GrupoEmpresaExemplo';
          $c->so_id = $so_id;
          $c->so_arquitetura = 'x64';
          $c->ip = '192.168.0.1';
          $c->nome_usuario = 'José';
          Cliente::first()->computadores()->save($c);
        }

        echo "Tabela 'computadores' semeada\n";
    }
}
