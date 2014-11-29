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
	$cliente = new Cliente();
	$cliente->username = 'jonshon';
	$cliente->email = 'otwedsfsdfsdfsd@email.com';
	return $cliente->save();
});

Route::get('login', function() { return View::make('login'); });