<?php
ini_set('default_charset', 'UTF-8');
class Db
{
  private static $instance = NULL;

  private function __construct()
  {
  }

  private function __clone()
  {
  }

  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] =  "SET NAMES utf8";
      self::$instance = new PDO('mysql:host=localhost;dbname=processo_seletivo;charset=utf8', 'root', '', $pdo_options);
    }
    return self::$instance;
  }
}
