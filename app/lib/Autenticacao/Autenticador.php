<?php namespace lib\Autenticacao;

use lib\DAO\SuperDAO;
use Cliente;
use Hash;
use Session;

class Autenticador {

	protected $cliente;

	public function cliente() {
		if ( !isset( $this->cliente ) ) {
			$cliente_id = Session::get('cliente');
			$this->cliente = Cliente::encontrar($cliente_id);
		}
		return $this->cliente;
	}

	public function entrar( $cliente ) {
		$this->cliente = $cliente;
		Session::put('cliente', $cliente->id);
	}

	public function logado() {
		return Session::has('cliente');
	}

	public function deslogar() {
		Session::forget('cliente');
	}

	public function autenticar($email, $senha) {
		
	 	$resultado = Cliente::encontrarPorCampos(['email'], [$email]);
		
	 	if ( !isset($resultado) )
	 		return false;

	 	$cliente = array_shift($resultado);

		if ( Hash::check($senha, $cliente->senha) ) {
			$this->entrar($cliente);
			return true;
		}

		return false;
	}
}