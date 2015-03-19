<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new \Silex\Application();

$app->get('/', function (Request $request) {
    return new Response(sprintf('Hello, %s', $request->get('name') ?: 'World'), 200, [
        'Content-Type' => 'text/plain',
    ]);
});

$app->get('/string_hello', function (Request $request) {
    return sprintf('Hello, %s', $request->get('name') ?: 'World');
});

$app->run();
