<?php

// use lib\DAO\SuperDAO;
use lib\DAO\ClienteDAO;

class Cliente {

	private static $dao;

	public static function init() {
		Cliente::$dao = new ClienteDAO();
	}

	public static function todos ( $aleatorio = null ) {
		return Cliente::$dao->todos( $aleatorio );
	}

	public static function encontrar ( $id ) {
		return Cliente::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores, $aleatorio = null, $limite = null ) {
		return Cliente::$dao->encontrarPorCampos( $campos, $valores, $aleatorio, $limite );
	}

	private function atualizar() {
		return Cliente::$dao->atualizarCliente( $this );
	}

	private function inserir() {
		return Cliente::$dao->inserirCliente( $this );
	}

	public function save() {

		if( isset($this->id) ) 
			return $this->atualizar();
		
		return $this->inserir();

	}

	public function compra() {
		return Cliente::$dao->compra($this->id);
	}

	public function reserva() {
		return Cliente::$dao->reserva($this->id);
	}

}
