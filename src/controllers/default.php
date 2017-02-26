<?php

/**
 * Ce fichier contient les controllers de base du site.
 *
 * PHP version 7
 *
 * @category PHP
 * @package  WebrdFramework
 * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
 * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
 * @link     https://github.com/tuken80/webrd.git
 */

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
