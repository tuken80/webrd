<?php

/**
 * Ce fichier contient le mappage des routes et des controllers du site,
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
$app->get('/', 'Controller\\Base::homepage')
    ->bind('homepage')
    ->method('GET');

$app->get('/blog', 'Controller\\Base::blog')
    ->bind('blog')
    ->method('GET');

$app->match('/contact', 'Controller\\Contact::formulaire')
    ->bind('contact')
    ->method('GET|POST');

$app->mount(
    '/portfolio', function ($portfolio) {
        $portfolio->get('/', 'Controller\\Portfolio::index')
            ->bind('portfolio')
            ->method('GET');
        $portfolio->get('/{id}', 'Controller\\Portfolio::vue')
            ->bind('portfolio-vue')
            ->assert("id", "\d+")
            ->method('GET');
    }
);

// Controllers de session
$app->match('/login', 'Controller\\Session::login')
    ->bind('login')
    ->method('GET|POST');
$app->get('/logout', 'Controller\\Session::logout')
    ->bind('logout')
    ->method('GET');

// Controllers d'administration
$app->mount(
    '/admin', function ($admin) {
        $admin->get('/', 'Controller\\Admin\\Base::index')
            ->bind('admin')
            ->method('GET');

        $admin->mount(
            '/users', function ($users) {
                $users->get('/', 'Controller\\Admin\\Users::index')
                    ->bind('admin-users')
                    ->method('GET');

                $users->get('/{id}', 'Controller\\Admin\\Users::vue')
                    ->bind('admin-users-view')
                    ->assert("id", "\d+")
                    ->method('GET');
            }
        );
    }
);


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
