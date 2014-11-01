<?php
require("../../../../vendor/autoload.php");
require("../../autoload.php");

use Module\Chat;

$app = new \Slim\Slim();
$app->response->headers->set("Content-type","application/json");



// API group
$app->group('/messages', function () use ($app) {

    $app->get('/:target', function ($target) use ($app) {

        $message = new Chat\Chat(include("../../../../config-database.php"));
        $data = $message->getMessages("#" . $target);
        $app->response->setBody(json_encode($data));

    });

    $app->get('/:target/:id', function ($target,$id) use ($app) {

        $message = new Chat\Chat(include("../../../../config-database.php"));
        $data = $message->getRecentMessages("#".$target,$id);
        $app->response->setBody(json_encode($data));

    });

});


$app->run();