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

		$eventos = Evento::retiraReplicados(Evento::pesquisa( $expressao ));

		return View::make('pesquisa')->with('eventos', $eventos);
	}

	public function pesquisaAvancada() {

		$procurados = array();

		if (Input::get('nome-cb') == 1)
			$procurados['nome'] = Input::get('nome');
		if (Input::get('genero-cb') == 1)
			$procurados['genero'] = Input::get('genero');
		if (Input::get('classificacao-cb') == 1)
			$procurados['classificacao'] = Input::get('classificacao');
		if ( strcmp(Input::get('tipo'), 't') )
			$procurados['tipo'] = Input::get('tipo');

		$eventos = Evento::pesquisaAvancada($procurados);
		return View::make('avancado')->with('eventos', $eventos);
	}

	public function exibir( $id ) {
		
		$evento = Evento::encontrar( $id );

		return View::make('evento')->with('evento', $evento);		
	}
}