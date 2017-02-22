<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../src/app.php';
$parameters = Yaml::parse(file_get_contents(__DIR__.'/../config/parameters.yml'));

require __DIR__.'/../config/prod.php';
require __DIR__.'/../src/controllers.php';

Request::enableHttpMethodParameterOverride();
Request::setTrustedProxies(array('127.0.0.1'));

$app['http_cache']->run();
