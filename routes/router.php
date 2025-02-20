<?php

use App\Controllers\ProductController;
use Bramus\Router\Router;

$router = new Router();

// Nơi khai báo các đường dẫn
$router->get('/', function () {
    echo "Base dự thi môn PHP 2";
});

// Nhóm route ta sử dụng mount
$router->mount('/admin', function () use ($router) {
    // Dashboard
    $router->get('/', function () {
        return view('admin.dashboard');
    });

    // Nhóm đường dẫn quản lý sản phẩm
    $router->mount('/products', function () use ($router) {
        $router->get('/',               ProductController::class . '@index');
        $router->get('/create',         ProductController::class . '@create');
        $router->post('/store',         ProductController::class . '@store');
        $router->get('/{id}/edit',      ProductController::class . '@edit');
        $router->post('/{id}/update',   ProductController::class . '@update');
        $router->post('/{id}/delete',   ProductController::class . '@delete');
    });
});


// --------------------------

$router->run();
