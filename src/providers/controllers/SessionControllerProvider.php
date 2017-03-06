<?php

/**
* Fichier contenant le provider des controllers 
* de la partie session ainsi que leurs routes.
*
* PHP Version 7
*
* @category PHP
* @package  WebrdFramework
* @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
* @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
* @link     https://github.com/tuken80/webrd.git
*/

namespace Controller\Provider
{
    use Silex\Application;
    use Silex\Api\ControllerProviderInterface;

    /**
    * Provider des controllers de la partie session.
    *
    * @category PHP
    * @package  WebrdFramework
    * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
    * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
    * @link     https://github.com/tuken80/webrd.git
    */
    class SessionControllerProvider implements ControllerProviderInterface
    {
        /**
        * Fonction fournissant la collection de controller pour la partie session.
        *
        * @param Application $app L'application utilisée.
        *
        * @return Controller Collection
        */
        public function connect(Application $app)
        {
            $session = $app['controllers_factory'];
                        
            $session->match('/login', 'Controller\\Session::login')
                ->bind('login')
                ->method('GET|POST');
                
            $session->get('/logout', 'Controller\\Session::logout')
                ->bind('logout')
                ->method('GET');

            $session->match('/inscription', 'Controller\\Session::inscription')
                ->bind('inscription')
                ->method('GET|POST');

            return $session;
        }
    }
}