<?php
class PageController extends Controller {
    public function actionShow(){
        $params = App::Component('router')->getParams();
        $this->render($params[0]);
    }
}