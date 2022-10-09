<?php

namespace Tests\Feature\app\Http\Controllers\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Cliente;

class ClienteControllerTest extends TestCase
{
  use DatabaseMigrations;
  use WithoutMiddleware;

    /*
    | GET TESTS
    */
    public function test_should_return_all_fields()
    {
      $cliente = factory(Cliente::class)->create();
      $response = $this->json('get', 'api/clientes/1');

      $response->assertJsonStructure(['cliente_id', 'nome', 'email', 'observacao', 'endereco']);
    }

    public function test_should_return_all_clientes(){
      $clientes = factory(Cliente::class, 3)->create();
      $response = $this->json('get', 'api/clientes');
      $response->assertStatus(200);

      foreach ($clientes as $cliente) {
        $response->assertJsonFragment(["nome" => $cliente->nome]);
      }
    }

    public function test_should_return_empty_if_has_no_client()
    {
      $response = $this->json('get', 'api/clientes');

      $response->assertJson(['empty' => true]);
    }

    public function test_should_return_a_client_from_id(){
      $clientes = factory(Cliente::class, 3)->create();

      $response = $this->json('get', 'api/clientes/1');

      $response->assertJson(['nome' => $clientes[0]->nome,
                            'cliente_id' => $clientes[0]->cliente_id,
                            'email' => $clientes[0]->email,
                            'observacao' => $clientes[0]->observacao,
                          ]);
    }

    public function test_invalid_id_should_return_error()
    {
      $response = $this->json('get', 'api/clientes/0');
      $response->assertStatus(404);
      $response->assertJson(['error' => true]);
    }

    /*
    | CREATE/UPDATE TESTS
    */
    public function test_should_create_client_and_return_json()
    {
      $response = $this->json('post', 'api/clientes',[
        'nome' => 'novoCliente',
        'email' => 'novocliente@email.com',
        'observacao' => 'obs',
      ]);

      $response->assertJson(['nome' => 'novoCliente',
        'email' => 'novocliente@email.com',
        'observacao' => 'obs'
      ]);
    }
    
    public function test_empty_name_should_return_error()
    {
      $response = $this->json('post', 'api/clientes',[
        'nome' => '',
        'email' => 'novocliente@email.com',
        'observacao' => 'obs',
      ]);

      $response->assertStatus(422);
    }

    public function test_should_update_client()
    {
      $cliente = factory(Cliente::class)->create();

      $response = $this->json('put', 'api/clientes/1',[
        "nome" => 'novo_nome',
      ]);

      $response->assertJson([
          "nome" => 'novo_nome',
      ]);
    }

    public function test_should_return_error_if_client_do_not_exists()
    {
      $response = $this->json('put', 'api/clientes/1', [
        'nome' => 'nomeQualquer'
      ]);

      $response->assertStatus(404);
    }

    public function test_should_return_error_if_name_is_null_on_update()
    {
      $response = $this->json('put', 'api/clientes/1', [
        'nome' => ''
      ]);

      $response->assertStatus(422);
    }

    /*
    * DELETE
    */
    public function test_should_delete_computer()
    {
      $cliente = factory(Cliente::class)->create();

      $response = $this->json('delete', 'api/clientes/'.$cliente->cliente_id);
      $response->assertStatus(200);
      $response->assertJson([
       'deleted' => $cliente->cliente_id,
       ]);
    }

    public function test_incorrect_id_should_return_error_on_delete()
    {
      $cliente = factory(Cliente::class)->create();

      //comp_id 300 does not exists
      $response = $this->json('delete', 'api/clientes/300');
      $response->assertStatus(404);
      $response->assertJson([
       'error' => 'true',
       ]);
    }

}
