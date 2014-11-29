<?php namespace lib\DAO;

use DB;

class SuperDAO {

	private $model;

	private $table;

	public function __construct($model) {
		$this->model = $model;
	}

	public function findById( $id ) {
		
		$model = $this->model;

		$table = $model::$table;
		
		$results =  DB::select('select * from ' . $table . ' where id = ?', array($id));
		
		$result = array_shift($results);
		
		if ($result == NULL)
			return NULL;

		return CastModels::castModel($model, $result);
	}

	public function all() {
		
		$model = $this->model;

		$table = $model::$table;

		$results = DB::select('select * from ' . $table);
		
		return CastModels::castModels($model, $results);
	}

	public function findByFields($fields, $values) {
		
		$model = $this->model;

		$table = $model::$table;

		$statement = 'select * from ' . $table . ' where';
				
		$this->getFieldOperator($fields, $field, $operator);

		$statement .= ' ' . $field . ' ' . $operator .' ?';
		
		while ( current( $fields ) ) {

			$this->getFieldOperator ( $fields, $field, $operator );

			$statement .= ' and ' . $field . ' ' . $operator .' ?';
		}
		
		$results = DB::select ( $statement, $values );	
		
		return CastModels::castModels($model, $results);
	}

	private function getFieldOperator(&$fields, &$field, &$operator) {
		
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

	public function update($fields, $values, $id) {
		
		$model = $this->model;

		$table = $model::$table;
		
		$statement = 'update '. $table . ' set ';
		
		$field = current( $fields );
		
		next( $fields );
		
		$statement .=  $field . ' = ? ';
		
		while( $field =  current( $fields ) ) {
		
			$statement .= ', ' . $field . ' = ? ';
		
			next( $fields );
		}
		
		$statement .= 'where id = ?';
		
		array_push($values, $id);
		
		DB::update($statement, $values);
	}

	public function insert($fields, $values) {
	
		$model = $this->model;

		$table = $model::$table;

		$statement = 'insert into ' . $table . ' ( ';
		
		$statement .= current( $fields );
		
		$values_itens = '?';
		
		next( $fields );
		
		while ( $field = current( $fields ) )  {
		
			$statement .= ' , ' . $field;
		
			$values_itens .= ' , ?';
		
			next( $fields );
		}
		
		$statement .= ' ) values ( ' . $values_itens . ' )';
	 	
	 	DB::insert($statement, $values);
	
	}
}