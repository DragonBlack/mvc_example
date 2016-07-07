<?php
class View {
    public $layout = 'main';

    public function render($view, $data){
        extract($data);
        ob_start();
        require $view;
        $content = ob_get_clean();
        require ROOT.DS.'views'.DS.'layout'.DS.$this->layout.'.php';
    }
}