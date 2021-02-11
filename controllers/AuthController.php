<?php

namespace app\controllers;

use app\models\AuthModel;
use app\models\User;

class AuthController extends \app\core\Controller
{
    public function index($request)
    {
       return $this->render("login");
    }

    public function login($request, $response)
    {
        $authModel = new AuthModel();

        if($request->getMethod() === 'post'){
            $authModel->loadData($request->getBody());
            if($authModel->login()){
                $response->redirect('/');
                return;
            }
        }
    }

    public function signup($request, $response)
    {
        $user = new User();

        if($request->getMethod() === 'post'){
            $user->loadData($request->getBody());
            if($user->add()){
                $response->redirect('/');
                return;
            }
        }

        return $this->render("signup");
    }

    public function logout($request, $response)
    {
        $authModel = new AuthModel();
        if($authModel->logout()){
            $response->redirect('/');
            return;
        }
    }
}