<?php
class Auth {
    private $_isGuest = true;

    public function auth($uid=null){
        if($uid) {
            $session = App::Component('session');
            $token = $this->generateToken();
            $session->set('uid', $uid);
            $session->set('cfs', $token);
            $session->setCookie('cfs', $token);
        }
    }

    public function autoLogin(){
        $session = App::Component('session');
        $t1 = $session->get('cfs');
        $t2 = $session->getCookie('cfs');

        if($t1 && $t2 && $t1 == $t2){
            $this->_isGuest = false;
        }
    }

    public function logout(){
        $session = App::Component('session');
        $session->delete('uid');
        $session->delete('cfs');
        $session->deleteCookie('cfs');
    }

    public function isGuest(){
        return $this->_isGuest;
    }

    private function generateToken(){
        $a = openssl_random_pseudo_bytes(20);
        $token = bin2hex($a);
        return $token;
    }
}