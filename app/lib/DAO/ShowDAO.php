<?php namespace lib\DAO;

use DB;

class ShowDAO extends SuperDAO {

	protected $modelo = 'Show';

	protected $tabela = 'show';

	protected $chave_primaria = 'id_evento';

	protected $campos = [ 'id_evento', 'descricao', 'pais_origem' ];

	public function evento($id_show) {
		return $this->pertenceA('Evento', 'evento', 'id', 'id_evento', $id_show);
	}
}