<?php

class App{

    protected static $_components = [];

    protected static $_controller;

    protected static $_action;

    public static function Component($name)
    {
        if(isset(self::$_components[$name])){
            return self::$_components[$name];
        }

        throw new Exception('Component "'.$name.'" not found');
    }

    public static function run(){
        self::$_components['config'] = $config = Config::getInstance(ROOT.DS.'config'.DS.'config.php');
        self::$_components['view'] = new View();
        self::$_components['session'] = new Session();
        self::$_components['auth'] = new Auth();
        foreach($config->get('components') as $name => $settings){
            if(!array_key_exists('class', $settings)){
                throw new Exception('Class must be defined for component '.$name);
            }
            $object = new $settings['class']();
            unset($settings['class']);
            foreach($settings as $property => $val){
                $object->$property = $val;
            }
            self::$_components[$name] = $object;
        }

        if(!isset(self::$_components['router'])){
            self::$_components['router'] = new Router();
        }

        if(!isset(self::$_components['request'])){
            self::$_components['request'] = new Request();
        }

        self::$_components['router']->parseUrl();

        $controller_class = ucfirst(self::$_components['router']->getController()).'Controller';
        self::$_action = $controller_method = 'action'.ucfirst(self::$_components['router']->getMethodPrefix().self::$_components['router']->getAction());

        self::$_controller = new $controller_class();

        if(!self::$_controller instanceof Controller){
            throw new Exception('Класс '.$controller_class.' должен быть экземпляром класса lib/Controller');
        }

        if(!method_exists(self::$_controller, $controller_method)){
            throw new Exception('Метод '.$controller_method.' не найден в классе '.$controller_class);
        }

        self::$_controller->{self::$_action}();
        
    }

    /**
     * @return mixed
     */
    public static function getController()
    {
        return self::$_controller;
    }

    /**
     * @return mixed
     */
    public static function getAction()
    {
        return self::$_action;
    }
}