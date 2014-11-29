<?php

use lib\DAO\SuperDAO;

class Cliente {

	private static $dao;

	static $table = 'users';

	protected $campos = [ 'username', 'email' ];

	public static function init() {
		Cliente::$dao = new SuperDAO('Cliente');
	}

	public static function all () {
		return Cliente::$dao->all( Cliente::$table );
	}

	public static function find ( $id ) {
		
		$result = Cliente::$dao->findById ( $id );
		return $result;
	}

	public static function findByFields( $fields, $values) {
		return Cliente::$dao->findByFields( $fields, $values);
	}

	private function update( $id, $values) {
		Cliente::$dao->update( $this->campos, $values, $id );
		
		return 0;
	}

	private function insert($values) {
		
		$posicao = array_search('email', $this->campos);
		$email = $values[ $posicao ];
		$results = Cliente::findByFields( array('email'), array($email) );
		
		if (!empty($results))
			return -1;

		Cliente::$dao->insert( $this->campos, $values);
		
		$results = Cliente::findByFields( array('email'), array($email) );
		
		$result = array_shift($results);

		$this->id = $result->id;
		
		return 0;
	}

	public function save() {

		$values = $this->getValues();

		if( isset($this->id) ) 
			return $this->update($this->id, $values);
		
		return $this->insert($values);

	}

	private function getValues() {
		
		$values = array();

		foreach ($this->campos as $campo)
			array_push($values, $this->{$campo});

		return $values;
	}

}
