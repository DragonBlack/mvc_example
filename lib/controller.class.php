<?php
class Controller {
    protected $layout;

    public function __construct() {
        App::Component('auth')->autoLogin();
    }

    protected function render($viewName, array $params=[]){
        $view_root_path = ROOT.DS.'views'.DS;
        $className = str_replace('Controller', '', static::class);
        $view_path = $view_root_path.strtolower($className).DS.$viewName.'.php';

        $view = App::Component('view');
        if(!empty($this->layout)) {
            $view->layout = $this->layout;
        }
        $view->render($view_path, $params);
    }

    protected function redirect($url){
        header('Location: '.$url, true, 302);
        exit(0);
    }
}