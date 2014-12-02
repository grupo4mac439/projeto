<?php namespace lib\DAO;

use DB;

class SuperDAO {

	private $modelo;

	private $tabela;

	public function __construct($modelo) {
		$this->modelo = $modelo;
	}

	public function encontrarPorId( $id ) {
		
		$modelo = $this->modelo;

		$tabela = $modelo::$tabela;

		$chave_primaria = $modelo::$chave_primaria;

		try {
			$resultados =  DB::select('select * from ' . $tabela . ' where ' . $chave_primaria . ' = ?', array($id));
		}
		catch (\Illuminate\Database\QueryException $e) {
			return -1; //operação falhou
		}

		$resultado = array_shift($resultados);
		
		if ($resultado == NULL)
			return NULL;

		return CastModels::castModel($modelo, $resultado);
	}

	public function todos( $aleatorio = null ) {
		
		$modelo = $this->modelo;

		$tabela = $modelo::$tabela;

		$query = 'select * from ' . $tabela;

		if ( isset($aleatorio) )
			$query .= ' order by random()';

		try {
			$resultados = DB::select($query);
		}
		catch (\Illuminate\Database\QueryException $e) {
			return -1; //operação falhou
		}
		
		return CastModels::castModels($modelo, $resultados);
	}

	public function encontrarPorCampos($campos, $valores, $aleatorio = null, $limite = null) {
		
		$modelo = $this->modelo;

		$tabela = $modelo::$tabela;

		$query = 'select * from ' . $tabela . ' where';
				
		$this->pegaCampoOperador($campos, $campo, $operador);

		$query .= ' ' . $campo . ' ' . $operador .' ?';
		
		while ( current( $campos ) ) {

			$this->pegaCampoOperador ( $campos, $campo, $operador );

			$query .= ' and ' . $campo . ' ' . $operador .' ?';
		}

		if ( isset($aleatorio) )
			$query .= ' order by random()';

		if ( isset($limite) )
			$query .= ' limit ' . $limite;

		try {
			$resultados = DB::select ( $query, $valores );	
		}
		catch (\Illuminate\Database\QueryException $e) {
			return -1; //operação falhou
		}
		
		return CastModels::castModels($modelo, $resultados);
	}

	private function pegaCampoOperador(&$campos, &$campo, &$operador) {
		
		if ( is_int ( key ( $campos ) ) ) //não é indexado por chave
		{
			$campo = current ( $campos ); //o campo é o valor do array na posição atual
			$operador = '='; //atribuimos então o operador = como padrão 
		}
		else {
			$campo = key ( $campos );
			$operador = current ( $campos );
		}

		next($campos);
	}

	public function atualizar($campos, $valores, $id) {
		
		$modelo = $this->modelo;

		$tabela = $modelo::$tabela;

		$chave_primaria = $modelo::$chave_primaria;
		
		$query = 'update '. $tabela . ' set ';
		
		$campo = current( $campos );
		
		next( $campos );
		
		$query .=  $campo . ' = ? ';
		
		while( $campo =  current( $campos ) ) {
		
			$query .= ', ' . $campo . ' = ? ';
		
			next( $campos );
		}
		
		$query .= 'where ' . $chave_primaria . ' = ?';
		
		array_push($valores, $id);
		
		try {
			DB::update($query, $valores);
		}
		catch (\Illuminate\Database\QueryException $e) {
			return -1; //operação falhou
		}

		return 0;
	}

	public function inserir($campos, $valores) {
	
		$modelo = $this->modelo;

		$tabela = $modelo::$tabela;

		$chave_primaria = $modelo::$chave_primaria;

		$query = 'insert into ' . $tabela . ' ( ';
		
		$query .= current( $campos );
		
		$valores_itens = '?';
		
		next( $campos );
		
		while ( $campo = current( $campos ) )  {
		
			$query .= ' , ' . $campo;
		
			$valores_itens .= ' , ?';
		
			next( $campos );
		}
		
		$query .= ' ) values ( ' . $valores_itens . ' ) returning ' . $chave_primaria;
	 	
		try {
			$result = DB::select($query, $valores);
		}
		catch (\Illuminate\Database\QueryException $e) {
			return -1; //operação falhou
		}
		
		return array_shift($result)->id;
	}

	public function pertenceA( $modeloDono, $fk, $id ) {
		
		$modelo = $this->modelo;

		$tabela = $modelo::$tabela;		

		$chave_primaria = $modelo::$chave_primaria;

		$tabelaDono = $modeloDono::$tabela;

		$chave_primariaDono = $modeloDono::$chave_primaria;
		
		$query = 'select * from ' . $tabelaDono . ' where ' . $chave_primariaDono . 
					' in (select ' . $fk . ' from ' . $tabela . ' where ' . $chave_primaria . ' = ?)';
		
		try {
			$resultados = DB::select($query, array($id));
		}
		catch (\Illuminate\Database\QueryException $e) {
			return -1; //operação falhou
		}
		
		$resultado = array_shift($resultados);
		
		if ($resultado == NULL)
			return NULL;

		return CastModels::castModel($modeloDono, $resultado);		
	}

	public function temMuitos( $modeloObjeto, $fk, $id ) {

		$tabelaObjeto = $modeloObjeto::$tabela;
		
		$query = 'select * from ' . $tabelaObjeto . ' where ' . $fk . ' = ?';

		try {
			$resultados = DB::select($query, array($id));
		}
		catch (\Illuminate\Database\QueryException $e) {
			return -1; //operação falhou
		}
	
		return CastModels::castModels($modeloObjeto, $resultados);
	}

	public function temUm( $modeloObjeto, $fk, $id ) {

		$tabelaObjeto = $modeloObjeto::$tabela;
		
		$query = 'select * from ' . $tabelaObjeto . ' where ' . $fk . ' = ?';

		try {
			$resultados = DB::select($query, array($id));
		}
		catch (\Illuminate\Database\QueryException $e) {
			return -1; //operação falhou
		}
	
		$resultado = array_shift($resultados);
		
		if ($resultado == NULL)
			return NULL;

		return CastModels::castModel($modeloObjeto, $resultado);		
	}
}