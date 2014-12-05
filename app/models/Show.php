<?php

use lib\DAO\ShowDAO;

class Show {

	private static $dao;

	public static function init() {
		Show::$dao = new ShowDAO();
	}

	public static function todos () {
		return Show::$dao->todos();
	}

	public static function encontrar ( $id ) {
		return Show::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return Show::$dao->encontrarPorCampos( $campos, $valores);
	}

	public function evento() {
		return Show::$dao->evento($this->id_evento);
	}

}