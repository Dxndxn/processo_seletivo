<?php


function MontaUrl()
{ {
		$url_parts = explode("/", $_SERVER['REQUEST_URI']);
		$url_parts = array_filter($url_parts, function ($value) {
			return $value !== '';
		});

		if (isset($url_parts[1]) && $url_parts[1] == 'covid19') {
			unset($url_parts[1]);
		}

		$url_parts = array_values($url_parts);
		return $url_parts;
	}
}




function formata_moeda($valor)
{

	$valor = number_format($valor, 2, ',', '.');

	return $valor;
}

function formataCep($input)
{
	return preg_replace('/^(\d{2})(\d{3})(\d{3})$/', '\\1.\\2-\\3', $input);
}

function formataCpf($input)
{
	return preg_replace('/^(\d{1,3})(\d{3})(\d{3})(\d{2})$/', '${1}.${2}.${3}-${4}', $input);
}

function formataCnpj($input)
{
	return preg_replace("/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/", "\\1.\\2.\\3/\\4-\\5", $input);
}

function formataTelefone($numero)
{
	return preg_replace('/(\d{2})(\d{4})(\d*)/', '($1) $2-$3', $numero);
}

function formata_dimensao($valor)
{

	$valor = number_format($valor, 2, '.', ',');

	return $valor;
}



function inverteData($date_str)
{
	if ($date_str !== NULL) {
		$expl = explode('-', $date_str);

		if (isset($expl[1]) && isset($expl[2])) {
			$nova = $expl[2] . '/' . $expl[1] . '/' . $expl[0];

			return $nova;
		} else {
			return false;
		}
	} else return false;
}

function inverteDatetime($date_str)
{
	$phpdate = strtotime($date_str);
	$mysqldate = date('d/m/Y H:i:s', $phpdate);
	return $mysqldate;
}
