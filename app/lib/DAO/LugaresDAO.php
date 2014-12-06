<?php namespace lib\DAO;

use DB;

class LugaresDAO extends SuperDAO {

	protected $modelo = 'Lugares';

	protected $tabela = 'lugares';

	protected $chave_primaria = 'id';

	protected $campos = [ 'id_setor', 'status' ];

	public function atualizarLugares($lugar) {
		
		$valores = $this->pegaValores($lugar);	
		
		return $this->atualizar($this->campos, $valores, $lugar->id);
	}

	public function ingresso($lugar_id) {
		return $this->temUm('Ingresso', 'ingresso', 'id_lugar', $lugar_id);
	}

	public function reserva($lugar_id) {
		return $this->temUm('Reserva', 'reserva', 'id_lugar', $lugar_id);
	}

	public function setor($lugar_id) {
		return $this->pertenceA('Setor', 'setor', 'id', 'id_setor', $lugar_id);
	}

	public function reservar($cliente, $instancia_evento, $id_lugar) {
		$query = 'insert into reserva (id_cliente, id_lugar, data_ini, data_fim) values (?, ?, ?, ?)';
		$data_ini = date('Y-m-d');
		$data_fim = $instancia_evento->data;
		$valores = [$cliente->id, $id_lugar, $data_ini, $data_fim];

		DB::insert($query, $valores);

		return 0;	
	}

}
