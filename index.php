<?php

require_once __DIR__.'/autoload.php';
use app\core\Application;

$app = new Application();
$app->router->get('/', function (){
    return 'hello';
});
$app->run();

?>