<?php

class Clientes
{
	public static function listaTodosPaginacao($totalRegistros, $paginaAtual, $filtros = null)
	{
		if (!empty($totalRegistros)) {
			$limit = ' LIMIT ' . $totalRegistros;
		} else {
			$limit = '';
		}

		if (!empty($paginaAtual)) {
			$offset = ' OFFSET ' . $paginaAtual;
		} else {
			$offset = '';
		}

		$string = '';


		if (isset($filtros['CLIENTE_NOME']) && !empty($filtros['CLIENTE_NOME'])) {
			$string .= ' AND clt.CLIENTE_NOME LIKE :CLIENTE_NOME';
		}

		$req = Db::getInstance()->prepare("SELECT
							clt.CLIENTE_ID,
							clt.CLIENTE_NOME,
							clt.CLIENTE_CPF,
							clt.CLIENTE_CEP,
							clt.CLIENTE_ENDERECO,
							clt.CLIENTE_NUMERO,
							clt.CLIENTE_BAIRRO,
							clt.CLIENTE_CIDADE,
							clt.CLIENTE_ESTADO,
							clt.CLIENTE_ATIVO,
							clt.CLIENTE_CADASTRADO_EM,
							clt.CLIENTE_EDITADO_EM
						FROM 
						  `clientes` AS clt
						WHERE 
							(clt.CLIENTE_ID >= 1)
						    $string
						ORDER BY
							clt.CLIENTE_ID ASC
						    $limit $offset
						");

		if (isset($filtros['CLIENTE_NOME']) && !empty($filtros['CLIENTE_NOME'])) {
			$req->bindValue(':CLIENTE_NOME', $filtros['CLIENTE_NOME'], PDO::PARAM_STR);
		}

		$req->execute();
		$resultado = $req->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}

	public static function listaTodosTotal($filtros = null)
	{
		$string = '';

		if (isset($filtros['CLIENTE_NOME']) && !empty($filtros['CLIENTE_NOME'])) {
			$string .= ' AND clt.CLIENTE_NOME LIKE :CLIENTE_NOME';
		}

		$req = Db::getInstance()->prepare("SELECT
							count(clt.CLIENTE_ID)
						  FROM 
						  `clientes` AS clt
						  WHERE
						  clt.CLIENTE_ID != 0
							$string
						  ");

		if (isset($filtros['CLIENTE_NOME']) && !empty($filtros['CLIENTE_NOME'])) {
			$req->bindValue(':CLIENTE_NOME', $filtros['CLIENTE_NOME'], PDO::PARAM_STR);
		}

		$req->execute();
		$resultado = $req->fetchAll(PDO::FETCH_NUM);
		return $resultado;
	}



	public static function listarID($id)
	{

		$req = Db::getInstance()->prepare("SELECT
							clt.CLIENTE_ID,
							clt.CLIENTE_NOME,
							clt.CLIENTE_CPF,
							clt.CLIENTE_CEP,
							clt.CLIENTE_ENDERECO,
							clt.CLIENTE_NUMERO,
							clt.CLIENTE_BAIRRO,
							clt.CLIENTE_CIDADE,
							clt.CLIENTE_ESTADO,
							clt.CLIENTE_ATIVO,
							clt.CLIENTE_CADASTRADO_EM,
							clt.CLIENTE_EDITADO_EM
						  FROM 
							`clientes` AS clt
						  WHERE 
							clt.CLIENTE_ID = :id
						  ");

		$req->bindValue(':id',  $id, PDO::PARAM_INT);
		$req->execute();
		$resultado = $req->fetchAll(PDO::FETCH_ASSOC);
		return reset($resultado);
	}



	// ------------------------------------------------------------ CRUD -----------------------------------------------------

	//CREATE 
	public static function inserir($dados)
	{
		$resultado = NULL;
		try {
			$db = Db::getInstance();
			$stt = $db->prepare("SELECT clt.CLIENTE_CPF
				FROM `clientes` AS clt
				WHERE CLIENTE_CPF = :CLIENTE_CPF");
			$stt->bindValue(':CLIENTE_CPF', preg_replace('/[^0-9]/', '', $dados['CLIENTE_CPF']), PDO::PARAM_INT);
			$stt->execute();
			$resultado['check'] = $stt->fetchAll(PDO::FETCH_NUM);
			if (sizeof($resultado['check']) <= 0) {
				$db = Db::getInstance();
				$stt = $db->prepare('INSERT INTO `clientes`
				(
				`CLIENTE_NOME`,
				`CLIENTE_CPF`,
				`CLIENTE_CEP`,
				`CLIENTE_ENDERECO`,
				`CLIENTE_NUMERO`,
				`CLIENTE_BAIRRO`,
				`CLIENTE_CIDADE`,
				`CLIENTE_ESTADO`
				)
				VALUES
				(
				:CLIENTE_NOME,
				:CLIENTE_CPF,
				:CLIENTE_CEP,
				:CLIENTE_ENDERECO,
				:CLIENTE_NUMERO,
				:CLIENTE_BAIRRO,
				:CLIENTE_CIDADE,
				:CLIENTE_ESTADO
				)
				');
				$db->beginTransaction();
				$stt->bindValue(':CLIENTE_NOME', $dados['CLIENTE_NOME'], PDO::PARAM_STR);
				$stt->bindValue(':CLIENTE_CPF', preg_replace('/[^0-9]/', '', $dados['CLIENTE_CPF']), PDO::PARAM_STR);
				$stt->bindValue(':CLIENTE_CEP',  preg_replace('/[^0-9]/', '', $dados['CLIENTE_CEP']), PDO::PARAM_STR);
				$stt->bindValue(':CLIENTE_ENDERECO', $dados['CLIENTE_ENDERECO'], PDO::PARAM_STR);
				$stt->bindValue(':CLIENTE_NUMERO', $dados['CLIENTE_NUMERO'], PDO::PARAM_STR);
				$stt->bindValue(':CLIENTE_BAIRRO', $dados['CLIENTE_BAIRRO'], PDO::PARAM_STR);
				$stt->bindValue(':CLIENTE_CIDADE', $dados['CLIENTE_CIDADE'], PDO::PARAM_STR);
				$stt->bindValue(':CLIENTE_ESTADO', $dados['CLIENTE_ESTADO'], PDO::PARAM_STR);
				$resultado['inserir'] = $stt->execute();
				$ultimo_id = $db->lastInsertId();

				// SE O BAIRRO EXISTE PARA INSERI-LO COMO NOVO NA TABELA DE BAIRROS
				if ($resultado['inserir']) {
					$db = Db::getInstance();
					$stt = $db->prepare("SELECT brr.BAIRRO_ID
						FROM `bairros` AS brr
						WHERE BAIRRO_NOME = :CLIENTE_BAIRRO");
					$stt->bindValue(':CLIENTE_BAIRRO', $dados['CLIENTE_BAIRRO'], PDO::PARAM_STR);
					$stt->execute();
					$resultado['bairro'] = $stt->fetchAll(PDO::FETCH_NUM);
					//SE O BAIRRO NÃO EXISTIR, INSERIR-LO
					if (sizeof($resultado['bairro']) <= 0) {
						$db = Db::getInstance();
						$stt = $db->prepare("INSERT INTO `bairros`
							 (`BAIRRO_NOME`)
							 VALUES
							(:CLIENTE_BAIRRO)");

						$stt->bindValue(':CLIENTE_BAIRRO', $dados['CLIENTE_BAIRRO'], PDO::PARAM_STR);
						$stt->execute();
						$resultado['bairro_id'] = $db->lastInsertId();

						//SE A INSERÇÃO DO BAIRRO FOR OK, INSERIR O CEP DELE NA TABELA AUXILIAR
						if ($resultado['bairro_id']) {
							var_dump($resultado['bairro_id']);

							$db = Db::getInstance();
							$stt = $db->prepare("INSERT INTO `bairros_cep`
									 (`BAIRRO_ID`,
									  `BAIRRO_CLIENTE_ID`,
									  `BAIRRO_CEP_DESC`)
									 VALUES
									(:BAIRRO_ID,
									 :BAIRRO_CLIENTE_ID,
									 :BAIRRO_CEP_DESC)");

							$stt->bindValue(':BAIRRO_ID', $resultado['bairro_id'], PDO::PARAM_INT);
							$stt->bindValue(':BAIRRO_CLIENTE_ID', $ultimo_id, PDO::PARAM_INT);
							$stt->bindValue(':BAIRRO_CEP_DESC', preg_replace('/[^0-9]/', '', $dados['CLIENTE_CEP']), PDO::PARAM_STR);
							$resultado['inserir_cep']  = $stt->execute();
						}
						// SE O BAIRRO EXISTIR 
					} else {
						//APENAS INSERIR O CEP NA TABELA AUXILIAR
						$db = Db::getInstance();
						$stt = $db->prepare("INSERT INTO `bairros_cep`
										 (`BAIRRO_ID`,
										  `BAIRRO_CLIENTE_ID`,
										  `BAIRRO_CEP_DESC`)
										 VALUES
										(:BAIRRO_ID,
										 :BAIRRO_CLIENTE_ID,
										 :BAIRRO_CEP_DESC)");

						$stt->bindValue(':BAIRRO_ID', $resultado['bairro'][0][0], PDO::PARAM_INT);
						$stt->bindValue(':BAIRRO_CLIENTE_ID', $ultimo_id, PDO::PARAM_INT);
						$stt->bindValue(':BAIRRO_CEP_DESC', preg_replace('/[^0-9]/', '', $dados['CLIENTE_CEP']), PDO::PARAM_STR);
						$resultado['inserir_cep']  = $stt->execute();
					}
				}
				$db->commit();
			} else {
				$resultado['cliente_ja_inserido'] = true;
			}
		} catch (Exception $e) {
			$resultado['excecao'] = $e->getMessage();
		} finally {
			return $resultado;
		}
	}


	//EDIT
	public static function editar($dados, $id)
	{
		$resultado = NULL;
		try {
			$db = Db::getInstance();
			$stt = $db->prepare('UPDATE
			`clientes`
			SET
			`CLIENTE_NOME` = :CLIENTE_NOME,
			`CLIENTE_CPF` = :CLIENTE_CPF,
			`CLIENTE_CEP` = :CLIENTE_CEP,
			`CLIENTE_ENDERECO` = :CLIENTE_ENDERECO,
			`CLIENTE_NUMERO` = :CLIENTE_NUMERO,
			`CLIENTE_BAIRRO` = :CLIENTE_BAIRRO,
			`CLIENTE_CIDADE` = :CLIENTE_CIDADE,
			`CLIENTE_ESTADO` = :CLIENTE_ESTADO,
			`CLIENTE_ATIVO` = :CLIENTE_ATIVO,
			`CLIENTE_EDITADO_EM` = now() 
			WHERE 
			CLIENTE_ID = :id
			');
			$db->beginTransaction();
			$stt->bindValue(':CLIENTE_NOME', $dados['CLIENTE_NOME'], PDO::PARAM_STR);
			$stt->bindValue(':CLIENTE_CPF', preg_replace('/[^0-9]/', '', $dados['CLIENTE_CPF']), PDO::PARAM_STR);
			$stt->bindValue(':CLIENTE_CEP', preg_replace('/[^0-9]/', '', $dados['CLIENTE_CEP']), PDO::PARAM_STR);
			$stt->bindValue(':CLIENTE_ENDERECO', $dados['CLIENTE_ENDERECO'], PDO::PARAM_STR);
			$stt->bindValue(':CLIENTE_NUMERO', $dados['CLIENTE_NUMERO'], PDO::PARAM_STR);
			$stt->bindValue(':CLIENTE_BAIRRO', $dados['CLIENTE_BAIRRO'], PDO::PARAM_STR);
			$stt->bindValue(':CLIENTE_CIDADE', $dados['CLIENTE_CIDADE'], PDO::PARAM_STR);
			$stt->bindValue(':CLIENTE_ESTADO', $dados['CLIENTE_ESTADO'], PDO::PARAM_STR);
			$stt->bindValue(':CLIENTE_ATIVO', $dados['CLIENTE_ATIVO'], PDO::PARAM_INT);
			$stt->bindValue(':id', $id, PDO::PARAM_INT);
			$resultado['atualizar'] = $stt->execute();


			//EXCLUIR PARA READICIONAR
			if ($resultado['atualizar']) {
				$db = Db::getInstance();
				$stt = $db->prepare("SELECT brrc.BAIRRO_ID, brrc.BAIRRO_CEP_DESC
					FROM `bairros_cep` AS brrc
					WHERE BAIRRO_CLIENTE_ID = :id");
				$stt->bindValue(':id', $id, PDO::PARAM_INT);
				$stt->execute();
				$resultado['check'] = $stt->fetchAll(PDO::FETCH_NUM);

				//VERIFICAR BAIRRO
				if ($resultado['check']) {
					$db = Db::getInstance();
					$stt = $db->prepare("SELECT brrc.BAIRRO_ID, brrc.BAIRRO_CEP_DESC
						FROM `bairros_cep` AS brrc
						WHERE BAIRRO_ID = :id");
					$stt->bindValue(':id', $resultado['check'][0][0], PDO::PARAM_INT);
					$stt->execute();
					$resultado['check_bairro'] = $stt->fetchAll(PDO::FETCH_NUM);

					//VERIFICAR SE EXISTE SÓ ESSE CLIENTE NO BAIRRO, E SE FOR, DELETAR O BAIRRO TODO, 
					if (sizeof($resultado['check_bairro']) > 1) {
						$db = Db::getInstance();
						$stt = $db->prepare('DELETE FROM `bairros_cep` WHERE (BAIRRO_CLIENTE_ID = :id)');
						$stt->bindValue(':id', $id, PDO::PARAM_INT);
						$stt->execute();
						$resultado['bairro_cep'] = $stt->fetchAll(PDO::FETCH_NUM);
					} else {
						$db = Db::getInstance();
						$stt = $db->prepare('DELETE FROM `bairros` WHERE (BAIRRO_ID = :BAIRRO_ID)');
						$stt->bindValue(':BAIRRO_ID', $resultado['check'][0][0], PDO::PARAM_INT);
						$stt->execute();
						$resultado['bairro_cep'] = $stt->fetchAll(PDO::FETCH_NUM);

						$db = Db::getInstance();
						$stt = $db->prepare('DELETE FROM `bairros_cep` WHERE (BAIRRO_ID = :BAIRRO_ID)');
						$stt->bindValue(':BAIRRO_ID', $resultado['check'][0][0], PDO::PARAM_INT);
						$stt->execute();
						$resultado['bairro_cep'] = $stt->fetchAll(PDO::FETCH_NUM);
					}
				}
			}

			// READICIONAR
			if ($resultado['atualizar']) {
				$db = Db::getInstance();
				$stt = $db->prepare("SELECT brr.BAIRRO_ID
						FROM `bairros` AS brr
						WHERE BAIRRO_NOME = :CLIENTE_BAIRRO");
				$stt->bindValue(':CLIENTE_BAIRRO', $dados['CLIENTE_BAIRRO'], PDO::PARAM_STR);
				$stt->execute();
				$resultado['bairro'] = $stt->fetchAll(PDO::FETCH_NUM);
				//SE O BAIRRO NÃO EXISTIR, INSERIR-LO
				if (sizeof($resultado['bairro']) <= 0) {
					$db = Db::getInstance();
					$stt = $db->prepare("INSERT INTO `bairros`
							 (`BAIRRO_NOME`)
							 VALUES
							(:CLIENTE_BAIRRO)");

					$stt->bindValue(':CLIENTE_BAIRRO', $dados['CLIENTE_BAIRRO'], PDO::PARAM_STR);
					$stt->execute();
					$resultado['bairro_id'] = $db->lastInsertId();

					//SE A INSERÇÃO DO BAIRRO FOR OK, INSERIR O CEP DELE NA TABELA AUXILIAR
					if ($resultado['bairro_id']) {
						$db = Db::getInstance();
						$stt = $db->prepare("INSERT INTO `bairros_cep`
									 (`BAIRRO_ID`,
									  `BAIRRO_CLIENTE_ID`,
									  `BAIRRO_CEP_DESC`)
									 VALUES
									(:BAIRRO_ID,
									 :BAIRRO_CLIENTE_ID,
									 :BAIRRO_CEP_DESC)");

						$stt->bindValue(':BAIRRO_ID', $resultado['bairro_id'], PDO::PARAM_INT);
						$stt->bindValue(':BAIRRO_CLIENTE_ID', $id, PDO::PARAM_INT);
						$stt->bindValue(':BAIRRO_CEP_DESC', preg_replace('/[^0-9]/', '', $dados['CLIENTE_CEP']), PDO::PARAM_STR);
						$resultado['inserir_cep']  = $stt->execute();
					}
					// SE O BAIRRO EXISTIR 
				} else {
					//APENAS INSERIR O CEP NA TABELA AUXILIAR
					$db = Db::getInstance();
					$stt = $db->prepare("INSERT INTO `bairros_cep`
									 (`BAIRRO_ID`,
									  `BAIRRO_CLIENTE_ID`,
									  `BAIRRO_CEP_DESC`)
									 VALUES
									(:BAIRRO_ID,
									 :BAIRRO_CLIENTE_ID,
									 :BAIRRO_CEP_DESC)");

					$stt->bindValue(':BAIRRO_ID', $resultado['bairro'][0][0], PDO::PARAM_INT);
					$stt->bindValue(':BAIRRO_CLIENTE_ID', $id, PDO::PARAM_INT);
					$stt->bindValue(':BAIRRO_CEP_DESC', preg_replace('/[^0-9]/', '', $dados['CLIENTE_CEP']), PDO::PARAM_STR);
					$resultado['inserir_cep']  = $stt->execute();
				}
			}
			$db->commit();
		} catch (Exception $e) {
			$resultado['excecao'] = $e->getMessage();
		} finally {
			return $resultado;
		}
	}

	//DELETE
	public static function delete($id)
	{
		$resultado = NULL;
		try {

			//VERIFICAR BAIRRO DO CLIENTE
			$db = Db::getInstance();
			$stt = $db->prepare("SELECT brrc.BAIRRO_ID, brrc.BAIRRO_CEP_DESC
				FROM `bairros_cep` AS brrc
				WHERE BAIRRO_CLIENTE_ID = :id");
			$stt->bindValue(':id', $id, PDO::PARAM_INT);
			$stt->execute();
			$resultado['check'] = $stt->fetchAll(PDO::FETCH_NUM);

			//VERIFICAR OS CEPS DESTE BAIRRO
			if ($resultado['check']) {
				$db = Db::getInstance();
				$stt = $db->prepare("SELECT brrc.BAIRRO_ID, brrc.BAIRRO_CEP_DESC
					FROM `bairros_cep` AS brrc
					WHERE BAIRRO_ID = :id");
				$stt->bindValue(':id', $resultado['check'][0][0], PDO::PARAM_INT);
				$stt->execute();
				$resultado['check_bairro'] = $stt->fetchAll(PDO::FETCH_NUM);

				//VERIFICAR SE EXISTE SÓ ESSE CLIENTE NO BAIRRO, SE NÃO FOR, DELETAR APENAS O CEP, 
				if (sizeof($resultado['check_bairro']) > 1) {
					$db = Db::getInstance();
					$stt = $db->prepare('DELETE FROM `bairros_cep` WHERE (BAIRRO_CLIENTE_ID = :id)');
					$stt->bindValue(':id', $id, PDO::PARAM_INT);
					$stt->execute();
					$resultado['bairro_cep'] = $stt->fetchAll(PDO::FETCH_NUM);
				} else {

					//SE NÃO, DELETAR O BAIRRO INTEIRO
					$db = Db::getInstance();
					$stt = $db->prepare('DELETE FROM `bairros` WHERE (BAIRRO_ID = :BAIRRO_ID)');
					$stt->bindValue(':BAIRRO_ID', $resultado['check'][0][0], PDO::PARAM_INT);
					$stt->execute();
					$resultado['bairro_cep'] = $stt->fetchAll(PDO::FETCH_NUM);

					$db = Db::getInstance();
					$stt = $db->prepare('DELETE FROM `bairros_cep` WHERE (BAIRRO_ID = :BAIRRO_ID)');
					$stt->bindValue(':BAIRRO_ID', $resultado['check'][0][0], PDO::PARAM_INT);
					$stt->execute();
					$resultado['bairro_cep'] = $stt->fetchAll(PDO::FETCH_NUM);
				}
			}

			//DELETAR O CLIENTE
			$db = Db::getInstance();
			$stt = $db->prepare('DELETE FROM `clientes` WHERE (CLIENTE_ID = :id) ');
			$stt->bindValue(':id', $id, PDO::PARAM_INT);
			$resultado['excluir'] = $stt->execute();
			$resultado['excluido'] = $stt->fetchAll(PDO::FETCH_NUM);
			$db->commit();
		} catch (Exception $e) {
			$resultado['excecao'] = $e->getMessage();
		} finally {
			return $resultado;
		}
	}
}
