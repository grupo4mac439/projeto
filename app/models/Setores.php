<?php

use lib\DAO\SetoresDAO;

class Setores {

	private static $dao;

	public static function init() {
		Setores::$dao = new SetoresDAO();
	}

	public static function todos () {
		return Setores::$dao->todos();
	}

	public static function encontrar ( $id ) {
		return Setores::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return Setores::$dao->encontrarPorCampos( $campos, $valores);
	}

	public function lugares() {
		return Setores::$dao->lugares($this->id);
	}

	public function instancia_evento() {
		return Setores::$dao->instancia_evento($this->id);
	}

	public function lugares_disponiveis() {
		return Setores::$dao->lugares_disponiveis($this->id);
	}

	public function lugares_livres($qtde){
		return Setores::$dao->lugares_livres($this->id, $qtde);
	}

}
