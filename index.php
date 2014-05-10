<?php

require "vendor/autoload.php";

$config = require_once 'php/config.php';

$app = new \Slim\Slim($config['slim']);

// $app->get('/hello/:name', function ($name) {
//     echo "Hello, $name";
// });

$app->get('/', function () use ($app, $service) {
//	$images = $service->findAll();
	$app->render('index.html', array('images' => $images));
});


$app->run();

?>