<?php

/**
 * Ce fichier contient les controllers de la partie portfolio du site.
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
