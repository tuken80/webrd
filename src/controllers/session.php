<?php

/**
 * Ce fichier contient les controllers de la partie session du site.
 * Example: Login, Login_check, logout, account, etc ...
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

$app->get(
    '/login', function (Request $request) use ($app) {
        $username = $request->server->get('PHP_AUTH_USER', false);
        $password = $request->server->get('PHP_AUTH_PW');

        if ('igor' === $username && 'password' === $password) {
            $app['session']->set('user', array('username' => $username));
            return $app->redirect('/account');
        }

        $response = new Response();
        $response->headers->set(
            'WWW-Authenticate', 
            sprintf('Basic realm="%s"', 'site_login')
        );
        $response->setStatusCode(401, 'Please sign in.');
        return $response;
    }
)
->bind('login')
->method('GET');

$app->get(
    '/account', function () use ($app) {
        if (null === $user = $app['session']->get('user')) {
            return $app->redirect('/login');
        }

        return "Welcome {$user['username']}!";
    }
)
->bind('account')
->method('GET');
