<?php

namespace Controller
{
    use Symfony\Component\HttpFoundation\Response;
    use Silex\Application;

    class Base
    {
        public function homepage(Application $app) 
        {
            return new Response(
                $app['twig']->render('about.html'),
                200,
                array('Cache-Control' => 's-maxage=5, public')
            );
        }

        public function blog(Application $app) 
        {
            return new Response(
                $app['twig']->render('blog.html'),
                200,
                array('Cache-Control' => 's-maxage=5, public')
            );
        }
    }
}