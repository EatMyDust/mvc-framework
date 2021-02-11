<?php
namespace app\core;

use app\models\User;

class Application
{
    public $router;
    public $request;
    public $response;
    public $controller;
    public $db;
    public $session;
    public $user;

    public static $app;

    public function __construct($config)
    {
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->db = new Database($config['db']);

        $userID = $this->session->get('user');
        if($userID){
            $this->user = User::findOne(['id'=>$userID]);
        }
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function login($user)
    {
        $this->user = $user;
        $primaryValue = $user->id;
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove(['user']);
        return true;
    }

    public function isAuthorized()
    {
        return self::$app->user;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }
}