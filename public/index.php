<?php

session_start();

include __DIR__ . '/../vendor/autoload.php';

use App\Routing\Router;
use App\Database\Install;

echo 'Apád faszát';

$router = new Router();
$router->handle();