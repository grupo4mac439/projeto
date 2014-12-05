<?php namespace lib\DAO;

use DB;

class LocalDAO extends SuperDAO {

	protected $modelo = 'Local';

	protected $tabela = 'local';

	protected $chave_primaria = 'id';

	protected $campos = [ 'nome', 'endereco', 'capacidade', 'tipo' ];

	public function instancia_evento( $local_id ) {
		return $this->temMuitos('InstanciaEvento', 'instancia_evento', 'id_local', $local_id);
	}

}