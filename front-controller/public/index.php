<?php

// public/index.php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;



$request = Request::createFromGlobals();

// Load routes
$routes = include __DIR__.'/../src/app.php';

$context = new RequestContext();
$context->fromRequest($request);

$generator = new Routing\Generator\UrlGenerator($routes, $context);

// Set up the URL Matcher
$matcher = new UrlMatcher($routes, $context);

try {
    $attributes = $matcher->match($request->getPathInfo());

    extract($attributes, EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);

    // Dynamically generate a URL based on the "hello" route with a "name" parameter
    $generatedUrl = $generator->generate('hello', ['name' => 'Fabien']);
    echo '<a href="' . $generatedUrl . '">Go to Hello page</a>';


    $response = new Response(ob_get_clean());
} catch (Symfony\Component\Routing\Exception\ResourceNotFoundException $exception) {
    $response = new Response('Not Found', 404);
}catch (\Exception $exception) {
    $response = new Response('An error occurred', 500);
}

$response->send();


