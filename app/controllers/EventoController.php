<?php

class EventoController extends BaseController {

	public function home() {
		$eventos_filmes = Evento::seleciona3Eventos('f');
		$eventos_pecas = Evento::seleciona3Eventos('p');
		$eventos_shows = Evento::seleciona3Eventos('s');
		
		return View::make('home')
			->with( array('filmes' => $eventos_filmes, 'pecas' => $eventos_pecas, 'shows' => $eventos_shows) );
	}

	public function pesquisa() {

		$expressao = Input::get('pesquisa');

		return dd( Evento::pesquisa( $expressao ));
	}
}