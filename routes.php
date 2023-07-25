<?php


function call($controller, $action, $params = null)
{
  switch ($controller) {
    case 'home':
      require_once('controllers/home_controller.php');
      $controller = new HomeController();
      break;

    case 'clientes':
      require_once('controllers/clientes_controller.php');
      $controller = new ClientesController();
      break;

    case 'bairros':
      require_once('controllers/bairros_controller.php');
      $controller = new BairrosController();
      break;

    case 'relatorios':
      require_once('controllers/relatorios_controller.php');
      $controller = new RelatoriosController();
      break;

    default:
      require_once('controllers/home_controller.php');
      $controller = new HomeController();
  }

  if (method_exists($controller, $action) != FALSE) {
    if (isset($_POST)) {
      if ($params != null) {
        $controller->{$action}($params, $_POST);
      } else {
        $controller->{$action}($_POST);
      }
    } else {
      $controller->{$action}($params);
    }
  } else {
    if ($action == is_numeric($action)) {
      $controller->{'index'}($params);
    } else {
      require_once('controllers/home_controller.php');
      $controller = new HomeController();
      $controller->{'error'}($params);
    }
  }
}
