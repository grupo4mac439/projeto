<?php

class ReservaController extends BaseController {

	public function reservar($instancia_id, $setor_id) {
		$setor = Setores::encontrar($setor_id);
		$instancia = InstanciaEvento::encontrar($instancia_id);
		$qtde_lugares = Input::get('setor_' . $setor->id);
		$lugares = $setor->lugares_livres($qtde_lugares);
		
		foreach ($lugares as $lugar) {
			$reserva = $lugar->reservar(Autenticador::cliente(), $instancia);
			$lugar->status = 'reservado';
			$lugar->save();
		}
		
		return Redirect::to('instancia/' . $instancia_id);
	}
}