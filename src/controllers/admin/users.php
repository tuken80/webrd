<?php

use Symfony\Component\HttpFoundation\Response;

$users = $app['controllers_factory'];

$users->get('/', function () use ($app) {
    //$userRepository = $app['db.em']->getRepository('User');
    //$users = $userRepository->findAll();

    $users = $app['db']->fetchAll('SELECT * FROM users');
    
    return new Response(
        $app['twig']->render('admin/users.html', array(
            'users' => $users
        )), 
        200, 
        array('Cache-Control' => 's-maxage=3600, public')
    );
})
->bind('admin-users')
->method('GET');

return $users;