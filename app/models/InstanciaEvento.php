<?php

use lib\DAO\SuperDAO;

class InstanciaEvento {

	private static $dao;

	static $tabela = 'InstanciaEvento';

	protected $campos = [ 'data', 'hora', 'id_evento', 'id_local' ];

	public static function init() {
		InstanciaEvento::$dao = new SuperDAO('InstanciaEvento');
	}

	public static function todos () {
		return InstanciaEvento::$dao->todos( InstanciaEvento::$tabela );
	}

	public static function encontrar ( $id ) {
		return InstanciaEvento::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return InstanciaEvento::$dao->encontrarPorCampos( $campos, $valores);
	}

	private function atualizar( $id, $valores) {
		return InstanciaEvento::$dao->atualizar( $this->campos, $valores, $id );
	}

	private function inserir($valores) {
	
		$id = InstanciaEvento::$dao->inserir( $this->campos, $valores);
		
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
		return InstanciaEvento::$dao->pertenceA('Evento', 'id_evento', $this->id);
	}

	public function setor() {
		return InstanciaEvento::$dao->temMuitos('Setores', 'id_inst_evento', $this->id);
	}


}
