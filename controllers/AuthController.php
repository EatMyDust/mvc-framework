<?php

namespace app\controllers;

use app\models\AuthModel;

class AuthController extends \app\core\Controller
{
    public function index($request)
    {
       return $this->render("auth");
    }

    public function login($request, $response)
    {
        $authModel = new AuthModel();

        if($request->getMethod() === 'post')
        {
            $authModel->loadData($request->getBody());
            if($authModel->login())
            {
                $response->redirect('/');
                return;
            }
        }
    }

    public function logout($request, $response)
    {
        $authModel = new AuthModel();
        if($authModel->logout())
        {
            $response->redirect('/');
            return;
        }
    }
}