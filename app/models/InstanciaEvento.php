<?php

use lib\DAO\InstanciaEventoDAO;

class InstanciaEvento {

	private static $dao;

	public static function init() {
		InstanciaEvento::$dao = new InstanciaEventoDAO();
	}

	public static function todos () {
		return InstanciaEvento::$dao->todos();
	}

	public static function encontrar ( $id ) {
		return InstanciaEvento::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return InstanciaEvento::$dao->encontrarPorCampos( $campos, $valores);
	}

	public function evento() {
		return InstanciaEvento::$dao->evento($this->id);
	}

	public function setores() {
		return InstanciaEvento::$dao->setores($this->id);
	}

	public function local() {
		return InstanciaEvento::$dao->local($this->id);
	}

	public function expirou() {

		$hoje = strtotime(date('Y-m-d')); //yyyy-mm-dd
		
		$data = strtotime($this->data);
		
		$agora = strtotime(date('H:i:s'));

		$hora = strtotime($this->hora);

		if ( $hoje > $data || ($hoje == $data && $agora > $hora) ) {
			return true;
		}
		
		return false;
	}

}
