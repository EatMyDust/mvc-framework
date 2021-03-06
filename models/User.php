<?php

namespace app\models;

class User extends \app\core\DatabaseModel
{
    public $login = '';
    public $password = '';
    public $email;

    public function tableName()
    {
        return 'users';
    }

    public function attributes()
    {
        return ['login', 'email', 'password'];
    }

    public function add()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return[
            'login' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED]
        ];
    }
}