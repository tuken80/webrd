<?php

/**
 * Ce fichier contient les controllers de la partie administration 
 * des utilisateurs du site.
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

$users = $app['controllers_factory'];

$users->get(
    '/', function () use ($app) {
        $userRepository = $app['db.em']->getRepository('User');
        $users = $userRepository->findAll();

        //$users = $app['db']->fetchAll('SELECT * FROM users');
    
        return new Response(
            $app['twig']->render(
                'admin/users/index.html', array(
                'users' => $users
                )
            ),
            200,
            array('Cache-Control' => 's-maxage=5, public')
        );
    }
)
->bind('admin-users')
->method('GET');

$users->get(
    '/{id}', function ($id) use ($app) {
        $userRepository = $app['db.em']->getRepository('User');
        $user = $userRepository->find($id);
    
        return new Response(
            $app['twig']->render(
                'admin/users/view.html', array(
                'user' => $user
                )
            ),
            200,
            array('Cache-Control' => 's-maxage=5, public')
        );
    }
)
->bind('admin-users-view')
->assert("id", "\d+")
->method('GET');

return $users;
