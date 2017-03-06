<?php

/**
* Fichier contenant le provider des controllers 
* de la partie administration ainsi que leurs routes.
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
    * Provider des controllers de la partie administration.
    *
    * @category PHP
    * @package  WebrdFramework
    * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
    * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
    * @link     https://github.com/tuken80/webrd.git
    */
    class AdminControllerProvider implements ControllerProviderInterface
    {
        /**
        * Fonction fournissant la collection de controller 
        * pour la partie administration.
        *
        * @param Application $app L'application utilisée.
        *
        * @return Controller Collection
        */
        public function connect(Application $app)
        {
            $admin = $app['controllers_factory'];
                
            $admin->get('/', 'Controller\\Admin\\Base::index')
                ->bind('admin')
                ->method('GET');

            $admin->mount(
                '/users', function ($users) {
                    $users->get('/', 'Controller\\Admin\\User::index')
                        ->bind('admin-user')
                        ->method('GET');

                    $users->get('/{id}', 'Controller\\Admin\\User::vue')
                        ->bind('admin-user-view')
                        ->assert("id", "\d+")
                        ->method('GET');
                }
            );

            return $admin;
        }
    }
}