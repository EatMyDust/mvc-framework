<?php
    require_once __DIR__.'/autoload.php';
    require_once __DIR__.'/config.php';

    use app\core\Application;
    use app\controllers\AuthController;
    use app\controllers\SectionsController;

    $config = [
        'db' => CONFIG_DB
    ];

    $app = new Application($config);

    if(!$app->isAuthorized()) {
        //For guest
        $app->router->get('/', [AuthController::class, 'index']);
        $app->router->post('/', [AuthController::class, 'login']);
        $app->router->get('/signup', [AuthController::class, 'signup']);
        $app->router->post('/signup', [AuthController::class, 'signup']);
    } else {
        //For authorized
        $app->router->get('/', [SectionsController::class, 'index']);
        $app->router->get('/section', [SectionsController::class, 'index']);
        $app->router->get('/logout', [AuthController::class, 'logout']);

        //For admin section
        $app->router->get('/admin/sections/add', [SectionsController::class, 'add']);
        $app->router->post('/admin/sections/add', [SectionsController::class, 'add']);
        $app->router->get('/admin/sections/list', [SectionsController::class, 'list']);
        $app->router->get('/admin/sections/edit', [SectionsController::class, 'edit']);
        $app->router->post('/admin/sections/edit', [SectionsController::class, 'edit']);
        $app->router->get('/admin/sections/remove', [SectionsController::class, 'remove']);
    }
    $app->run();
