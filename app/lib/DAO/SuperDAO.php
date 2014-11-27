<?php namespace lib\DAO;

use DB;

class SuperDAO {

	public static function findById( $table, $id ) {
		$result =  DB::select('select * from ' . $table . ' where id = ?', array($id));
		return array_shift($result);
	}

	public static function all( $table ) {
		return DB::select('select * from ' . $table);
	}

	public static function findByFields($table, $fields, $values) {

		$statement = 'select * from ' . $table . ' where';
				
		SuperDAO::getFieldOperator($fields, $field, $operator);

		$statement .= ' ' . $field . ' ' . $operator .' ?';
		
		while ( current( $fields ) ) {

			SuperDAO::getFieldOperator ( $fields, $field, $operator );

			$statement .= ' and ' . $field . ' ' . $operator .' ?';
		}
		
		return DB::select ( $statement, $values );
		
	}

	private static function getFieldOperator(&$fields, &$field, &$operator) {
		
		if ( is_int ( key ( $fields ) ) ) //não é indexado por chave
		{
			$field = current ( $fields ); //o campo é o valor do array na posição atual
			$operator = '='; //atribuimos então o operador = como padrão 
		}
		else {
			$field = key ( $fields );
			$operator = current ( $fields );
		}

		next($fields);
	}
}