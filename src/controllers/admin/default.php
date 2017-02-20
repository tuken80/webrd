<?php

use Symfony\Component\HttpFoundation\Response;

$admin = $app['controllers_factory'];

$admin->get('/', function () use ($app) {
    
    return new Response(
        $app['twig']->render('admin/index.html'), 
        200, 
        array('Cache-Control' => 's-maxage=3600, public')
    );
})
->bind('admin')
->method('GET');

return $admin;