<?php
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'login' => strtolower($faker->name),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

//Cliente
$factory->define(App\Cliente::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'observacao' => $faker->text()
    ];
});

//Licenca
$factory->define(App\Licenca::class, function(Faker\Generator $faker){
  return [
    'cliente_id' => factory(App\Cliente::class)->create()->cliente_id,
    'nome_software' =>  $faker->word,
    'chave' =>  '00000-00000-00000-00000-00000',
    'login' =>  $faker->word,
    'senha' =>  bcrypt('123456'),
    'data_expiracao' =>  $faker->dateTimeThisYear->format('Y-m-d'),
    'qnt_ativacoes' =>  rand(1, 20),
    'observacao' => $faker->sentence,
  ];
});

//Sistema Operacional
$factory->define(App\SistemaOperacional::class, function(Faker\Generator $faker){
  return [
    'titulo' => 'SO '.$faker->word,
  ];
});

//Computador
$factory->define(App\Computador::class, function(Faker\Generator $faker){
  $numeroEstacao = rand(1, 30);
  return [
    'cliente_id' => factory(App\Cliente::class)->create()->cliente_id,
    'nome_estacao' => 'Estacao'.$numeroEstacao,
    'login' =>  $faker->word,
    'grupo_trabalho' => $faker->word,
    'dominio' => '',
    'so_id' => factory(App\SistemaOperacional::class)->create()->so_id,
    'so_arquitetura' => rand(1, 2),
    'ip' => '192.168.0.'.$numeroEstacao,
    'nome_usuario' => $faker->name,
    'observacao' => $faker->sentence,
  ];
});
