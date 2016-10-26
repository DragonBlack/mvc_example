<?php

class Router{

    public $default_controller = 'site';
    
    public $default_action = 'index';

    public $default_language = 'en';

    public $routes = [];
    
    protected $uri;

    protected $controller;

    protected $action;

    protected $params;

    protected $route;

    protected $method_prefix;

    protected $language;

    private $_config;

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return mixed
     */
    public function getMethodPrefix()
    {
        return $this->method_prefix;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    public function parseUrl(){
        if(($domain = $this->_config->get('root_domain')) != ''){
            $this->uri = preg_replace('#^/'.$domain.'#', '', $this->uri);
        }
        $this->uri = urldecode(trim($this->uri, '/'));

        $this->controller = $this->default_controller;
        $this->action = $this->default_action;
        $this->language = $this->default_language;

        $uri_parts = explode('?', $this->uri);
        $path = $uri_parts[0];
        $path_parts = explode('/', $path);

        if ( count($path_parts) ){
            // Get route or language at first element
            if ( in_array(strtolower(current($path_parts)), array_keys($this->routes)) ){
                $this->route = strtolower(current($path_parts));
                $this->method_prefix = isset($this->routes[$this->route]) ? $this->routes[$this->route] : '';
                array_shift($path_parts);
            } elseif ( in_array(strtolower(current($path_parts)), Config::getInstance()->get('languages')) ){
                $this->language = strtolower(current($path_parts));
                array_shift($path_parts);
            }
            // Get controller - next element of array
            if ( current($path_parts) ){
                $this->controller = strtolower(current($path_parts));
                array_shift($path_parts);
            }
            // Get action
            if ( current($path_parts) ){
                $this->action = strtolower(current($path_parts));
                array_shift($path_parts);
            }

            // Get params - all the rest
            $this->params = $path_parts;
        }
    }
    public function __construct(){
        $this->_config = App::Component('config');
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    public function to($url){
        if(is_string($url)){
            $url = trim($url, '/');
            return '/'.$url.'/';
        }

        list($controller, $action) = explode('/', $url[0]);
        if(empty($controller) || empty($action)){
            throw new Exception('Controller and action can\'t be empty');
        }

        $uri = '';
        if(!empty($this->route)){
            $uri = '/'.$this->route;
        }

        if($this->language != $this->default_language){
            $uri .= '/'.$this->language;
        }

        if($controller != $this->default_controller){
            $uri .= '/'.$controller;
        }

        if($action != $this->default_action){
            $uri .= '/'.$action;
        }

        unset($url[0]);
        if(empty($url)){
            return $uri;
        }

        $uri .= '/?';

        foreach($url as $param=>$val){
            $uri .= $param.'='.$val.'&';
        }
        $uri = substr($uri, 0, -1);
        return $uri;
    }
}