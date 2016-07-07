<?php
class SiteController extends Controller {
    public function actionIndex(){
        $res = App::Component('db')->query('');
        $this->render('index');
    }
    
    public function actionAdmin_index(){
        $this->render('admin_index');
    }
}