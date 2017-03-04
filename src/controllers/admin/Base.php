<?php

/**
* Fichier contenant la class des controllers d'administration de base.
*
* PHP Version 7
*
* @category PHP
* @package  WebrdFramework
* @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
* @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
* @link     https://github.com/tuken80/webrd.git
*/

namespace Controller\Admin
{
    use Silex\Application;
    use Symfony\Component\HttpFoundation\Response;

    /**
    * Class contenant les controller d'administration de base.
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
        * Controller de la page d'index de l'administration.
        *
        * @param Application $app L'application utilisée.
        *
        * @return Response
        */
        public function index(Application $app) 
        {
            return new Response(
                $app['twig']->render('admin/index.html'),
                200,
                array('Cache-Control' => 's-maxage=5, public')
            );
        }
    }
}