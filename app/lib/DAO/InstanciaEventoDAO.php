<?php namespace lib\DAO;

use DB;

class InstanciaEventoDAO extends SuperDAO {

	protected $modelo = 'InstanciaEvento';

	protected $tabela = 'instancia_evento';

	protected $chave_primaria = 'id';

	protected $campos = [ 'data', 'hora', 'id_evento', 'id_local' ];

	public function evento($instancia_evento_id) {
		return $this->pertenceA('Evento', 'evento', 'id', 'id_evento', $instancia_evento_id);
	}

	public function setores($instancia_evento_id) {
		return $this->temMuitos('Setores', 'setores', 'id_inst_evento', $instancia_evento_id);
	}

	public function local($instancia_evento_id) {
		return $this->pertenceA('Local', 'local', 'id', 'id_local', $instancia_evento_id);
	}

}