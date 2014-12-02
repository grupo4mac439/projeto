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
		return Setores::$dao->atualizar( $this->campos, $valores, $id );
	}

	private function inserir($valores) {
		
		$id = Setores::$dao->inserir( $this->campos, $valores);
		
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

	public function lugares() {
		return Setores::$dao->temMuitos('Lugares', 'id_setor', $this->id);
	}

	public function instanciaEvento() {
		return Setores::$dao->pertenceA('Instancia_Evento', 'id_inst_evento', $this->id);
	}

}
