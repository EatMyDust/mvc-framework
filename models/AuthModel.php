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

        if(!$user || !password_verify($this->password, $user->password)) {
            $this->addError("Wrong login or password", self::RULE_CORRECT);
            return false;
        }
        return Application::$app->login($user);
    }

    public function logout()
    {
        return Application::$app->logout();
    }

    public function rules(): array
    {
        return [
        ];
    }
}