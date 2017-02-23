<?php

use Symfony\Component\HttpFoundation\Response;
use Application\Model\User;

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
