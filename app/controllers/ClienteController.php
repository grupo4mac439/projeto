<?php

class ClienteController extends BaseController {

	public function cadastro() {
		$cliente = new Cliente();
		$cliente->nome = Input::get('nome');
		$cliente->email = Input::get('email');
		$cliente->cpf = Input::get('cpf');
		$cliente->endereco = Input::get('endereco');
		$cliente->senha = Hash::make(Input::get('senha'));
		$cliente->data_cadastro = date('Y-m-d');
		$resultado = $cliente->save();
		if ($resultado == 0) {
			Autenticador::entrar($cliente);
			return Redirect::to('/');
		}
		return -1;
	}
}