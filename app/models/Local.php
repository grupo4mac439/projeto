<?php

use lib\DAO\SuperDAO;

class Local {

	private static $dao;

	static $tabela = 'Local';

	static $chave_primaria = 'id';

	protected $campos = [ 'nome', 'endereco', 'capacidade', 'tipo' ];

	public static function init() {
		Local::$dao = new SuperDAO('Local');
	}

	public static function todos () {
		return Local::$dao->todos();
	}

	public static function encontrar ( $id ) {
		return Local::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return Local::$dao->encontrarPorCampos( $campos, $valores);
	}

	private function atualizar( $id, $valores) {
		return Local::$dao->atualizar( $this->campos, $valores, $id );
	}

	private function inserir($valores) {
		
		$id = Local::$dao->inserir( $this->campos, $valores);

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

	public function instanciaLocal() {
		return Local::$dao->temMuitos('Instancia_Evento', 'id_local', $this->id);
	}

}
