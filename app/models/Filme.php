<?php

use lib\DAO\FilmeDAO;

class Filme {

	private static $dao;

	public static function init() {
		Filme::$dao = new FilmeDAO();
	}

	public static function todos () {
		return Filme::$dao->todos();
	}

	public static function encontrar ( $id ) {
		return Filme::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return Filme::$dao->encontrarPorCampos( $campos, $valores);
	}

	public function evento() {
		return Filme::$dao->evento($this->id_evento);
	}

}