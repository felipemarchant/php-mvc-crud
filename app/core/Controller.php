<?php

class Controller {

    private $title;

    protected function setTitle($title) {
        $this->title = $title;
    }
    protected function view($viewName, $data = []) {
        if(file_exists('../app/views/' . $viewName . '.php')){
            $title = $this->title;
            extract($data);
            require_once '../app/views/' . $viewName . '.php';
        } else {
            die('View não existe');
        }
    }
    protected function getModel($modelName) {
        // Require model file
        $path = '../app/models/' . $modelName . '.php';
        if(file_exists($path)) {
            require_once $path;
            // Instatiate model
            return new $modelName();
        }
        return null;
    }
}