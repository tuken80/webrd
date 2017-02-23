<?php

use Symfony\Component\HttpFoundation\Response;

$portfolio = $app['controllers_factory'];

// Portfolio index
$portfolio->get(
    '/', function () use ($app) {
        return new Response(
            $app['twig']->render('portfolio/index.html'),
            200,
            array('Cache-Control' => 's-maxage=5, public')
        );
    }
)
->bind('portfolio')
->method('GET');

// Portfolio vue
$portfolio->get(
    '/{id}', function ($id) use ($app) {
        return new Response(
            $app['twig']->render('portfolio/single-view.html'),
            200,
            array('Cache-Control' => 's-maxage=5, public')
        );
    }
)
->bind('portfolio-vue')
->assert("id", "\d+")
->method('GET');

return $portfolio;
