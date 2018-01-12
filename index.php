<?php
namespace RESTAPI;

use RESTAPI\Helpers\FrontController;

if(!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

require_once 'Config' . DS . 'main.php';
require_once APP_PATH . DS . 'Helpers' . DS . 'Autoload.php';

$frontController = new FrontController();
$frontController->dispatch();
