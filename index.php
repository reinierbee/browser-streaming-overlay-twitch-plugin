<?php
require("bootstrap.php");

$app = new \Slim\Slim();
$app->config('debug', true);
$_SERVER['REQUEST_METHOD'] = "GET";
$_SERVER['REMOTE_ADDR'] = "127.0.0.1";
$_SERVER['REQUEST_URI'] = "/browser-streaming-overlay-twitch-plugin/index.php/api/asda";
$_SERVER['SERVER_NAME'] = "PhpStorm 8.0.1";
$_SERVER['SERVER_PORT'] = "80";
$_SERVER['PATH_INFO'] = "/api/asda";


$app->get('/api/:name', function ($name) {
    echo "Hello, $name";
});

$app->run();