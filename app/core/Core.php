<?php

class Core {
    
    private $url;
    private $controller = 'Message'; //Default controller
    private $action     = 'index';   //Default action
    private $params     = [];

    public function __construct() {

        $this->url = $this->getUrl();

        $controllerName = isset($this->url[0]) ? $this->url[0] : $this->controller ;
        $actionName     = isset($this->url[1]) ? $this->url[1] : $this->action ;

        //Controller
        $this->setControllerBy($controllerName);

        $this->controller = new $this->controller;    
        
        //Action
        $this->setActionBy($actionName);

        $this->params = ( count($this->url) > 2 ) ? array_slice($this->url, 2) : $this->params;

        // Call a callback with array of params
        call_user_func_array([$this->controller, $this->action], $this->params);

    }

    private function setControllerBy($controllerName) {
        $controllerName = ucwords($controllerName);
        $path = $this->getControllerPath($controllerName);
        if(!file_exists($path)){
            $path = $this->getControllerPath($this->controller);
            $controllerName = $this->controller;
        }
        require_once $path;
        $this->controller = $controllerName;
    }
    
    private function setActionBy($actionName) {
        if(method_exists($this->controller, $actionName)){
            $this->action = $actionName;
        }
    }

    private function getUrl() {
        $url = [];

        if(isset($_GET['url'])){
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
        }
        return $url;
    }

    private function getControllerPath($controllerName) {
        return '../app/controllers/' . $controllerName . '.php';
    }
}