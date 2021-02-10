<?php

namespace app\models;

class User extends \app\core\DatabaseModel
{
    public $login = '';
    public $password = '';

    public function tableName()
    {
        return 'users';
    }

    public function attributes()
    {
        return ['login', 'email', 'password'];
    }

}