<?php

class EventoController extends BaseController {

	public function home() {
		$eventos_filmes = Evento::encontrarPorCampos(['tipo' => '='], ['f'], 1, 3);
		$eventos_pecas = Evento::encontrarPorCampos(['tipo' => '='], ['p'], 1, 3);
		$eventos_shows = Evento::encontrarPorCampos(['tipo' => '='], ['s'], 1, 3);
		
		return View::make('home')
			->with( array('filmes' => $eventos_filmes, 'pecas' => $eventos_pecas, 'shows' => $eventos_shows) );
	}
}