<?php
class Controller {
    protected $layout;

    protected function render($viewName, array $params=[]){
        $view_root_path = ROOT.DS.'views'.DS;
        $className = str_replace('Controller', '', static::class);
        $view_path = $view_root_path.DS.strtolower($className).DS.$viewName.'.php';

        $view = App::Component('view');
        if(!empty($this->layout)) {
            $view->layout = $this->layout;
        }
        $view->render($view_path, $params);
    }
}