<?php 

class InstanciaEventoController extends BaseController {
	
	public function mostrar($id) {
		$instancia = InstanciaEvento::encontrar($id);
		$evento = $instancia->evento();
		$local = $instancia->local();
		$setores = $instancia->setores();
		return View::make('instancia')
			->with(array(
				'instancia' => $instancia, 
				'evento' => $evento, 
				'local' => $local,
				'setores' => $setores
			));
	}
}