<?php

use lib\DAO\SuperDAO;

class Cliente {

	private static $dao;

	static $tabela = 'Cliente';

	protected $campos = [ 'cpf', 'email', 'nome', 'endereco', 'senha', 'data_cadastro' ];

	public static function init() {
		Cliente::$dao = new SuperDAO('Cliente');
	}

	public static function todos () {
		return Cliente::$dao->todos( Cliente::$tabela );
	}

	public static function encontrar ( $id ) {
		return Cliente::$dao->encontrarPorId ( $id );
	}

	public static function encontrarPorCampos( $campos, $valores) {
		return Cliente::$dao->encontrarPorCampos( $campos, $valores);
	}

	private function atualizar( $id, $valores) {
		return Cliente::$dao->atualizar( $this->campos, $valores, $id );
	}

	private function inserir($valores) {
		
		$posicao = array_search('email', $this->campos);
		
		$email = $valores[ $posicao ];
		
		$resultados = Cliente::encontrarPorCampos( array('email'), array($email) );
		
		if ($resultados == -1 || !empty($resultados))
			return -1;

		$id = Cliente::$dao->inserir( $this->campos, $valores);
		
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

	public function compra() {
		return Cliente::$dao->temMuitos('Compra', 'id_cliente', $this->id);
	}

	public function reserva() {
		return Cliente::$dao->temMuitos('Reserva', 'id_cliente', $this->id);
	}
}
