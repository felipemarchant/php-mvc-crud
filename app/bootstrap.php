<?php

require_once 'config/config.php';
require_once 'helpers/helper.php';

// Autoload Core Libraries
spl_autoload_register(function($className){
    require_once 'core/' . $className . '.php';
});
  
