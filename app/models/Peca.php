<?php

use lib\DAO\PecaDAO;

class Peca {

	private static $dao;

	public static function init() {
		Peca::$dao = new PecaDAO();
	}

	public static function todos () {
		return Peca::$dao->todos();
	}

	public static function encontrar ( $id ) {
		return Peca::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return Peca::$dao->encontrarPorCampos( $campos, $valores);
	}

	public function evento() {
		return Peca::$dao->evento($this->id_evento);
	}

}