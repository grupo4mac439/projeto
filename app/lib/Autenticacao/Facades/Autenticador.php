<?php namespace lib\Autenticacao\Facades;

use Illuminate\Support\Facades\Facade;

class Autenticador extends Facade {

	protected static function getFacadeAccessor() { return 'autenticador'; }
}