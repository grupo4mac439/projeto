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
		Evento::$dao->atualizar( $this->campos, $valores, $id );
		
		return 0;
	}

	private function inserir($valores) {
		
		$posicao = array_search('nome', $this->campos);
		$nome = $valores[ $posicao ];
		$resultados = Evento::encontrarPorCampos( array('nome'), array($nome) );
		
		if (!empty($resultados))
			return -1;

		Evento::$dao->inserir( $this->campos, $valores);
		
		$resultados = Evento::findByFields( array('nome'), array($nome) );
		
		$resultado = array_shift($resultados);

		$this->id = $resultado->id;
		
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
