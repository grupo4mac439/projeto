<?php namespace lib\DAO;

use DB;

class PecaDAO extends SuperDAO {

	protected $modelo = 'Peca';

	protected $tabela = 'peca';

	protected $chave_primaria = 'id_evento';

	protected $campos = [ 'id_evento', 'sinopse', 'pais_origem' ];

	public function evento($id_peca) {
		return $this->pertenceA('Evento', 'evento', 'id', 'id_evento', $id_peca);
	}
}