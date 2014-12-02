<?php

use lib\DAO\SuperDAO;

class Evento {

	private static $dao;

	static $tabela = 'Evento';

	static $chave_primaria = 'id';

	protected $campos = [ 'nome', 'genero', 'classificacao', 'tipo', 'foto' ];

	public static function init() {
		Evento::$dao = new SuperDAO('Evento');
	}

	public static function todos ( $aleatorio = null ) {
		return Evento::$dao->todos( $aleatorio );
	}

	public static function encontrar ( $id ) {
		return Evento::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores, $aleatorio = null, $limite = null ) {
		return Evento::$dao->encontrarPorCampos( $campos, $valores, $aleatorio, $limite);
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

	public function filme() {
		return Evento::$dao->temUm('Filme', 'id_evento', $this->id);
	}

	public function show() {
		return Evento::$dao->temUm('Show', 'id_evento', $this->id);
	}

	public function peca() {
		return Evento::$dao->temUm('Peca', 'id_evento', $this->id);
	}

}
