<?php

/**
 * Ce fichier contient les controllers de base de la partie administration du site.
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

$admin = $app['controllers_factory'];

$admin->get(
    '/', function () use ($app) {
        return new Response(
            $app['twig']->render('admin/index.html'),
            200,
            array('Cache-Control' => 's-maxage=5, public')
        );
    }
)
->bind('admin')
->method('GET');

return $admin;
