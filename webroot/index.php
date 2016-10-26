<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));

try {
    require_once(ROOT . DS . 'lib' . DS . 'init.php');

    App::run();
}
catch (Exception $e){
    echo $e->getMessage();
}