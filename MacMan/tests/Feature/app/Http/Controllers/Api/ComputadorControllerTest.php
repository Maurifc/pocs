<?php

namespace Tests\Feature\app\Http\Controllers\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Computador;
use App\Cliente;

class ComputadorControllerTest extends TestCase
{
  use WithoutMiddleware;
  use DatabaseMigrations;

  protected $computadores;
  protected $computador;

  /*
  | GETS
  */
  public function test_should_return_all_fields()
  {
    $computadores = $this->insertComputadores();
    $response = $this->json('get',
        'api/computadores/'.$computadores->first()->comp_id);

    $response->assertJsonStructure([
      'comp_id',
      'cliente_id',
      'nome_estacao',
      'login',
      'grupo_trabalho',
      'dominio',
      'so_id',
      'so_arquitetura',
      'ip',
      'nome_usuario',
      'observacao',
    ]);
  }

  public function test_should_return_all_computers()
  {
    $computadores = $this->insertComputadores();
    $response = $this->json('get', 'api/computadores');

    foreach ($computadores as $computador) {
        $response->assertJsonFragment([
          'comp_id' => $computador->comp_id,
        ]);
    }
  }

  public function test_should_return_empty_if_has_no_computer()
  {
    $response = $this->json('get', 'api/computadores');
    $response->assertJson([
     'empty' => true,
     ]);
  }

  public function test_should_return_a_computer_from_id()
  {
    $computador = $this->insertComputador();
    $response = $this->json('get', 'api/computadores/'.$computador->comp_id);
    $response->assertJson([
      'comp_id' => $computador->comp_id
    ]);
  }

  public function test_invalid_id_should_return_error()
  {
    $computador = $this->insertComputador();

    $response = $this->json('get', 'api/computadores/100'); //comp_id 100 doesn't exists
    $response->assertStatus(404);
    $response->assertJson(['error' => true]);
  }

  /*
  | CREATE/UPDATE TESTS
  */
  public function test_should_create_computer_and_return_json()
  {
    $cliente = factory(\App\Cliente::class)->create();
    $so = factory(\App\SistemaOperacional::class)->create();

    $response = $this->json('post', 'api/computadores',[
     'cliente_id'=> $cliente->cliente_id,
     'nome_estacao' => 'EstacaoXX',
     'login' => 'Loginusuario',
     'grupo_trabalho' => 'Grupo de trabalho',
     'dominio' => '',
     'so_id' => $so->so_id,
     'so_arquitetura' => 2,
     'ip' => '192.168.0.100',
     'observacao'=> 'Aut dolores et deserunt nostrum amet consequuntur expedita',
     ]);

     $response->assertJson([
       'cliente_id'=> $cliente->cliente_id,
       'nome_estacao' => 'EstacaoXX',
       'login' => 'Loginusuario',
       'grupo_trabalho' => 'Grupo de trabalho',
       'dominio' => '',
       'so_id' => $so->so_id,
       'so_arquitetura' => 2,
       'ip' => '192.168.0.100',
       'observacao'=> 'Aut dolores et deserunt nostrum amet consequuntur expedita',
      ]);
  }

  public function test_should_return_error_if_client_id_is_null()
  {
    $so = factory(\App\SistemaOperacional::class)->create();

    $response = $this->json('post', 'api/computadores',[
     'cliente_id'=> '',
     'nome_estacao' => 'EstacaoXX',
     'login' => 'Loginusuario',
     'grupo_trabalho' => 'Grupo de trabalho',
     'dominio' => '',
     'so_id' => $so->so_id,
     'so_arquitetura' => 2,
     'ip' => '192.168.0.100',
     'observacao'=> 'Aut dolores et deserunt nostrum amet consequuntur expedita',
     ]);

     $response->assertStatus(422);
  }

  public function test_should_return_error_if_station_name_is_null()
  {
    $cliente = factory(\App\Cliente::class)->create();
    $so = factory(\App\SistemaOperacional::class)->create();

    $response = $this->json('post', 'api/computadores',[
      'cliente_id'=> $cliente->cliente_id,
      'nome_estacao' => '',
      'login' => 'Loginusuario',
      'grupo_trabalho' => 'Grupo de trabalho',
      'dominio' => 'aaa',
      'so_id' => $so->so_id,
      'so_arquitetura' => 2,
      'ip' => '192.168.0.100',
      'observacao'=> 'Aut dolores et deserunt nostrum amet consequuntur expedita',
     ]);

     $response->assertStatus(422);
  }

  public function test_should_return_error_if_cliente_id_invalid()
  {
    $so = factory(\App\SistemaOperacional::class)->create();

    $response = $this->json('post', 'api/computadores', [
     'cliente_id'=> 300, //cliente_id 300 doesn't exists
     'nome_estacao' => 'EstacaoXX',
     'login' => 'Loginusuario',
     'grupo_trabalho' => 'Grupo de trabalho',
     'dominio' => 'aaa',
     'so_id' => $so->so_id,
     'so_arquitetura' => 2,
     'ip' => '192.168.0.100',
     'observacao'=> 'Aut dolores et deserunt nostrum amet consequuntur expedita',
     ]);

     $response->assertStatus(403);

     $response->assertJson([
      'error' => 'true',
      ]);
  }

  public function test_should_update_computer()
  {
    $computador = $this->insertComputador();

    $response = $this->json('put', 'api/computadores/'.$computador->comp_id, [
     'nome_estacao'=> 'novo_nome_estacao',
      'cliente_id'=> $computador->cliente->cliente_id,
    ]);

    $response->assertJson([
     'nome_estacao'=> 'novo_nome_estacao',
    ]);
  }

  public function test_should_return_error_if_computer_do_not_exists()
  {
    $cliente = factory(\App\Cliente::class)->create();

    //comp_id 300 does not exists
    $response = $this->json('put', 'api/computadores/300', [
     'nome_estacao'=> 'novo_nome_estacao',
     'cliente_id'=> $cliente->cliente_id,
    ]);

    $response->assertJson([
     'error' => true,
     ]);
    $response->assertStatus(404);
  }

  public function test_should_return_error_if_station_name_is_null_on_update()
  {
    $computador = $this->insertComputador();

    $response = $this->json('put', 'api/computadores/'.$computador->comp_id, [
     'nome_estacao'=> '',
     'cliente_id'=> $computador->cliente->cliente_id,
    ]);

    $response->assertStatus(422);
  }
  
  /*
  * DELETE
  */
  public function test_should_delete_computer()
  {
    $computador = $this->insertComputador();

    $response = $this->json('delete', 'api/computadores/'.$computador->comp_id);
    $response->assertStatus(200);
    $response->assertJson([
     'deleted' => $computador->comp_id,
     ]);
  }

  public function test_incorrect_id_should_return_error_on_delete()
  {
    $computador = $this->insertComputador();

    //comp_id 300 does not exists
    $response = $this->json('delete', 'api/computadores/300');
    $response->assertStatus(404);
    $response->assertJson([
     'error' => 'true',
     ]);
  }



  //Funções auxiliares
  public function insertComputadores($quantidade = 3)
  {
    return factory(Computador::class, $quantidade)->create();
  }
  public function insertComputador()
  {
    return $this->insertComputadores(1)->first();
  }
}
