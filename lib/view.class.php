<?php
class View {
    public $layout = 'main';
    protected $_lang;

    public function render($view, $data){
        if($this->_lang === null){
            $this->_lang = App::Component('router')->getLanguage();
        }
        extract($data);
        ob_start();
        require $view;
        $content = ob_get_clean();
        require ROOT.DS.'views'.DS.'layout'.DS.$this->layout.'.php';
    }
}