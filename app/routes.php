<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'EventoController@home');

Route::get('login', function() { return View::make('login'); });

Route::post('login', 'SessaoController@entrar');

Route::get('sair', 'SessaoController@sair');

Route::get('cadastro', function() { return View::make('cadastro'); });

Route::post('cadastro', 'ClienteController@cadastro');

Route::post('pesquisa', 'EventoController@pesquisa');

Route::get('exibir/{id}', 'EventoController@exibir')->where('id', '[0-9]+');

Route::get('pesquisa/avancada', function() { return View::make('avancado')->with('eventos', []); });

Route::post('pesquisa/avancada', 'EventoController@pesquisaAvancada');

Route::get('instancia/{id}', 'InstanciaEventoController@mostrar')->where('id', '[0-9]+');

Route::post('reservar/{instancia_id}/{setor_id}', 'ReservaController@reservar');