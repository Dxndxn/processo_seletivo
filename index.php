<?php
ob_start();
date_default_timezone_set('America/Sao_Paulo');
ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

require_once('connection.php');
require_once('funcoes/constants.php');
require_once('funcoes/funcoes.php');
require_once('library/paginacao.php');
require_once('routes.php');

$url = MontaUrl();
//var_dump($url);

$controller = null;
$action = null;
$params = null;

if (isset($url[1]) && !empty($url[1])) {
  $controller = $url[1];

  if (isset($url[2]) && !empty($url[2])) {
    $action = $url[2];

    if (isset($url[3]) && !empty($url[3])) {
      $params = $url[3];
    }
  } else {
    $action = 'index';
    $params = null;
  }
} else {
  $controller = 'home';
  $action     = 'index';
  $params = null;
}

// ROTAS LAYOUT BLANK
$ajax = array('ajax');

if (isset($url[1]) && in_array($url[1], $ajax)) {
  require_once('views/blank.php');
} else {
  require_once('views/layout.php');
}
