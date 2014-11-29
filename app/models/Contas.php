<?php

use lib\DAO\SuperDAO;

class Contas {

	private static $dao;

	static $tabela = 'conta';

	protected $campos = [ 'nconta' ];

	public static function init() {
		Contas::$dao = new SuperDAO('Contas');
	}

	public static function find ( $id ) {
		return Contas::$dao->encontrarPorId ( $id );
	}

	public function clientes() {
		return Contas::$dao->temUm('Cliente', 'conta_id', $this->id);
	}

}

