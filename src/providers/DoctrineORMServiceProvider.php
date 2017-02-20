<?php

namespace Application\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Silex\Api\BootableProviderInterface;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class DoctrineORMServiceProvider implements ServiceProviderInterface
{
    
    public function register(Container $app)
    {
    }

    public function boot(Application $app)
    {
        $app['db.config'] = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../../modeles"), $app['debug']);
        $app['db.em'] = EntityManager::create($app['db.options'], $app['db.config']);
    }
}