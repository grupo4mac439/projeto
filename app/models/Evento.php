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

	public static function encontrarPorCampos( $campos, $valores, $aleatorio = null, $limite = null, $eou = 'and') {
		return Evento::$dao->encontrarPorCampos( $campos, $valores, $aleatorio, $limite, $eou);
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

	public static function pesquisa( $expressao ) {

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

			$eventos_encontrados = Evento::encontrarPorCampos($campos, $valores, null, null, 'or');

			if (!isset($total_eventos))
				$total_eventos = $eventos_encontrados;
			else
				$total_eventos = array_merge($total_eventos, $eventos_encontrados);
		}

		return Evento::retiraReplicados($total_eventos);
	}

	private static function retiraReplicados( $eventos ) {
		$existentes = array();
		$eventos_unicos = array();

		foreach ($eventos as $evento) {
			if ( in_array($evento->id, $existentes))
				continue;
			array_push($existentes, $evento->id);
			array_push($eventos_unicos, $evento);
		}
		return $eventos_unicos;
	}

	public static function seleciona3Eventos( $tipo ) {
		return Evento::$dao->seleciona3Eventos( $tipo );
	}

}
