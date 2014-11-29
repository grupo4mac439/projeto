<?php namespace lib\Autenticacao;

use lib\DAO\SuperDAO;
use Cliente;

class Autenticador {

	private static $cliente;

	private static $cliente_dao;

	public static function init() {
		Autenticador::$cliente_dao = new SuperDAO('Cliente');
	}

	public static function cliente() {
		return Autenticador::$cliente;
	}

	public static function entrar( $cliente ) {
		Autenticador::$cliente = $cliente;
	}

	public static function autenticar($email, $senha) {
		
		$credenciais = array('email', 'senha');
		$valores = array($email, $senha);
		$cliente = Autenticador::$cliente_dao->findByFields($credenciais, $valores);
		
		if (isset($cliente)) {
			Autenticador::entrar($cliente);
			return true;
		} 
		return false;
	}
}