<?php
class ClientesController
{
	public function __construct()
	{
		require_once('models/clientes.php');
	}

	public function new()
	{
		require_once('views/clientes/new.php');
	}

	public function create($dados)
	{
		if (isset($dados) && (!empty($dados))) {
			$inserir = Clientes::inserir($dados);
			if ($inserir['inserir']) {
				echo '<script>alert("Os dados deste cliente foram inseridos com sucesso!")</script>';
			} elseif ($inserir['cliente_ja_inserido']) {
				echo '<script>alert("Os dados deste cliente já estão cadastrados em nosso banco de dados.")</script>';
			} else {
				echo '<script>alert("Não foi possivel inserir os dados deste cliente.")</script>';
			}
		} else {
			echo "<script>alert('Não foi possível identificar a ação desginada, por favor, tente novamente!.');</script>";
		}
		echo "<script>location.href='/" . pastaBase . "/'</script>";
	}


	public function edit($id)
	{
		$cliente = Clientes::listarID($id);

		if ($cliente == NULL) {
			echo '<script>alert("Não foi possível localizar os dados deste cliente!")</script>';
			echo '<script>window.location.href="/' . pastaBase . '/"</script>';
		} else {
			require_once('views/clientes/edit.php');
		}
	}

	public function update($id, $request)
	{
		if (isset($request) && isset($id) && count($request) > 0) {
			$editar = Clientes::editar($request, $id);
			if ($editar['atualizar']) {
				echo "<script>alert('Os dados deste cliente foram atualizados com sucesso!.');</script>";
			} else {
				echo "<script>alert('Não foi possível atualizar os dados  deste cliente!.');</script>";
			}
		} else {
			echo "<script>alert('Não foi possível identificar a ação desginada, por favor, tente novamente!.');</script>";
		}
		echo "<script>location.href='/" . pastaBase . "/'</script>";
	}

	public function delete($id)
	{
		if (isset($id) && !empty($id)) {
			$excluir = Clientes::delete($id);
			if ($excluir['excluir']) {
				echo "<script>alert('Os dados deste cliente foram excluídos com sucesso!.');</script>";
			} else {
				echo "<script>alert('Não foi possível excluir os dados deste cliente!.');</script>";
			}
		} else {
			echo "<script>alert('Não foi possível identificar a ação desginada, por favor, tente novamente!.');</script>";
		}
		echo "<script>location.href='/" . pastaBase . "/'</script>";
	}
}
