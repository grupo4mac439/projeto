<?php

use lib\DAO\SuperDAO;

class Ingresso {

	private static $dao;

	static $tabela = 'Ingresso';

	protected $campos = [ 'id_lugar' ];

	public static function init() {
		Ingresso::$dao = new SuperDAO('Ingresso');
	}

	public static function todos () {
		return Ingresso::$dao->todos( Ingresso::$tabela );
	}

	public static function encontrar ( $id ) {
		return Ingresso::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return Ingresso::$dao->encontrarPorCampos( $campos, $valores);
	}

	private function atualizar( $id, $valores) {
		return Ingresso::$dao->atualizar( $this->campos, $valores, $id );
	}

	private function inserir($valores) {
		
		$id = Ingresso::$dao->inserir( $this->campos, $valores);
		
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

	public function lugar() {
		return Ingresso::$dao->pertenceA('Lugares', 'id_lugar', $this->id);
	}

}
