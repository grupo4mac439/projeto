<?php namespace lib\DAO;

use DB;

class FilmeDAO extends SuperDAO {

	protected $modelo = 'Filme';

	protected $tabela = 'filme';

	protected $chave_primaria = 'id_evento';

	protected $campos = [ 'id_evento', 'sinopse', 'pais_origem' ];

	public function evento($id_filme) {
		return $this->pertenceA('Evento', 'evento', 'id', 'id_evento', $id_filme);
	}
}