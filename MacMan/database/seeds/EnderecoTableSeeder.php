<?php

use Illuminate\Database\Seeder;
use App\Endereco;
use App\Cliente;

class EnderecoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Endereco::first() === null){
          $endereco = new Endereco;
          $endereco->logradouro = 'Rua de Fátima';
          $endereco->numero = '10';
          $endereco->bairro = 'Centro';
          $endereco->cidade = 'São Paulo';
          Cliente::first()->endereco()->save($endereco);
        }

        echo "Tabela 'enderecos' semeada\n";
    }
}
