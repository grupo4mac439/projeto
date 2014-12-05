<?php namespace lib\DAO;

use DB;

class ClienteDAO extends SuperDAO {

	protected $modelo = 'Cliente';

	protected $tabela = 'cliente';

	protected $chave_primaria = 'id';

	protected $campos = [ 'nome', 'email', 'cpf', 'endereco', 'senha', 'data_cadastro' ];

	public function compra($cliente_id) {
		return $this->temMuitos('Compra', 'compra', 'id_cliente', $cliente_id);
	}

	public function reserva() {
		return $this->temMuitos('Reserva', 'reserva', 'id_cliente', $cliente_id);
	}

	public function inserirCliente($cliente) {

		$valores = $this->pegaValores($cliente);
	
		$id =  $this->inserir($this->campos, $valores);

		if ($id == -1)
			return -1;
		
		$cliente->id = $id;

		return 0;
	}

	public function atualizarCliente($cliente) {
		
		$valores = $this->pegaValores($cliente);	
		
		return $this->atualizar($this->campos, $valores, $cliente->id);
	}

}