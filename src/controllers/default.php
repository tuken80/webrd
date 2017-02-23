<?php

use Symfony\Component\HttpFoundation\Response;

// Homepage
$app->get(
    '/', function () use ($app) {
        return new Response(
            $app['twig']->render('about.html'),
            200,
            array('Cache-Control' => 's-maxage=5, public')
        );
    }
)
->bind('homepage')
->method('GET');

// Blog
$app->get(
    '/blog', function () use ($app) {
        return new Response(
            $app['twig']->render('blog.html'),
            200,
            array('Cache-Control' => 's-maxage=5, public')
        );
    }
)
->bind('blog')
->method('GET');
