<?php

class Relatorios
{
	public static function listaTodosPaginacaoClientes($totalRegistros, $paginaAtual, $filtros = null)
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
			$string .= ' AND clt.CLIENTE_NOME LIKE "%" ' . ' :CLIENTE_NOME' . ' "%" ';
		}

		if (isset($filtros['CLIENTE_CPF']) && !empty($filtros['CLIENTE_CPF'])) {
			$string .= ' AND clt.CLIENTE_CPF = :CLIENTE_CPF';
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

		if (isset($filtros['CLIENTE_CPF']) && !empty($filtros['CLIENTE_CPF'])) {
			$req->bindValue(':CLIENTE_CPF',  preg_replace('/[^0-9]/', '', $filtros['CLIENTE_CPF']), PDO::PARAM_STR);
		}

		$req->execute();
		$resultado = $req->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}

	public static function listaTodosTotalClientes($filtros = null)
	{
		$string = '';

		if (isset($filtros['CLIENTE_NOME']) && !empty($filtros['CLIENTE_NOME'])) {
			$string .= ' AND clt.CLIENTE_NOME LIKE :CLIENTE_NOME';
		}

		if (isset($filtros['CLIENTE_CPF']) && !empty($filtros['CLIENTE_CPF'])) {
			$string .= ' AND clt.CLIENTE_CPF = :CLIENTE_CPF';
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

		if (isset($filtros['CLIENTE_CPF']) && !empty($filtros['CLIENTE_CPF'])) {
			$req->bindValue(':CLIENTE_CPF',  preg_replace('/[^0-9]/', '', $filtros['CLIENTE_CPF']), PDO::PARAM_STR);
		}

		$req->execute();
		$resultado = $req->fetchAll(PDO::FETCH_NUM);
		return $resultado;
	}


	public static function listaTodosPaginacaoBairros()
	{
		$req = Db::getInstance()->prepare("SELECT
							brr.BAIRRO_ID,
							brr.BAIRRO_NOME,
							COUNT(brrc.BAIRRO_CEP_DESC)
						FROM 
						  `bairros` AS brr
						LEFT JOIN bairros_cep AS brrc ON brr.BAIRRO_ID = brrc.BAIRRO_ID
						GROUP BY
							brr.BAIRRO_ID 
						HAVING 
							COUNT(brrc.BAIRRO_CEP_DESC) > 1 
						ORDER BY
							brr.BAIRRO_ID ASC
						");

		$req->execute();
		$resultado = $req->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}

	public static function listaTodosTotalBairros()
	{
		$req = Db::getInstance()->prepare("SELECT
							count(brr.BAIRRO_ID)
						  FROM 
						  `bairros` AS brr
						  WHERE
						  brr.BAIRRO_ID = 0

						  ");

		$req->execute();
		$resultado = $req->fetchAll(PDO::FETCH_NUM);
		return $resultado;
	}
}
