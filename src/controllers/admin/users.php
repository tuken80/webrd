<?php

/**
* Fichier contenant la class des controllers d'administration des utilisateurs.
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
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    /**
    * Class contenant les controller d'administration des utilisateurs.
    *
    * @category PHP
    * @package  WebrdFramework
    * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
    * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
    * @link     https://github.com/tuken80/webrd.git
    */
    class Users
    {
        /**
        * Controller de la page d'index de l'administration des utilisateurs.
        *
        * @param Application $app L'application utilisée.
        *
        * @return Response
        */
        public function index(Application $app) 
        {
            $users = $app['db']->fetchAll('SELECT * FROM users');
        
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

        /**
        * Controller de la page vue simple des utilisateurs.
        *
        * @param Request     $request La requête reçue.
        * @param Application $app     L'application utilisée.
        * @param String      $id      L'identifiant de l'utilisateur.
        *
        * @return Response
        */
        public function vue(Request $request, Application $app, $id) 
        {
            $user = $app['db']->fetchAssoc('SELECT * FROM users WHERE id = ?', array((int) $id));

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
        
    }
}