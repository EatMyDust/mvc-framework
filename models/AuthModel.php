<?php


namespace app\models;

use app\core\Application;
use app\core\Model;

class AuthModel extends Model
{
    public $login;
    public $password;

    public function login()
    {
        $user = User::findOne(['login' => $this->login]);

        if(!$user) {
            echo("wrong login or password");
            return false;
        }
        if(!password_verify($this->password, $user->password)){
            echo("wrong login or password");
            return false;
        }
        return Application::$app->login($user);
    }

    public function logout()
    {
        return Application::$app->logout();
    }
}