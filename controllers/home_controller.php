<?php
class HomeController
{
	public function __construct()
	{
		require_once('models/clientes.php');
	}

	public function index()
	{
		$paginacao = Paginacao::getInstance();
		if (isset($_GET) && !empty($_GET)) {
			$clientes = $paginacao->paginacao(20, array('Clientes', 'listaTodosTotal', $_GET), array('Clientes', 'listaTodosPaginacao', $_GET));
		} else {
			$clientes = $paginacao->paginacao(20, array('Clientes', 'listaTodosTotal'), array('Clientes', 'listaTodosPaginacao'));
		}

		require_once('views/clientes/index.php');
	}

	public function error()
	{
		require_once('views/error.php');
	}
}
