<?php
class PageController extends Controller {
    public function actionIndex(){
        if(App::Component('auth')->isGuest()){
            $this->redirect('/site/login');
        }

        $page = App::Component('request')->get('name');
        if($page === null){
            $this->redirect('/');
        }
        $this->render($page);
    }
}