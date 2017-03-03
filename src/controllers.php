<?php

/**
 * Ce fichier contient le mappage des controllers du site,
 * ainsi que la partie renvois d'erreur à l'utilisateur.
 *
 * PHP version 7
 *
 * @category PHP
 * @package  WebrdFramework
 * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
 * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
 * @link     https://github.com/tuken80/webrd.git
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Controllers de base
$app->match('/', 'Controller\\Base::homepage')
    ->bind('homepage')
    ->method('GET');
$app->match('/blog', 'Controller\\Base::blog')
    ->bind('blog')
    ->method('GET');

// Controllers de session
$app->match('/login', 'Controller\\Session::login')
    ->bind('login')
    ->method('GET|POST');
$app->match('/logout', 'Controller\\Session::logout')
    ->bind('logout')
    ->method('GET');

// Controllers d'administration
$admin = $app['controllers_factory'];

$admin->get('/', 'Controller\\Admin\\Base::homepage')
    ->bind('admin')
    ->method('GET');

// mount section
$admin->mount('/users', require 'controllers/admin/users.php');

$app->mount('/admin', $admin);
$app->mount('/portfolio', require 'controllers/portfolio.php');
$app->mount('/contact', require 'controllers/contact.php');

// errors section
$app->error(
    function (\Exception $e, Request $request, $code) use ($app) {
        if ($app['debug']) {
            return;
        }

        // 404.html, or 40x.html, or 4xx.html, or error.html
        $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
        );

        return new Response(
            $app['twig']->resolveTemplate($templates)->render(
                array('code' => $code)
            ), 
            $code
        );
    }
);
