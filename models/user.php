<?php
class User extends Model {
    protected static $tableName = 'users';

    public $login;
    public $password;
    public $email;
    public $role;
    public $is_active;

    public function attributes(){
        return [
            'login',
            'password',
            'email',
            'role',
            'is_active',
        ];
    }
}