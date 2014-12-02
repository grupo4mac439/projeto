<?php namespace lib\Autenticacao;

use Illuminate\Support\ServiceProvider;

class AutenticadorServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app['autenticador'] = $this->app->share(function($app)
		{
		    return new Autenticador();
		});
	}
}