<?php 

class SessaoController extends BaseController {

	public function sair() {
		Autenticador::deslogar();
		return Redirect::to('/');
	}

	public function entrar() {
		
		$email = Input::get('email');
		$senha = Input::get('senha');

		if (Autenticador::autenticar($email, $senha))
			return Redirect::to('/');

		return Redirect::to('login');
	}
}