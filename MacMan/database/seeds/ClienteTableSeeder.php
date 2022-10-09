<?php

use Illuminate\Database\Seeder;
use App\Cliente;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      if(Cliente::first() === null){
        $cliente = new Cliente();
        $cliente->nome = 'ClienteExemplo';
        $cliente->email = 'contato@clienteemail.com';
        $cliente->save();
      }

      echo "Tabela 'clientes' semeada\n";
    }
}
