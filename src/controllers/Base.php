<?php

/**
* Fichier contenant la class des controllers de base.
*
* PHP Version 7
*
* @category PHP
* @package  WebrdFramework
* @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
* @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
* @link     https://github.com/tuken80/webrd.git
*/

namespace Controller
{
    use Symfony\Component\HttpFoundation\Response;
    use Silex\Application;

    /**
    * Class contenant les controller de base.
    *
    * @category PHP
    * @package  WebrdFramework
    * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
    * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
    * @link     https://github.com/tuken80/webrd.git
    */
    class Base
    {
        /**
        * Controller de la page d'index.
        *
        * @param Application $app L'application utilisée.
        *
        * @return Response
        */
        public function homepage(Application $app) 
        {
            return new Response(
                $app['twig']->render('about.html.twig'),
                200,
                array('Cache-Control' => 's-maxage=5, public')
            );
        }

        /**
        * Controller de la page blog.
        *
        * @param Application $app L'application utilisée.
        *
        * @return Response
        */
        public function blog(Application $app) 
        {
            return new Response(
                $app['twig']->render('blog.html.twig'),
                200,
                array('Cache-Control' => 's-maxage=5, public')
            );
        }
    }
}