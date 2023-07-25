<?php
class BairrosController
{
	public function __construct()
	{
		require_once('models/bairros.php');
	}

	public function index()
	{
		$paginacao = Paginacao::getInstance();
		if (isset($_GET) && !empty($_GET)) {
			$bairros = $paginacao->paginacao(20, array('Bairros', 'listaTodosTotal', $_GET), array('Bairros', 'listaTodosPaginacao', $_GET));
		} else {
			$bairros = $paginacao->paginacao(20, array('Bairros', 'listaTodosTotal'), array('Bairros', 'listaTodosPaginacao'));
		}
		require_once('views/bairros/index.php');
	}
}
