<?php
class RelatoriosController
{
	public function __construct()
	{
		require_once('models/relatorios.php');
	}

	public function index()
	{
		$paginacao = Paginacao::getInstance();
		if (isset($_GET) && !empty($_GET)) {
			$clientes = $paginacao->paginacao(20, array('Relatorios', 'listaTodosTotalClientes', $_GET), array('Relatorios', 'listaTodosPaginacaoClientes', $_GET));
		} else {
			$clientes = $paginacao->paginacao(20, array('Relatorios', 'listaTodosTotalClientes'), array('Relatorios', 'listaTodosPaginacaoClientes'));
		}

		$paginacao = Paginacao::getInstance();
		$bairros = Relatorios::listaTodosPaginacaoBairros();
		require_once('views/relatorios/index.php');
	}
}
