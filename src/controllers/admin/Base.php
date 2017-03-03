<?php

namespace Controller\Admin
{
    use Symfony\Component\HttpFoundation\Response;
    use Silex\Application;

    class Base
    {
        public function homepage(Application $app) 
        {
            return new Response(
                $app['twig']->render('admin/index.html'),
                200,
                array('Cache-Control' => 's-maxage=5, public')
            );
        }
    }
}