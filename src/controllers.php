<?php

/**
 * Ce fichier contient le montage des routes et des controllers du site,
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
use Controller\Provider\BaseControllerProvider;
use Controller\Provider\AdminControllerProvider;
use Controller\Provider\SessionControllerProvider;
use Controller\Provider\PortfolioControllerProvider;

// Controllers de base
$app->mount('', new BaseControllerProvider());

// Controllers de session
$app->mount('/session', new SessionControllerProvider());

// Controllers de portfolio
$app->mount('/portfolio', new PortfolioControllerProvider());

// Controllers d'administration
$app->mount('/admin', new AdminControllerProvider());


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
