<?php

class Config{

    protected static $_instance;
    
    protected $_settings = [];
    
    public static function getInstance($config_path=null){
        if(!self::$_instance){
            self::$_instance = new Config($config_path);
        }
        return self::$_instance;
    }
    
    private function __construct(){
        $config_path = ROOT.DS.'config'.DS.'config.php';
        $this->_settings = require_once($config_path);
    }
    
    public function get($key){
        return isset($this->_settings[$key]) ? $this->_settings[$key] : null;
    }
}