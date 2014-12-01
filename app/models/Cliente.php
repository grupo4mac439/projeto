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
		Cliente::$dao->atualizar( $this->campos, $valores, $id );
		
		return 0;
	}

	private function inserir($valores) {
		
		$posicao = array_search('email', $this->campos);
		$email = $valores[ $posicao ];
		$resultados = Cliente::encontrarPorCampos( array('email'), array($email) );
		
		if (!empty($resultados))
			return -1;

		Cliente::$dao->inserir( $this->campos, $valores);
		
		$resultados = Cliente::findByFields( array('email'), array($email) );
		
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

	public function compra() {
		return Cliente::$dao->temMuitos('Compra', 'id_cliente', $this->id);
	}

	public function reserva() {
		return Cliente::$dao->temMuitos('Reserva', 'id_cliente', $this->id);
	}
}
