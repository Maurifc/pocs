<?php

namespace Tests\Feature\app\Http\Controllers\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class AuthControllerTeste extends TestCase
{
  use DatabaseMigrations;
  use DatabaseTransactions;

  public function test_user_should_login()
  {
    $user = factory(User::class)->create([
      'password' => bcrypt('123')
    ]);

    //Faz login
    $response = $this->json('post', 'auth/login',[
      'login' => $user->login,
      'password' => '123',
    ]);

    //Verifica se logou
    $response->assertJson([
      'logou' => true,
    ]);
  }

  public function test_should_return_error_when_invalid_credentials()
  {
    $user = factory(User::class)->create([
      'password' => bcrypt('123')
    ]);

    //Tentar logar com senha errada
    $response = $this->json('post', 'auth/login',[
      'login' => $user->login,
      'password' => 'senha-errada',
    ]);

    //Verifica se retornou o erro
    $response->assertJson([
      'logou' => false,
    ]);
  }

  //Pode fazer logout
  public function test_user_should_logout()
  {
    $user = factory(User::class)->create([
      'password' => bcrypt('123')
    ]);

    //Faz login
    $this->json('post', 'auth/login',[
      'login' => $user->login,
      'password' => '123',
    ]);

    //Faz logout
    $response = $this->json('post', 'auth/logout');

    // Verifica a saída
    $response->assertJson([
      'deslogou' => true,
    ]);
  }

  public function test_should_return_status_logged()
  {
    $user = factory(User::class)->create([
      'password' => bcrypt('123')
    ]);

    //Faz login
    $response = $this->json('post', 'auth/login',[
      'login' => $user->login,
      'password' => '123',
    ]);

    //Verifica o status
    $response = $this->json('get', 'auth/status');

    //Retorna true se o usuário de fato está logado
    $response->assertJson([
      'logado' => true,
    ]);
  }

  public function test_should_return_status_is_not_logged()
  {
    //Login omitido

    //Verifica o status
    $response = $this->json('get', 'auth/status');

    //Retorna false pois usuário nenhum foi logado
    $response->assertJson([
      'logado' => false,
    ]);
  }

}
