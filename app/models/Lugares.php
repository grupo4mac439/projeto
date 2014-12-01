<?php

use lib\DAO\SuperDAO;

class Lugares {

	private static $dao;

	static $tabela = 'Lugares';

	protected $campos = [ 'id_setor', 'status' ];

	public static function init() {
		Lugares::$dao = new SuperDAO('Lugares');
	}

	public static function todos () {
		return Lugares::$dao->todos( Lugares::$tabela );
	}

	public static function encontrar ( $id ) {
		return Lugares::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return Lugares::$dao->encontrarPorCampos( $campos, $valores);
	}

	private function atualizar( $id, $valores) {
		Lugares::$dao->atualizar( $this->campos, $valores, $id );
		
		return 0;
	}

	private function inserir($valores) {

		Lugares::$dao->inserir( $this->campos, $valores);
		
		$resultados = Lugares::findByFields( array('nome'), array($nome) );
		
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

	public function ingresso() {
		return Lugares::$dao->temUm('Ingresso', 'id_lugar', $this->id);
	}

	public function reserva() {
		return Lugares::$dao->pertenceA('Reserva', 'id_lugar', $this->id);
	}

    public function compra() {
		return Lugares::$dao->pertenceA('Compra', 'id_lugar', $this->id);
	}
}
