<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class HelloController
{
    public function helloAction(Request $request)
    {
        return new Response(sprintf('Hello, %s', $request->get('name') ?: 'World'), 200, [
            'Content-Type' => 'text/plain',
        ]);
    }
}

$routes = new RouteCollection();
$routes->add('hello', new Route('/', [
    '_controller'    => 'HelloController::helloAction',
]));
$routeContext = new RequestContext();
$matcher = new UrlMatcher($routes, $routeContext);

$events = new EventDispatcher();
$events->addSubscriber(new ResponseListener('UTF-8'));
$events->addSubscriber(new RouterListener($matcher, $routeContext));

$kernel = new HttpKernel($events, new ControllerResolver());

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
