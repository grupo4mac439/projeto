<?php

use lib\DAO\SuperDAO;

class Filme {

	private static $dao;

	static $tabela = 'Filme';

	static $chave_primaria = 'id_evento';

	protected $campos = [ 'id_evento', 'sinopse', 'pais_origem' ];

	public static function init() {
		Filme::$dao = new SuperDAO('Filme');
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

	private function atualizar( $id, $valores) {
		return Filme::$dao->atualizar( $this->campos, $valores, $id );
	}

	private function inserir($valores) {
		
		$id = Filme::$dao->inserir( $this->campos, $valores);

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
		return Filme::$dao->pertenceA('Evento', 'id_local', $this->id_evento);
	}

}