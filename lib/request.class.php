<?php
class Request {
    private $_post = [];
    private $_get = [];

    public function __construct(){
        $this->_post = $_POST;
        $this->_get = $_GET;
    }

    public function post($name, $default=null){
        return isset($this->_post[$name]) ? $this->_post[$name] : $default;
    }

    public function get($name, $default=null){
        return isset($this->_get[$name]) ? $this->_get[$name] : $default;
    }
}