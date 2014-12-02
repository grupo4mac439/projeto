<?php

use lib\DAO\SuperDAO;

class Show {

	private static $dao;

	static $tabela = 'Show';

	static $chave_primaria = 'id_evento';

	protected $campos = [ 'id_evento', 'sinopse', 'pais_origem' ];

	public static function init() {
		Show::$dao = new SuperDAO('Show');
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

	private function atualizar( $id, $valores) {
		return Show::$dao->atualizar( $this->campos, $valores, $id );
	}

	private function inserir($valores) {
		
		$id = Show::$dao->inserir( $this->campos, $valores);

		if ($id == -1)
			return -1;

		$this->id = $id;

		return 0;
	}

	public function save() {

		$valores = $this->pegaValores();

		if( isset($this->id) ) 
			return $this->atualizar($this->id, $valores);
		
		return $this->inserir($valores);

	}

	private function pegaValores() {
		
		$valores = array();

		foreach ($this->campos as $campo)
			array_push($valores, $this->{$campo});

		return $valores;
	}

	public function evento() {
		return Show::$dao->pertenceA('Evento', 'id_local', $this->id_evento);
	}

}