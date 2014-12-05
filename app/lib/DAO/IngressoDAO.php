<?php namespace lib\DAO;

use DB;

class IngressoDAO extends SuperDAO {

	protected $modelo = 'Ingresso';

	protected $tabela = 'ingresso';

	protected $chave_primaria = 'id';

	protected $campos = [ 'id_lugar' ];

	public function inserirIngresso($ingresso) {

		$valores = $this->pegaValores($ingresso);
	
		$id = $this->inserir($this->campos, $valores);

		if ($id == -1)
			return -1;
		
		$ingresso->id = $id;

		return 0;
	}

	public function atualizarIngresso($ingresso) {
		
		$valores = $this->pegaValores($ingresso);	
		
		return $this->atualizar($this->campos, $valores, $ingresso->id);
	}

	public function lugar($ingresso_id) {
		return $this->pertenceA('Lugares', 'lugares', 'id', 'id_lugar', $ingresso_id);
	}

}