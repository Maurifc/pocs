<?php
Route::get('/', function () {
    return view('app');
});

/*
* Auth
*/
Route::prefix('auth')->group(function () {
  Route::post('/login', 'AuthController@login')->name('login');
  Route::get('/status', 'AuthController@status')->name('status');
  Route::post('/logout', 'AuthController@logout')->name('logout');
});


/*
* API
*/
Route::prefix('api')->middleware('auth')->namespace('Api')->group(function(){
  Route::resource('clientes', 'ClienteController');
  Route::resource('licencas', 'LicencaController');
  Route::resource('computadores', 'ComputadorController');
});
