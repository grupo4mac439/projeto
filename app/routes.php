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

Route::get('/', function()
{
	return Redirect::to('home');
	$retorno = Contas::find(1)->clientes();
	return dd($retorno);
	//return var_dump( Cliente::findByFields( array('id' => '>'), array('1') ) );
	// $cliente = new Cliente();
	// $cliente->username = 'jonshon';
	// $cliente->email = 'otwedsfsdfsdfsd@email.com';
	// return $cliente->save();
});

Route::get('home', function() { return View::make('home'); });

Route::get('login', function() { return View::make('login'); });