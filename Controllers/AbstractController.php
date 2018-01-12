<?php
namespace RESTAPI\Controllers;

use PHPMVC\LIB\FrontController;
use PHPMVC\LIB\Template;
use PHPMVC\Lib\Validate;

class AbstractController
{
    protected $_controller;
    protected $_action;
    protected $_params;

    protected $_data = [];

    public function __get($key)
    {
        return $this->_registry->$key;
    }

    public function notFoundAction()
    {
        $this->_view();
    }

    public function setController ($controllerName)
    {
        $this->_controller = $controllerName;
    }

    public function setAction ($actionName)
    {
        $this->_action = $actionName;
    }

    public function setParams ($params)
    {
        $this->_params = $params;
    }
}