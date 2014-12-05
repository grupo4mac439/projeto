<?php namespace lib\DAO;

use DB;

class SetoresDAO extends SuperDAO {

	protected $modelo = 'Setores';

	protected $tabela = 'setores';

	protected $chave_primaria = 'id';

	protected $campos = [ 'nome', 'cota_meia', 'preco', 'id_inst_evento' ];

	public function lugares($setor_id) {
		return $this->temMuitos('Lugares', 'lugares', 'id_setor', $setor_id);
	}

	public function instancia_evento($setor_id) {
		return $this->pertenceA('InstanciaEvento', 'instancia_evento', 'id', 'id_inst_evento', $setor_id);
	}

}