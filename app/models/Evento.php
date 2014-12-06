<?php

use lib\DAO\EventoDAO;

class Evento {

	private static $dao;

	public static function init() {
		Evento::$dao = new EventoDAO();
	}

	public static function todos ( $aleatorio = null ) {
		return Evento::$dao->todos( $aleatorio );
	}

	public static function encontrar ( $id ) {
		return Evento::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores, $aleatorio = null, $limite = null, $eou = 'and') {
		return Evento::$dao->encontrarPorCampos( $campos, $valores, $aleatorio, $limite, $eou);
	}

	public function instancia_evento() {
		$instancias_retornadas = array();
		$instancias = Evento::$dao->instancia_evento($this->id);
		foreach($instancias as $instancia)
			if (!$instancia->expirou())
				array_push($instancias_retornadas, $instancia);
		return $instancias_retornadas;
	}

	public function filme() {
		return Evento::$dao->filme($this->id);
	}

	public function show() {
		return Evento::$dao->show($this->id);
	}

	public function peca() {
		return Evento::$dao->peca($this->id);
	}

	public static function pesquisa( $expressao ) {
		return Evento::$dao->pesquisa($expressao);
	}

	public static function pesquisaAvancada ( $campos ) {
		return Evento::$dao->pesquisaAvancada($campos);
	}

	public static function seleciona3Eventos( $tipo ) {
		return Evento::$dao->seleciona3Eventos( $tipo );
	}

	public static function retiraReplicados( $eventos ) {
		$existentes = array();
		$eventos_unicos = array();

		foreach ($eventos as $evento) {
			if ( in_array($evento->id, $existentes))
				continue;
			array_push($existentes, $evento->id);
			array_push($eventos_unicos, $evento);
		}
		return $eventos_unicos;
	}

}
