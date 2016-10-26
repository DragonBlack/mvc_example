<?php
class SiteController extends Controller {
    public function actionIndex(){
        $res = (new Query())->select(['login', 'email'])
            ->from('users')
            ->one();


        $this->render('index', ['result'=>$res]);
    }

    public function actionLogin(){
        $model = new LoginForm();

        $request = App::Component('request');
        if($model->load($request->post('LoginForm', []))){
            $user = User::find([
                'login=:login AND password=:password',
                [
                    ':login' => $model->login,
                    ':password' => $model->password
                ]
            ])->one();
            if($user){
                App::Component('auth')->auth($user['id']);
                $this->redirect('/');
            }
        }

        $this->render('login', [
            'form' => $model
        ]);
    }

    public function actionLogout(){
        App::Component('auth')->logout();
        $this->redirect('/');
    }

    public function actionAdmin_index(){
        $this->render('admin_index');
    }
}