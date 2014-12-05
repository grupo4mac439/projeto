<?php namespace lib\DAO;

use DB;

class EventoDAO extends SuperDAO {

	protected $modelo = 'Evento';

	protected $tabela = 'evento';

	protected $campos = [ 'nome', 'genero', 'classificacao', 'tipo', 'foto' ];

	protected $chave_primaria = 'id';

	public function instancia_evento($evento_id) {
		return $this->temMuitos('InstanciaEvento', 'instancia_evento', 'id_evento', $evento_id);
	}

	public function filme($evento_id) {
		return $this->temUm('Filme', 'filme', 'id_evento', $evento_id);
	}

	public function show($evento_id) {
		return $this->temUm('Show', 'show', 'id_evento', $evento_id);
	}

	public function peca($evento_id) {
		return $this->temUm('Peca', 'peca', 'id_evento', $evento_id);
	}

	public function seleciona3Eventos( $tipo ) {

		$modelo = $this->modelo;

		$query = 'select distinct evento.id, nome, genero, classificacao, tipo, foto
		          from evento, instancia_evento
		          where tipo = ? and evento.id = id_evento and data > now()
		          limit 3';

		try {
			$resultados = DB::select ( $query, array($tipo) );
		}
		catch(\Illuminate\Database\QueryException $e) {
			return -1;  //operação falhou
		}

		return CastModels::castModels($modelo, $resultados);
	}

	public function pesquisaAvancada($campos_procurados) {
		
		$campos = array();
		$valores = array(); 

		foreach ($campos_procurados as $campo_procurado => $termo_procurado) {
			$termo_procurado = strtolower('%' . $termo_procurado . '%');
			$campos['lower(' . $campo_procurado . ')'] = 'like';	
			array_push($valores, $termo_procurado);
		}

		$eventos_encontrados = $this->encontrarPorCampos($campos, $valores, null, null, 'or');
		return $eventos_encontrados;
	}

	public function pesquisa($expressao) {

		$expressao = strtolower($expressao);

		$termos = explode(' ', $expressao);

		$campos = ['lower(nome)' => 'like', 'lower(genero)' => 'like', 
			'lower(classificacao)' => 'like', 'tipo' => '='];

		foreach($termos as $termo) 
		{
			$termo_parecido = '%' . $termo . '%';
			
			$tipo = '%%';

			if ( strpos($termo, 'filme') !== false)
				$tipo = 'f';

			if ( strpos($termo, 'peca') !== false)
				$tipo = 'peca';

			if ( strpos($termo, 'show') !== false)
				$tipo = 's';

			$valores = [$termo_parecido, $termo_parecido, $termo_parecido, $tipo];

			$eventos_encontrados = $this->encontrarPorCampos($campos, $valores, null, null, 'or');

			if (!isset($total_eventos))
				$total_eventos = $eventos_encontrados;
			else
				$total_eventos = array_merge($total_eventos, $eventos_encontrados);
		}

		return $total_eventos;
	}

}