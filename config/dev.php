<?php

/**
 * Ce fichier active le mode debug de l'application, 
 * il s'agit d'un fichier de configuration qui active plusieurs services.
 *
 * PHP version 7
 *
 * @category PHP
 * @package  WebrdFramework
 * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
 * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
 * @link     https://github.com/tuken80/webrd.git
 */

use Silex\Provider\MonologServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;
use Silex\Provider\VarDumperServiceProvider;

// include the prod configuration
require __DIR__.'/prod.php';

// enable the debug mode
$app['debug'] = true;

// registering monolog
$app->register(
    new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../var/logs/monolog.log',
    )
);

// enabling symfony profiler
$app->register(
    new WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => __DIR__.'/../var/cache/profiler',
    'profiler.mount_prefix' => '/_profiler', // this is the default
    )
);

// registering var_dumper
$app->register(
    new VarDumperServiceProvider(), array(
    'var_dumper.dump_destination' => __DIR__.'/../var/logs/var_dumper.log',
    )
);
