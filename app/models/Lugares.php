<?php

use lib\DAO\LugaresDAO;

class Lugares {

	private static $dao;

	public static function init() {
		Lugares::$dao = new LugaresDAO();
	}

	public static function todos () {
		return Lugares::$dao->todos();
	}

	public static function encontrar ( $id ) {
		return Lugares::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return Lugares::$dao->encontrarPorCampos( $campos, $valores);
	}

	private function atualizar() {
		return Lugares::$dao->atualizarLugares( $this );
	}

	public function save() {
		return $this->atualizar();		
	}

	public function ingresso() {
		return Lugares::$dao->ingresso($this->id);
	}

	public function reserva() {
		return Lugares::$dao->reserva($this->id);
	}

    public function setor() {
		return Lugares::$dao->setor($this->id);
	}
}
