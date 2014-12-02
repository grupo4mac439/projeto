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
		return Lugares::$dao->atualizar( $this->campos, $valores, $id );
	}

	private function inserir($valores) {

		$id = Lugares::$dao->inserir( $this->campos, $valores);
		
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
