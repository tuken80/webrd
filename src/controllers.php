<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require 'controllers/default.php';

// mount section
$admin = include 'controllers/admin/default.php';
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

        return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
    }
);
