<?php

use lib\DAO\IngressoDAO;

class Ingresso {

	private static $dao;

	public static function init() {
		Ingresso::$dao = new IngressoDAO();
	}

	public static function todos () {
		return Ingresso::$dao->todos();
	}

	public static function encontrar ( $id ) {
		return Ingresso::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return Ingresso::$dao->encontrarPorCampos( $campos, $valores);
	}

	private function atualizar() {
		return Ingresso::$dao->atualizarIngresso( $this );
	}

	private function inserir() {
		return Ingresso::$dao->inserirIngresso( $this );
	}

	public function save() {

		if( isset($this->id) ) 
			return $this->atualizar();
		
		return $this->inserir();
	}

	public function lugar() {
		return Ingresso::$dao->lugar($this->id);
	}

}
