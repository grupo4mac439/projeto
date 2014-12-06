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

	public function lugares_disponiveis($setor_id) {
		$resultado = DB::select('select count(*) as total from lugares where status = ? and id_setor = ?', 
			array('livre', $setor_id));

		return array_shift($resultado)->total;
	}

	public function lugares_livres($setor_id, $qtde) {
		$resultado = DB::select('select * from lugares where status = ? and id_setor = ? order by id limit ?', 
			array('livre', $setor_id, $qtde));

		return CastModels::castModels('Lugares', $resultado);
	}
}