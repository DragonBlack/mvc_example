<?php
class Session {
    public function __construct(){
        session_start();
    }

    public function get($key){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function set($key, $val){
        $_SESSION[$key] = $val;
    }
}