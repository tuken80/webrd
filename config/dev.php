<?php

// web/dev.php

use Silex\Provider\MonologServiceProvider;
use Silex\Provider\WebProfilerServiceProvider;
use Silex\Provider\VarDumperServiceProvider;

// include the prod configuration
require __DIR__.'/prod.php';

// enable the debug mode
$app['debug'] = true;

// registering monolog
$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../var/logs/monolog.log',
));

// enabling symfony profiler
$app->register(new WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => __DIR__.'/../var/cache/profiler',
    'profiler.mount_prefix' => '/_profiler', // this is the default
));

// registering var_dumper
$app->register(new VarDumperServiceProvider(), array(
    'var_dumper.dump_destination' => __DIR__.'/../var/logs/var_dumper.log',
));