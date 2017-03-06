<?php

/**
* Fichier contenant le provider des controllers 
* de la partie basique du site ainsi que leurs routes.
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
    * Provider des controllers de la partie basique du site.
    *
    * @category PHP
    * @package  WebrdFramework
    * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
    * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
    * @link     https://github.com/tuken80/webrd.git
    */
    class BaseControllerProvider implements ControllerProviderInterface
    {
        /**
        * Fonction fournissant la collection de controller 
        * pour la partie basique du site.
        *
        * @param Application $app L'application utilisée.
        *
        * @return Controller Collection
        */
        public function connect(Application $app)
        {
            $base = $app['controllers_factory'];

            $base->get('/', 'Controller\\Base::homepage')
                ->bind('homepage')
                ->method('GET');

            $base->get('/blog', 'Controller\\Base::blog')
                ->bind('blog')
                ->method('GET');

            $base->match('/contact', 'Controller\\Contact::formulaire')
                ->bind('contact')
                ->method('GET|POST');

            return $base;
        }
    }
}