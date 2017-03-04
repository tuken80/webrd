<?php

/**
* Fichier contenant la class des controllers de la partie portfolio.
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
    use Silex\Application;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    /**
    * Class contenant les controller de la partie portfolio.
    *
    * @category PHP
    * @package  WebrdFramework
    * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
    * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
    * @link     https://github.com/tuken80/webrd.git
    */
    class Portfolio
    {
        /**
        * Controller de la page portfolio.
        *
        * @param Application $app L'application utilisée.
        *
        * @return Response
        */
        public function index(Application $app) 
        {
            return new Response(
                $app['twig']->render('portfolio/index.html'),
                200,
                array('Cache-Control' => 's-maxage=5, public')
            );
        }
                
        /**
        * Controller de la page portfolio vue simple.
        *
        * @param Request     $request La requête reçue.
        * @param Application $app     L'application utilisée.
        * @param String      $id      L'identifiant de l'objet portfolio.
        *
        * @return Response
        */
        public function vue(Request $request, Application $app, $id) 
        {
            return new Response(
                $app['twig']->render('portfolio/single-view.html'),
                200,
                array('Cache-Control' => 's-maxage=5, public')
            );
        }
    }
}