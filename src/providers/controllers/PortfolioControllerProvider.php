<?php

/**
* Fichier contenant le provider des controllers 
* de la partie portfolio ainsi que leurs routes.
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
    * Provider des controllers de la partie portfolio.
    *
    * @category PHP
    * @package  WebrdFramework
    * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
    * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
    * @link     https://github.com/tuken80/webrd.git
    */
    class PortfolioControllerProvider implements ControllerProviderInterface
    {
        /**
        * Fonction fournissant la collection de controller pour la partie portfolio.
        *
        * @param Application $app L'application utilisée.
        *
        * @return Controller Collection
        */
        public function connect(Application $app)
        {
            $portfolio = $app['controllers_factory'];

            $portfolio->get('/', 'Controller\\Portfolio::index')
                ->bind('portfolio')
                ->method('GET');

            $portfolio->get('/{id}', 'Controller\\Portfolio::vue')
                ->bind('portfolio-vue')
                ->assert("id", "\d+")
                ->method('GET');

            return $portfolio;
        }
    }
}