<?php

use lib\DAO\SuperDAO;

class Evento {

	private static $dao;

	static $tabela = 'Evento';

	protected $campos = [ 'nome', 'genero', 'classificacao', 'tipo', 'foto' ];

	public static function init() {
		Evento::$dao = new SuperDAO('Evento');
	}

	public static function todos () {
		return Evento::$dao->todos( Evento::$tabela );
	}

	public static function encontrar ( $id ) {
		return Evento::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return Evento::$dao->encontrarPorCampos( $campos, $valores);
	}

	private function atualizar( $id, $valores) {
		return Evento::$dao->atualizar( $this->campos, $valores, $id );
	}

	private function inserir($valores) {
		
		$id = Evento::$dao->inserir( $this->campos, $valores);
		
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

	public function instanciaEvento() {
		return Evento::$dao->temMuitos('Instancia_Evento', 'id_evento', $this->id);
	}

}
