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
