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
		InstanciaEvento::$dao->atualizar( $this->campos, $valores, $id );
		
		return 0;
	}

	private function inserir($valores) {
		
		$posicao = array_search('id_evento', $this->campos);
		$evento = $valores[ $posicao ];
		$posicao = array_search('id_local', $this->campos);
		$local = $valores[ $posicao ];
		$resultados = InstanciaEvento::encontrarPorCampos( array('id_evento', 'id_local'), array($evento, $local) );
		
		if (!empty($resultados))
			return -1;

		InstanciaEvento::$dao->inserir( $this->campos, $valores);
		
		$resultados = InstanciaEvento::findByFields( array('id_evento','id_local'), array($nome) );
		
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

	public function evento() {
		return InstanciaEvento::$dao->pertenceA('Evento', 'id_evento', $this->id);
	}

	public function setor() {
		return InstanciaEvento::$dao->temMuitos('Setores', 'id_inst_evento', $this->id);
	}


}
