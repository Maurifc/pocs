<?php

namespace Tests\Feature\app\Http\Controllers\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Licenca;

class LicencaControllerTest extends TestCase
{
  use WithoutMiddleware;
  use DatabaseMigrations;

  /*
  | GETS
  */
  public function test_should_return_all_fields()
  {
    $licenca = factory(Licenca::class)->create();
    $response = $this->json('get', 'api/licencas/1');

    $response->assertJsonStructure([
      'licenca_id',
      'cliente_id',
      'nome_software',
      'chave',
      'login',
      'senha',
      'data_expiracao',
      'qnt_ativacoes',
      'observacao'
    ]);
  }

  public function test_should_return_all_licencas()
  {
    $licencas = factory(Licenca::class, 3)->create();

    $response = $this->json('get', 'api/licencas');

    foreach ($licencas as $licenca) {
        $response->assertJsonFragment([
          'licenca_id' => $licenca->licenca_id,
        ]);
    }
  }

  public function test_should_return_empty_if_has_no_licenca()
  {
    $response = $this->json('get', 'api/licencas');
    $response->assertJson([
     'empty' => true,
     ]);
  }


  public function test_should_return_a_license_from_id()
  {
    $licenca = factory(Licenca::class)->create();

    $response = $this->json('get', 'api/licencas/'.$licenca->licenca_id);
    $response->assertJson([
      'licenca_id' => $licenca->licenca_id
    ]);
  }

  public function test_invalid_id_should_return_error()
  {
    $licenca = $this->licencas = factory(Licenca::class)->create();

    $response = $this->json('get', 'api/licencas/100');
    $response->assertStatus(404);
    $response->assertJson(['error' => true]);
  }

  /*
  | CREATE/UPDATE TESTS
  */
  public function test_should_create_license_and_return_json()
  {
    $cliente = factory(\App\Cliente::class)->create();

    $response = $this->json('post', 'api/licencas',[
     'cliente_id'=> $cliente->cliente_id,
     'nome_software'=> 'Kaspersky',
     'chave'=> '0000-0000-0000-0000',
     'login'=> 'login-',
     'senha'=> 'senha-',
     'data_expiracao'=> '2016-09-15',
     'observacao'=> 'Aut dolores et deserunt nostrum amet consequuntur expedita',
     ]);

     $response->assertJson([
       'cliente_id'=> $cliente->cliente_id,
       'nome_software'=> 'Kaspersky',
       'chave'=> '0000-0000-0000-0000',
       'login'=> 'login-',
       'senha'=> 'senha-',
       'data_expiracao'=> '2016-09-15',
       'observacao'=> 'Aut dolores et deserunt nostrum amet consequuntur expedita',
      ]);
  }

  public function test_should_return_error_if_cliente_id_null()
  {
    $response = $this->json('post', 'api/licencas',[
     'cliente_id'=> '',
     'nome_software'=> 'Kaspersky',
     'chave'=> '0000-0000-0000-0000',
     'login'=> 'login-',
     'senha'=> 'senha-',
     'data_expiracao'=> '2016-09-15',
     'observacao'=> 'Aut dolores et deserunt nostrum amet consequuntur expedita',
     ]);

     $response->assertStatus(422);
  }

  public function test_should_return_error_if_software_name_null()
  {
    $cliente = factory(\App\Cliente::class)->create();

    $response = $this->json('post', 'api/licencas',[
     'cliente_id'=> '1',
     'nome_software'=> '',
     'chave'=> '0000-0000-0000-0000',
     'login'=> 'login-',
     'senha'=> 'senha-',
     'data_expiracao'=> '2016-09-15',
     'observacao'=> 'Aut dolores et deserunt nostrum amet consequuntur expedita',
     ]);

     $response->assertStatus(422);
  }

  public function test_should_return_error_if_cliente_id_invalid()
  {
    $response = $this->json('post', 'api/licencas', [
     'cliente_id'=> 300, //cliente_id 300 doesn't exists
     'nome_software'=> 'Kaspersky',
     'chave'=> '0000-0000-0000-0000',
     'login'=> 'login-',
     'senha'=> 'senha-',
     'data_expiracao'=> '2016-09-15',
     'observacao'=> 'Aut dolores et deserunt nostrum amet consequuntur expedita',
     ]);


     $response->assertJson([
      'error' => 'true',
      ]);
      $response->assertStatus(403);
  }

  public function test_should_update_client()
  {
    $licenca = factory(Licenca::class)->create();

    $response = $this->json('put', 'api/licencas/'.$licenca->licenca_id, [
     'nome_software'=> 'novo_nome_software',
     'cliente_id'=> $licenca->cliente->cliente_id,
    ]);

    $response->assertJson([
     'nome_software'=> 'novo_nome_software',
    ]);
  }

  public function test_should_return_error_if_license_do_not_exists()
  {
    //licenca_id 300 do not exists
    $response = $this->json('put', 'api/licencas/300', [
     'nome_software'=> 'novo_nome_software',
     'cliente_id'=> 1,
    ]);

    $response->assertJson([
     'error' => true,
     ]);
    $response->assertStatus(404);
  }

  public function test_should_return_error_if_software_name_is_null_on_update()
  {
    $licenca = factory(Licenca::class)->create();

    $response = $this->json('put', 'api/licencas/'.$licenca->licenca_id, [
     'nome_software'=> '',
     'cliente_id'=> $licenca->cliente->cliente_id,
    ]);

    $response->assertStatus(422);
  }

  /*
  * DELETE
  */
  public function test_should_delete_computer()
  {
    $licenca = factory(Licenca::class)->create();

    $response = $this->json('delete', 'api/licencas/'.$licenca->licenca_id);
    $response->assertStatus(200);
    $response->assertJson([
     'deleted' => $licenca->licenca_id,
     ]);
  }

  public function test_incorrect_id_should_return_error_on_delete()
  {
    $licenca = factory(Licenca::class)->create();

    //comp_id 300 does not exists
    $response = $this->json('delete', 'api/licencas/300');
    $response->assertStatus(404);
    $response->assertJson([
     'error' => 'true',
     ]);
  }
}
