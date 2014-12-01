<?php

use lib\DAO\SuperDAO;

class Setores {

	private static $dao;

	static $tabela = 'Setores';

	protected $campos = [ 'nome', 'cota_meia', 'preco', 'id_inst_evento' ];

	public static function init() {
		Setores::$dao = new SuperDAO('Setores');
	}

	public static function todos () {
		return Setores::$dao->todos( Setores::$tabela );
	}

	public static function encontrar ( $id ) {
		return Setores::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return Setores::$dao->encontrarPorCampos( $campos, $valores);
	}

	private function atualizar( $id, $valores) {
		Setores::$dao->atualizar( $this->campos, $valores, $id );
		
		return 0;
	}

	private function inserir($valores) {
		
		$posicao = array_search('nome', $this->campos);
		$nome = $valores[ $posicao ];
		$resultados = Setores::encontrarPorCampos( array('nome'), array($nome) );
		
		if (!empty($resultados))
			return -1;

		Setores::$dao->inserir( $this->campos, $valores);
		
		$resultados = Setores::findByFields( array('nome'), array($nome) );
		
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

	public function lugares() {
		return Setores::$dao->temMuitos('Lugares', 'id_setor', $this->id);
	}

	public function instanciaEvento() {
		return Setores::$dao->pertenceA('Instancia_Evento', 'id_inst_evento', $this->id);
	}

}
