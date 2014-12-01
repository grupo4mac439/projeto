<?php

use lib\DAO\SuperDAO;

class Local {

	private static $dao;

	static $tabela = 'Local';

	protected $campos = [ 'nome', 'endereco', 'capacidade', 'tipo' ];

	public static function init() {
		Local::$dao = new SuperDAO('Local');
	}

	public static function todos () {
		return Local::$dao->todos( Local::$tabela );
	}

	public static function encontrar ( $id ) {
		return Local::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return Local::$dao->encontrarPorCampos( $campos, $valores);
	}

	private function atualizar( $id, $valores) {
		Local::$dao->atualizar( $this->campos, $valores, $id );
		
		return 0;
	}

	private function inserir($valores) {
		
		$posicao = array_search('nome', $this->campos);
		$nome = $valores[ $posicao ];
		$resultados = Local::encontrarPorCampos( array('nome'), array($nome) );
		
		if (!empty($resultados))
			return -1;

		Local::$dao->inserir( $this->campos, $valores);
		
		$resultados = Local::findByFields( array('nome'), array($nome) );
		
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

	public function instanciaLocal() {
		return Local::$dao->temMuitos('Instancia_Evento', 'id_local', $this->id);
	}

}
