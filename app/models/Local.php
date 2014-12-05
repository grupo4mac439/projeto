<?php

use lib\DAO\LocalDAO;

class Local {

	private static $dao;

	public static function init() {
		Local::$dao = new LocalDAO();
	}

	public static function todos () {
		return Local::$dao->todos();
	}

	public static function encontrar ( $id ) {
		return Local::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return Local::$dao->encontrarPorCampos( $campos, $valores);
	}

	public function instancia_evento() {
		return Local::$dao->instancia_evento($this->id);
	}

}
